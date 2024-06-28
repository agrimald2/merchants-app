<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'dni', 'phone', 'location_id'];

    /**
     * Get the user that owns the merchant.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The points of sale that belong to the merchant.
     */
    public function pointsOfSale()
    {
        return $this->belongsToMany(PointOfSale::class, 'merchant_point_of_sales')
                    ->withPivot('frequency')
                    ->withTimestamps();
    }

    /**
     * Get the location that the merchant belongs to.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
