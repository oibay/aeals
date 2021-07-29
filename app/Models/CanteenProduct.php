<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanteenProduct extends Model
{
    use HasFactory;

    protected $table = 'canteen_product';

    public function details()
    {
        return $this->hasMany(CanteenProductDetail::class,'product_id');
    }

}
