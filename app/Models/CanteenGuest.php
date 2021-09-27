<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanteenGuest extends Model
{
    use HasFactory;

    protected $table = 'canteen_guests';

    protected $guarded = [];

    public function company()
    {
        return $this->hasOne(CanteenCompany::class,'id','com_id');
    }
}
