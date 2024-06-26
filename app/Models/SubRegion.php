<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubRegion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['region_id', 'name'];

    /**
     * Get the region that owns the sub-region.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the locations for the sub-region.
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
