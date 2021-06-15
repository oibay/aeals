<?php

namespace App\Models;

use App\Http\Requests\AdminGuest;
use App\Http\Requests\GuestEditRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

class Guest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function guests()
    {
        return self::where('status',1)
            ->where('room','<>',null)
            ->with('guestTime')
            ->get();
    }

    public static function eventGuests($location = null)
    {
        return self::where('status',1)
            ->where('room','<>',null)
            ->where('location',$location ?? 'apec')
            ->with('guestTime')
            ->get();
    }

    /**
     * @param \App\Http\Requests\GuestEditRequest $request
     * @param $id
     */
    public static function updateGuest(\App\Http\Requests\GuestEditRequest $request, $id)
    {
        $guest = Guest::find($id);

		if(Auth::user()->role == 'admin') {
			$userId = $request->user_id;
			$guest->room = $request->room ?? null;
			$guest->status = $request->status;
		}else {
			$userId = Auth::id();
			$guest->status = 2;
		}
        $guest->name = $request->name;
        $guest->passport = $request->passport;
        $guest->user_id = $userId;

        $guest->phone = $request->phone;
        $guest->room_type = $request->room_type;
        $guest->location = $request->location;

        $guest->vouchers = Guest::stringVouchers([$request->breakfast, $request->lunch, $request->supper]);
        $guest->save();


        $guestTime = GuestTime::where('guest_id',$guest->id)->first();

        GuestTimeLog::create([
            'guest_id' => $guest->id,
            'entry' => $guestTime->entry,
            'departure' => $guestTime->departure
        ]);
        $guestTime->entry = $request->entry;
        $guestTime->departure = $request->departure;
        $guestTime->save();

    }

    /**
     * @return HasOne
     */
    public function guestTime():HasOne
    {
        return $this->hasOne(GuestTime::class);
    }

    /**
     * @param $vouchers
     * @return false|string
     */
    public static function stringVouchers($vouchers)
    {
        $string = '';
        foreach($vouchers as $voucher){
            if($voucher) $string .= $voucher.',';
        }

        return substr($string, 0, -1);
    }

    public function company():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','');
    }

    /**
     * @param AdminGuest $request
     * @param $id
     * @return Guest
     */
    public static function createGuest(AdminGuest $request):Guest
    {
        if (Auth::user()->role == 'company') { $userId = Auth::id();} else { $userId = $request->user_id; }
        $guest = Guest::create([
            'name' => $request->name,
            'passport' => $request->passport,
            'user_id' => $userId,
            'room' => $request->room ?? null,
            'room_type' => $request->room_type,
            'phone' => $request->phone,
            'location' => $request->location,
            'status' => 2,
            'vouchers' => Guest::stringVouchers([$request->breakfast, $request->lunch, $request->supper])
        ]);

        $guestTime = GuestTime::create([
            'guest_id' => $guest->id,
            'entry' => $request->entry,
            'departure' => $request->departure,
        ]);
        GuestTimeLog::create([
            'guest_id' => $guest->id,
            'entry' => $guestTime->entry,
            'departure' => $guestTime->departure
        ]);

        return $guest;
    }

    public static function reportMonth()
    {
        return Guest::whereYear('guests.created_at',2021)
                ->join('guest_times','guests.id','=','guest_times.guest_id')
                ->join('users','users.id','=','guests.user_id')
                ->select('guests.name','users.name as company',
                        'guests.room_type',
                        'guest_times.entry',
                        'guest_times.departure')
                ->where('location','apec')
                ->whereMonth('entry',05)
                ->get();
    }


}
