<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Merchant;
use App\Models\PointOfSale;
use App\Models\MerchantPointOfSale;
use App\Models\User;
use App\Models\Location;
use Maatwebsite\Excel\Facades\Excel;
use Log;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function overviewMerchants()
    {
        return inertia('Admin/Overview/MerchantsOverview', [
            'visits' => [
                ['id' => 1, 'name' => 'Visit 1'],
                ['id' => 2, 'name' => 'Visit 2'],
                ['id' => 3, 'name' => 'Visit 3'],
            ],
        ]);
    }

    public function visitList()
    {
        return inertia('Admin/Visits/List', [
            'visits' => [
                ['id' => 1, 'name' => 'Visit 1'],
                ['id' => 2, 'name' => 'Visit 2'],
                ['id' => 3, 'name' => 'Visit 3'],
            ],
        ]);
    }

    public function getMerchants()
    {
        $merchants = Merchant::with(['user', 'location.subRegion.region'])->get()->map(function ($merchant) {
            return [
                'id' => $merchant->id,
                'name' => $merchant->user->name,
                'username' => $merchant->user->username,
                'dni' => $merchant->dni,
                'phone' => $merchant->phone,
                'location' => [
                    'id' => $merchant->location->id,
                    'name' => $merchant->location->name,
                    'sub_region' => [
                        'id' => $merchant->location->subRegion->id,
                        'name' => $merchant->location->subRegion->name,
                        'region' => [
                            'id' => $merchant->location->subRegion->region->id,
                            'name' => $merchant->location->subRegion->region->name,
                        ],
                    ],
                ],
            ];
        });

        return response()->json($merchants);
    }

    public function getPointOfSales()
    {
        $pointOfSales = PointOfSale::with(['location.subRegion.region'])->get()->map(function ($pos) {
            return [
                'id' => $pos->id,
                'code' => $pos->code,
                'name' => $pos->name,
                'address' => $pos->address,
                'route' => $pos->route,
                'table' => $pos->table,
                'location' => [
                    'id' => $pos->location->id,
                    'name' => $pos->location->name,
                    'sub_region' => [
                        'id' => $pos->location->subRegion->id,
                        'name' => $pos->location->subRegion->name,
                        'region' => [
                            'id' => $pos->location->subRegion->region->id,
                            'name' => $pos->location->subRegion->region->name,
                        ],
                    ],
                ],
            ];
        });

        return response()->json($pointOfSales);
    }
    public function uploadDataIndex()
    {
        return inertia('Admin/UploadData/Index');
    }

    public function merchantsIndex()
    {
        return inertia('Admin/UploadData/Merchants/Index');
    }

    public function pointOfSalesIndex()
    {
        return inertia('Admin/UploadData/PointOfSales/Index');
    }

    public function visitsAsignedIndex(){
        return inertia('Admin/UploadData/Asignation/Index');
    }
    public function getGeneralVisitProgress($date)
    {
        Log::debug("FECHA:");
        Log::debug($date);
        // Validate the date format
        $validatedDate = Carbon::parse($date)->toDateString();

        // Get all merchants with visits scheduled for the given date
        $merchants = Merchant::with('location')->whereHas('visits', function ($query) use ($validatedDate) {
            $query->whereDate('programmed_visit_date', $validatedDate);
        })->get();

        // Prepare the response data
        $merchantProgress = $merchants->map(function ($merchant) use ($validatedDate) {
            $totalVisits = $merchant->visits()->whereDate('programmed_visit_date', $validatedDate)->count();
            $pendingVisits = $merchant->visits()->whereDate('programmed_visit_date', $validatedDate)->where('status', 'Pending')->count();
            $completedVisits = $merchant->visits()->whereDate('programmed_visit_date', $validatedDate)->where('status', 'Done')->count();

            // Get the merchant name from the user relation
            $merchantName = $merchant->user->name;
            $merchantDNI = $merchant->dni;
            $merchantLocation = $merchant->location->name;
            
            return [
                'merchant_id' => $merchant->id,
                'merchant_name' => $merchantName,
                'merchant_dni' => $merchantDNI,
                'merchant_location' => $merchantLocation,
                'total_visits' => $totalVisits,
                'pending_visits' => $pendingVisits,
                'completed_visits' => $completedVisits,
            ];
        });

        return response()->json($merchantProgress);
    }

    public function locationsIndex()
    {
        return inertia('Admin/UploadData/Locations/Index');
    }
    public function getAsignedVisits()
    {
        $asignedVisits = MerchantPointOfSale::with(['merchant.user', 'pointOfSale.region', 'pointOfSale.location'])
            ->orderBy('frequency')
            ->get()
            ->map(function ($asignedVisit) {
                return [
                    'id' => $asignedVisit->id,
                    'merchant_id' => $asignedVisit->merchant_id,
                    'merchant' => $asignedVisit->merchant->user->name,
                    'merchant_dni' => $asignedVisit->merchant->dni,
                    'point_of_sale_id' => $asignedVisit->point_of_sale_id,
                    'pos' => $asignedVisit->pointOfSale->name,
                    'pos_code' => $asignedVisit->pointOfSale->code,
                    'location_id' => $asignedVisit->pointOfSale->location_id,
                    'location' => $asignedVisit->pointOfSale->location->name,
                    'region_id' => $asignedVisit->pointOfSale->region->id,
                    'region' => $asignedVisit->pointOfSale->region->name,
                    'frequency' => $asignedVisit->frequency,
                ];
            });
        
        return response()->json($asignedVisits);
    }

    public function getVisitsFromMerchant($merchant_id, $date)
    {
        // Validate the date format
        $validatedDate = Carbon::parse($date)->toDateString();

        // Get the merchant
        $merchant = Merchant::with('user')->findOrFail($merchant_id);

        // Get the visits for the merchant on the given date
        $visits = $merchant->visits()->with('pointOfSale')->whereDate('programmed_visit_date', $validatedDate)->get();

        // Filter visits by status
        $pendingVisits = $visits->where('status', 'Pending');
        $doneVisits = $visits->where('status', 'Done');

        Log::debug($pendingVisits);
        
        // Prepare the data for the view
        $data = [
            'merchant' => $merchant,
            'visits' => $visits,
            'pending_visits' => $pendingVisits,
            'done_visits' => $doneVisits,
            'date' => $validatedDate,
        ];

        return inertia('Admin/Visits/List', $data);
    }

    public function uploadMerchantsExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        $data = \Excel::toArray([], $file)[0];

        $data = array_slice($data, 1);

        foreach ($data as $row) {
            $name = $row[0];
            $dni = $row[1];
            $phone = $row[2];
            $locationName = $row[3];

            // Check if merchant already exists
            if (Merchant::where('dni', $dni)->exists()) {
                continue;
            }

            // Find or create location
            $location = Location::firstOrCreate(
                ['name' => $locationName],
                ['name' => $locationName]
            );

            // Create user
            $user = User::create([
                'name' => $name,
                'username' => $dni,
                'password' => bcrypt($dni),
                'role_id' => 2, // Assuming 2 is the role_id for merchants
            ]);

            // Create merchant
            Merchant::create([
                'user_id' => $user->id,
                'dni' => $dni,
                'phone' => $phone,
                'location_id' => $location->id,
            ]);
        }

        return response()->json(['message' => 'Merchants uploaded successfully']);
    }

    public function uploadPointOfSalesExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        $data = \Excel::toArray([], $file)[0];

        // Skip the header row
        foreach (array_slice($data, 1) as $row) {
            $code = $row[0];
            $name = $row[1];
            $address = $row[2];
            $locationName = $row[3];

            // Check if point of sale already exists
            if (PointOfSale::where('code', $code)->exists()) {
                continue;
            }

            // Find or create location
            $location = Location::firstOrCreate(
                ['name' => $locationName],
                ['name' => $locationName]
            );

            // Create point of sale
            PointOfSale::create([
                'code' => $code,
                'name' => $name,
                'address' => $address,
                'location_id' => $location->id,
            ]);
        }

        return response()->json(['message' => 'Point of Sales uploaded successfully']);
    }

    public function uploadMerchantsPointOfSalesExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    $file = $request->file('file');
    $data = \Excel::toArray([], $file)[0];

    Log::debug($data);
    // Skip the header row
    foreach (array_slice($data, 1) as $row) {
        $dni = $row[0];
        $posCode = $row[1];
        $frequency = $row[2];

        // Extract merchant ID by DNI
        $merchant = Merchant::where('dni', $dni)->first();
        if (!$merchant) {
            continue;
        }

        // Extract POS ID by code
        $pointOfSale = PointOfSale::where('code', $posCode)->first();
        if (!$pointOfSale) {
            continue;
        }

        // Convert frequency to day of the week number
        $daysOfWeek = [
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3,
            'miercoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6,
            'sabado' => 6,
            'domingo' => 7,
        ];
        $dayNumber = $daysOfWeek[strtolower($frequency)] ?? null;
        if (!$dayNumber) {
            continue;
        }

        // Add information to MerchantsPointOfSales
        $merchant->pointsOfSale()->attach($pointOfSale->id, ['frequency' => $dayNumber]);
    }

    return response()->json(['message' => 'Merchant Point of Sales uploaded successfully']);
}
}
