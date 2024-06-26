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
}
