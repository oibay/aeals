<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EventFood extends Model
{
    use HasFactory;



    public function eventTime($userId, $event, $food)
    {
        switch ($food) {
            case 'Завтрак':
                return EventFoodTime::where(['user_id' => $userId, 'event_id' => $event, 'vouchers' => $food])->first();

                break;
            case 'Обед':
                return EventFoodTime::where(['user_id' => $userId, 'event_id' => $event, 'lunch' => $food])->first();

                break;
            case 'Ужин':
                return EventFoodTime::where(['user_id' => $userId, 'event_id' => $event, 'dinner' => $food])->first();

                break;
        }
    }

    public function evTime()
    {
        return $this->hasMany(EventFoodTime::class,'event_id');
    }

    public function company($id)
    {
        return User::where('id',$id)->first();
    }

    public static function foodReport(\Illuminate\Http\Request $request)
    {
        $food = DB::table('event_food')
                ->join('event_food_times','event_food.id','=','event_food_times.event_id')
                ->join('guests','guests.id','=','event_food_times.user_id')
                ->join('users','guests.user_id','=','users.id')
                ->select(
                    'guests.name as guest_name','users.name as company',
                    'event_food_times.vouchers','event_food_times.lunch',
                    'event_food_times.dinner',
                    'event_food_times.updated_at',
                    'guests.location',
                )
            ->where('event_food.id',$request->event_id)
            ->where('guests.location',$request->location)
            ->get();

            return $food;
    }
}
