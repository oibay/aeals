<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFood extends Model
{
    use HasFactory;

    public function eventTime($userId,$event,$vouchers)
    {
        return EventFoodTime::where(['user_id' => $userId, 'event_id' => $event, 'vouchers' => $vouchers])->first();
    }
}
