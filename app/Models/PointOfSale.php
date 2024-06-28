<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointOfSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'name', 'address', 'route', 'table', 'location_id'];

    /**
     * Get the location that owns the point of sale.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * The merchants that belong to the point of sale.
     */
    public function merchants()
    {
        return $this->belongsToMany(Merchant::class, 'merchant_point_of_sales')
                    ->withPivot('frequency')
                    ->withTimestamps();
    }
}
