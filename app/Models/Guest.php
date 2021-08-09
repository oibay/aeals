<?php

namespace App\Models;

use App\Http\Requests\AdminGuest;
use App\Http\Requests\GuestEditRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\Concerns\Has;

class Guest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function guests()
    {
        return self::where('status', 1)
            ->where('room', '<>', null)
            ->with('guestTime')
            ->get();
    }

    public static function eventGuests($location = null)
    {
        return self::where('status', 1)
            ->where('room', '<>', null)
            ->where('location', $location ?? 'apec')
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

        if (Auth::user()->role == 'admin') {
            $userId = $request->user_id;
            $guest->room = $request->room ?? null;
            $guest->status = $request->status;
        } else {
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


        $guestTime = GuestTime::where('guest_id', $guest->id)->first();

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
    public function guestTime(): HasOne
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
        foreach ($vouchers as $voucher) {
            if ($voucher) $string .= $voucher . ',';
        }

        return substr($string, 0, -1);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', '');
    }

    /**
     * @param AdminGuest $request
     * @param $id
     * @return Guest
     */
    public static function createGuest(AdminGuest $request): Guest
    {
        if (Auth::user()->role == 'company') {
            $userId = Auth::id();
            $accept = new GuestAccept();
            $accept->title = 'Заявка к заселению-'.date('d-m-Y');
            $accept->user_id = $userId;
            $accept->save();
        } else {
            $userId = $request->user_id;
        }
        $guest = Guest::create([
            'name' => $request->name,
            'passport' => null,
            'user_id' => $userId,
            'room' => null,
            'room_type' => $request->room_type,
            'phone' => $request->phone,
            'location' => $request->location,
            'status' => $accept->id ? 4 : 2,
            'accept_id' => $accept->id ?? null,
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

    public static function reportMonth(Request $request)
    {
        return Guest::whereYear('guests.created_at', date('Y'))
            ->join('guest_times', 'guests.id', '=', 'guest_times.guest_id')
            ->join('users', 'users.id', '=', 'guests.user_id')

            ->select('guests.name', 'users.name as company',
                'guests.room_type',
                'guests.room',
                'guests.location',
                'guest_times.entry',

                'guest_times.departure')
            ->where('room', '<>', null)
            ->whereMonth('entry', date('m', strtotime($request->month)))
            ->get();
    }

    public static function reportWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        return Guest::whereYear('guests.created_at', date('Y'))
            ->join('guest_times', 'guests.id', '=', 'guest_times.guest_id')
            ->join('users', 'users.id', '=', 'guests.user_id')

            ->select('guests.name', 'users.name as company',
                'guests.room_type',
                'guest_times.entry',
                'guest_times.departure',
                'guests.location',
                'guests.room')

            ->where('room', '<>', null)
            ->whereMonth('entry', date('m'))
            ->where('guest_times.entry', '>=', $startOfWeek)
            ->where('guest_times.departure', '<=', $endOfWeek)
            ->get();
    }

    public static function reportDays()
    {
        return Guest::whereYear('guests.created_at', date('Y'))
            ->join('guest_times', 'guests.id', '=', 'guest_times.guest_id')
            ->join('users', 'users.id', '=', 'guests.user_id')

            ->select('guests.name', 'users.name as company',
                'guests.room_type',
                'guest_times.entry',
                'guest_times.departure',
                'guests.status', 'guests.room','guests.location')

            ->where('room', '<>', null)
            ->where('status', 1)
            ->get();
    }

    public static function reportBron(Request $request)
    {
        $guests =  Guest::whereYear('guests.created_at', date('Y'))
            ->join('guest_times', 'guests.id', '=', 'guest_times.guest_id')
            ->join('users', 'users.id', '=', 'guests.user_id')
            ->select('guests.name', 'users.name as company',
                'guests.room_type',
                'guest_times.entry',
                'guest_times.departure',
                'guests.status', 'guests.room','guests.location')
            ->where('status', 2);
            if ($request->entry_to && $request->entry_from) {
                $guests->whereBetween('guest_times.entry',
                    [Carbon::parse($request->entry_to),Carbon::parse($request->entry_from) ]);

            }else {
                $guests->whereDate('guest_times.entry',Carbon::parse($request->entry_to ?? $request->entry_from));
            }

            return $guests->get();
    }

    public static function reportGuests()
    {
        return Guest::whereYear('guests.created_at', date('Y'))
            ->join('guest_times', 'guests.id', '=', 'guest_times.guest_id')
            ->join('users', 'users.id', '=', 'guests.user_id')
            ->select('guests.name', 'users.name as company',
                'guests.room_type',
                'guest_times.entry',
                'guest_times.departure',
                'guests.status', 'guests.room',
                'guests.phone',
                'guests.location'
            )
            ->where('guests.room', '<>', null)
            ->where('guests.status', 1)
            ->get();

    }

    public function material($guestID, $materialID)
    {
        return GuestMaterial::where(['guest_id' => $guestID, 'material_id' => $materialID])->first();
    }

    public static function reportArchive(Request $request)
    {
        $data = Guest::whereYear('guests.created_at', date('Y'))
            ->join('guest_times', 'guests.id', '=', 'guest_times.guest_id')
            ->join('users', 'users.id', '=', 'guests.user_id')

            ->select('guests.name', 'users.name as company',
                'guests.room_type',
                'guest_times.entry',
                'guest_times.departure',
                'guests.status', 'guests.room',
                'guests.location'
            )
            ->where('guests.room', '<>', null)
            ->where('status', 0);
        if ($request->entry_to) {
            $data->whereBetween('guest_times.entry', [Carbon::parse($request->entry_to),Carbon::parse($request->entry_from)]);
        } elseif ($request->entry_to_k) {
            $data->whereBetween('guest_times.departure', [Carbon::parse($request->entry_to_k),Carbon::parse($request->entry_from_k)]);
        }
        return $data->get();
    }

    /**
     * @param $departure
     */
    public function expired($departure)
    {
        if (time() > strtotime($departure)) {
            return true;
        }

        return false;
    }

    public static function checkInAnalytics()
    {
        $guest = Guest::where('status',2)
                 ->join('users','guests.user_id','=','users.id')
                 ->select('users.name as com_name',
                  DB::raw("count(guests.id) as count"))
                 ->groupBy('users.name')
                 ->get();

        return $guest;
    }

    public static function guestsAnalytics()
    {
        $guest = Guest::where('status',1)
            ->where('room','<>',NULL)
            ->join('users','guests.user_id','=','users.id')
            ->select('users.name as com_name',
                DB::raw("count(guests.id) as count"))
            ->groupBy('users.name')
            ->get();

        return $guest;
    }

}

