<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MerchantPointOfSale;
use App\Models\MerchantVisit;
use Carbon\Carbon;
use Log;

class GenerateMerchantVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:merchant-visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate merchant visits for the next day based on frequency';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
        $dayOfWeek = $tomorrow->dayOfWeekIso; // 1 (Monday) to 7 (Sunday)

        $assignments = MerchantPointOfSale::where('frequency', $dayOfWeek)->get();

        foreach ($assignments as $assignment) {
            MerchantVisit::create([
                'merchant_id' => $assignment->merchant_id,
                'point_of_sale_id' => $assignment->point_of_sale_id,
                'programmed_visit_date' => $tomorrow->toDateString(),
                'status' => 'Pending',
            ]);
        }
        Log::debug($assignments);
        $this->info('Merchant visits for tomorrow have been generated successfully.');
    }
}
