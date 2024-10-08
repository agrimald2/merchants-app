<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['subregion_id', 'name'];

    /**
     * Get the sub-region that owns the location.
     */
    public function subRegion()
    {
        return $this->belongsTo(SubRegion::class);
    }

    /**
     * Get the region through the sub-region.
     */
    public function region()
    {
        return $this->hasOneThrough(Region::class, SubRegion::class);
    }

    /**
     * Get the point of sales for the location.
     */
    public function pointOfSales()
    {
        return $this->hasMany(PointOfSale::class);
    }
}
