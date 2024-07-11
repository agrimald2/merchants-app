<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Merchant;
use App\Models\PointOfSale;
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

    public function getGeneralVisitProgress($date)
    {
        Log::debug("FECHA:");
        Log::debug($date);
        // Validate the date format
        $validatedDate = Carbon::parse($date)->toDateString();

        // Get all merchants with visits scheduled for the given date
        $merchants = Merchant::whereHas('visits', function ($query) use ($validatedDate) {
            $query->whereDate('programmed_visit_date', $validatedDate);
        })->get();

        // Prepare the response data
        $merchantProgress = $merchants->map(function ($merchant) use ($validatedDate) {
            $totalVisits = $merchant->visits()->whereDate('programmed_visit_date', $validatedDate)->count();
            $pendingVisits = $merchant->visits()->whereDate('programmed_visit_date', $validatedDate)->where('status', 'Pending')->count();
            $completedVisits = $merchant->visits()->whereDate('programmed_visit_date', $validatedDate)->where('status', 'Done')->count();

            // Get the merchant name from the user relation
            $merchantName = $merchant->user->name;

            return [
                'merchant_id' => $merchant->id,
                'merchant_name' => $merchantName,
                'total_visits' => $totalVisits,
                'pending_visits' => $pendingVisits,
                'completed_visits' => $completedVisits,
            ];
        });

        return response()->json($merchantProgress);
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
}
