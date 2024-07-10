<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MerchantVisit;
use Carbon\Carbon;

class MerchantVisitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MerchantVisit::create([
            'merchant_id' => 1, 
            'point_of_sale_id' => 1,
            'programmed_visit_date' => Carbon::today()->toDateString(),
            'visit_overview' => null,
            'visit_started_at' => null,
            'visit_ended_at' => null,
            'start_latitude' => null,
            'start_longitude' => null,
            'end_latitude' => null,
            'end_longitude' => null,
            'status' => 'Pending',
        ]);
    }
}
