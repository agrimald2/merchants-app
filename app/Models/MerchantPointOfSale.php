<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPointOfSale extends Model
{
    use HasFactory;

    protected $fillable = ['merchant_id', 'point_of_sale_id', 'frequency'];

}
