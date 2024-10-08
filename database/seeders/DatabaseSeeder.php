<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            AdminSeeder::class,
            MerchantsSeeder::class,
            
            RegionsSeeder::class,
            SubRegionsSeeder::class,
            LocationsSeeder::class,
            
            PointOfSalesSeeder::class,
            MerchantVisitsSeeder::class,
        ]);
    }
}

