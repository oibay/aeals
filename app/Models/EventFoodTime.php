<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFoodTime extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function guest()
    {
        return $this->belongsTo(Guest::class,'user_id');
    }
}
