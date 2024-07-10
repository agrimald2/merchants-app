<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantPointOfSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['merchant_id', 'point_of_sale_id', 'frequency'];

}
