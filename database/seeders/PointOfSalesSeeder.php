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
            'code' => '1171410',
            'name' => 'Mamani Vargas Eleuteria',
            'address' => 'Calle Falsa 1239',
            'route' => 'Route1',
            'table' => 'Table1',
            'location_id' => 10,
        ]);

        PointOfSale::create([
            'code' => '1178783',
            'name' => 'Toribio Guerra Nelly María',
            'address' => 'Calle Las Redes 341',
            'route' => 'Route2',
            'table' => 'Table2',
            'location_id' => 10,
        ]);

        PointOfSale::create([
            'code' => '12422925',
            'name' => 'Chipana Gallardo María Rosa',
            'address' => 'Jiron Ventanilla 842',
            'route' => 'Route3',
            'table' => 'Table3',
            'location_id' => 7,
        ]);

        PointOfSale::create([
            'code' => '11822995',
            'name' => 'Rojas Contreras Maribel Aurora',
            'address' => 'Av. SiempreViva 823',
            'route' => 'Route4',
            'table' => 'Table4',
            'location_id' => 8,
        ]);

        PointOfSale::create([
            'code' => 'POS005',
            'name' => 'Ruiz García Diomedes Tito',
            'address' => 'Av Velazco Astete 3813',
            'route' => 'Route5',
            'table' => 'Table5',
            'location_id' => 3,
        ]);
    }
}
