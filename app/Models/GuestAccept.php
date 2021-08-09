<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestAccept extends Model
{
    use HasFactory;
    protected $table = 'guests_accept';

    public function countGuest()
    {
        return $this->hasMany(Guest::class,'accept_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '');
    }
}
