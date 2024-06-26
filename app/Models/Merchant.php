<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'dni', 'phone'];

    /**
     * Get the user that owns the merchant.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
