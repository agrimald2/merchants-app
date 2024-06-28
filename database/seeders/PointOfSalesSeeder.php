<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PointOfSale;

class PointOfSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PointOfSale::create([
            'code' => 'POS001',
            'name' => 'Point of Sale 1',
            'address' => '123 Main St',
            'route' => 'Route1',
            'table' => 'Table1',
            'location_id' => 1,
        ]);

        PointOfSale::create([
            'code' => 'POS002',
            'name' => 'Point of Sale 2',
            'address' => '456 Elm St',
            'route' => 'Route2',
            'table' => 'Table2',
            'location_id' => 2,
        ]);

        PointOfSale::create([
            'code' => 'POS003',
            'name' => 'Point of Sale 3',
            'address' => '789 Oak St',
            'route' => 'Route3',
            'table' => 'Table3',
            'location_id' => 3,
        ]);

        PointOfSale::create([
            'code' => 'POS004',
            'name' => 'Point of Sale 4',
            'address' => '101 Pine St',
            'route' => 'Route4',
            'table' => 'Table4',
            'location_id' => 4,
        ]);

        PointOfSale::create([
            'code' => 'POS005',
            'name' => 'Point of Sale 5',
            'address' => '202 Maple St',
            'route' => 'Route5',
            'table' => 'Table5',
            'location_id' => 5,
        ]);
    }
}
