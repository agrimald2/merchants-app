<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    /**
     * Get the sub-regions for the region.
     */
    public function subRegions()
    {
        return $this->hasMany(SubRegion::class);
    }

    /**
     * Get the locations for the region through sub-regions.
     */
    public function locations()
    {
        return $this->hasManyThrough(Location::class, SubRegion::class);
    }
}
