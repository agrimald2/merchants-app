<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['name' => 'Lima'],
            ['name' => 'Norte'],
            ['name' => 'Centro'],
            ['name' => 'Sur'],
        ];

    
        DB::table('regions')->insert($regions);
    }
}
