<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomNumber extends Model
{
    use HasFactory;

    public function guestRoom()
    {
        return $this->hasMany(Guest::class,'room')
                            ->where('status',1)
                            ->where('room','<>',NULL);
    }
}
