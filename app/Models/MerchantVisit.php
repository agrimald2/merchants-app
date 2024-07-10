<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'point_of_sale_id',
        'programmed_visit_date',
        'visit_overview',
        'visit_started_at',
        'visit_ended_at',
        'start_latitude',
        'start_longitude',
        'end_latitude',
        'end_longitude',
        'status',
    ];

    /**
     * Get the merchant that owns the visit.
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * Get the point of sale associated with the visit.
     */
    public function pointOfSale()
    {
        return $this->belongsTo(PointOfSale::class);
    }
}
