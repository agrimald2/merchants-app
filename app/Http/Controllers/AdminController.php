<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Merchant;
use App\Models\PointOfSale;
use Log;

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

        Log::debug($merchants);
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

        Log::debug($pointOfSales);
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

}
