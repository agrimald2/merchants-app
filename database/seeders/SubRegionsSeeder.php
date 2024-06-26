<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubRegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_regions')->insert([
            ['id' => 1, 'region_id' => 1, 'name' => 'LIMA PROVINCIAS'],
            ['id' => 2, 'region_id' => 1, 'name' => 'LIMA'],
            ['id' => 3, 'region_id' => 2, 'name' => 'SR LAMBAYEQUE'],
            ['id' => 4, 'region_id' => 2, 'name' => 'SR PIURA'],
            ['id' => 5, 'region_id' => 2, 'name' => 'SR ANCASH'],
            ['id' => 6, 'region_id' => 2, 'name' => 'SR LA LIBERTAD'],
            ['id' => 7, 'region_id' => 3, 'name' => 'SR CENTRO'],
            ['id' => 8, 'region_id' => 3, 'name' => 'SR NORTE CHICO'],
            ['id' => 9, 'region_id' => 3, 'name' => 'SR SELVA'],
            ['id' => 10, 'region_id' => 3, 'name' => 'SR SUR CHICO'],
            ['id' => 11, 'region_id' => 4, 'name' => 'SR AREQUIPA'],
            ['id' => 12, 'region_id' => 4, 'name' => 'SR CUSCO'],
            ['id' => 13, 'region_id' => 4, 'name' => 'SR PUNO'],
            ['id' => 14, 'region_id' => 4, 'name' => 'SR TACNA'],
        ]);
    }
}
