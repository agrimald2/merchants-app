<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\MerchantVisit;
use Inertia\Inertia;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{

    public function loginWithDNI(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'required|string|max:255',
        ]);

        $merchant = Merchant::where('dni', $validatedData['dni'])->first();

        if (!$merchant) {
            return response()->json(['error' => 'Merchant not found'], 404);
        }

        // Assuming you have a method to log in the user
        auth()->login($merchant->user);

        return redirect()->route('merchant.home');
    }

    public function login (){
        return inertia('Merchant/Login');
    }

    public function home (){
        return inertia('Merchant/Home');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchants = Merchant::all();
        return response()->json($merchants);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can return a view for creating a new merchant
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:merchants,email',
            'phone' => 'required|string|max:15',
        ]);

        $merchant = Merchant::create($validatedData);
        return response()->json($merchant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $merchant = Merchant::findOrFail($id);
        return response()->json($merchant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method can return a view for editing the specified merchant
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:merchants,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
        ]);

        $merchant = Merchant::findOrFail($id);
        $merchant->update($validatedData);
        return response()->json($merchant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->delete();
        return response()->json(null, 204);
    }

    public function getPendingVisits(Request $request)
    {
        $user = $request->user();

        if (empty($user)) {
            $user = auth()->user();
        }
        
        $merchantId = $user->merchant->id;

        $pendingVisits = MerchantVisit::where('merchant_id', $merchantId)
            ->where('status', 'Pending')
            ->whereDate('programmed_visit_date', Carbon::today())
            ->with('pointOfSale')
            ->get();

        return response()->json($pendingVisits);
    }

    public function getDoneVisits(Request $request)
    {
        $user = $request->user();

        if (empty($user)) {
            $user = auth()->user();
        }
        
        $merchantId = $user->merchant->id;

        $pendingVisits = MerchantVisit::where('merchant_id', $merchantId)
            ->where('status', 'Done')
            ->whereDate('programmed_visit_date', Carbon::today())
            ->with('pointOfSale')
            ->get();

        return response()->json($pendingVisits);
    }

    public function startVisit(Request $request)
    {
        Log::debug($request);
        $request->validate([
            'code' => 'required|string',
            'start_latitude' => 'required|numeric',
            'start_longitude' => 'required|numeric',
        ]);

        $user = $request->user();
        if (empty($user)) {
            $user = auth()->user();
        }

        $merchantId = $user->merchant->id;
        $code = $request->input('code');
        $startLatitude = $request->input('start_latitude');
        $startLongitude = $request->input('start_longitude');

        $visit = MerchantVisit::where('merchant_id', $merchantId)
            ->where('status', 'Pending')
            ->where('point_of_sale_id', function ($query) use ($code) {
                $query->select('id')
                    ->from('point_of_sales')
                    ->where('code', $code);
            })
            ->whereDate('programmed_visit_date', Carbon::today())
            ->first();

        if (!$visit) {
            return response()->json(['error' => 'No pending visit found for today with the provided code.'], 404);
        }

        $visit->update([
            'status' => 'On Visit',
            'start_latitude' => $startLatitude,
            'start_longitude' => $startLongitude,
            'visit_started_at' => now()->setTimezone('GMT-3'),
        ]);

        return response()->json($visit);
    }

    public function endVisit(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|integer|exists:merchant_visits,id',
            'end_latitude' => 'required|numeric',
            'end_longitude' => 'required|numeric',
            'visit_overview' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable',
        ]);

        $user = $request->user();
        if (empty($user)) {
            $user = auth()->user();
        }

        $merchantId = $user->merchant->id;
        $visitId = $request->input('visit_id');

        $visit = MerchantVisit::where('merchant_id', $merchantId)
            ->where('id', $visitId)
            ->where('status', 'On Visit')
            ->first();

        if (!$visit) {
            return response()->json(['error' => 'No ongoing visit found with the provided ID.'], 404);
        }

        $photoUrls = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('photos'), $filename);
                $photoUrls[] = url('photos/' . $filename);
            }
        }

        $visit->update([
            'status' => 'Done',
            'end_latitude' => $request->input('end_latitude'),
            'end_longitude' => $request->input('end_longitude'),
            'visit_ended_at' => now()->setTimezone('GMT-3'),
            'visit_overview' => $request->input('visit_overview'),
            'photo_url_1' => $photoUrls[0] ?? null,
            'photo_url_2' => $photoUrls[1] ?? null,
            'photo_url_3' => $photoUrls[2] ?? null,
            'photo_url_4' => $photoUrls[3] ?? null,
        ]);

        return response()->json($visit);
    }
    public function isOnVisit(Request $request)
    {
        $user = $request->user();
        if (empty($user)) {
            $user = auth()->user();
        }

        $merchantId = $user->merchant->id;

        $visit = MerchantVisit::where('merchant_id', $merchantId)
            ->where('status', 'On Visit')
            ->first();

        $isOnVisit = $visit ? true : false;

        return response()->json([
            'isOnVisit' => $isOnVisit,
            'visit' => $visit
        ]);
    }

    public function viewVisit($id)
    {
        $visit = MerchantVisit::with('pointOfSale')->findOrFail($id);
        return Inertia::render('Merchant/Visits/Visit', ['visit' => $visit]);
    }


}
