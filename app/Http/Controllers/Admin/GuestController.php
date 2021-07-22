<?php

namespace App\Http\Controllers\Admin;

use App\entities\Search\SearchActiveGuest;
use App\entities\Search\SearchBron;
use App\entities\Search\SearchGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddGuestRequest;
use App\Http\Requests\AdminGuest;
use App\Http\Requests\GuestEditRequest;
use App\Models\Guest;
use App\Models\GuestTime;
use App\Models\Material;
use App\Models\RoomNumber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index()
    {
        $guests = Guest::guests();
        $companies = User::companies();
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.guests',[
            'companies' => $companies,
            'guests' => $guests,
            'guestCount' => $guestCount
        ]);
    }

    public function showAddGuest()
    {
        $companies = User::companies();
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.guest-add',[
            'companies' => $companies,
            'guestCount' => $guestCount
        ]);
    }

    public function postGuest(AdminGuest $request)
    {

        if (Guest::createGuest($request)) {
            return redirect()->back()->with('success','Успешно добавлено');
        }
        return redirect()->back()->with('danger','Повторите позже!');
    }

    public function editShow(int $id)
    {
        $guest = Guest::findOrFail($id);
        $companies = User::companies();
        $guestCount = Guest::where(['status' => 2])->count();
        $materials = Material::all();
        $rooms = RoomNumber::where('location',$guest->location)->get();

        return view('admin.guest-edit',[
            'guest' => $guest,
            'companies' => $companies,
            'guestCount' => $guestCount,
            'materials' => $materials,
            'rooms' => $rooms
        ]);
    }

    public function postEditGuest(GuestEditRequest $request,$id)
    {
        if($request->status == 1) {
            if(is_null($request->room)) {
                return redirect()->back()->with('warning','Пустое поле (комната)');
            }
        }
        $create = Guest::updateGuest($request,$request->id);

        return redirect()->back()->with('success','Успешно добавлено');
    }

    public function searchGuest(Request $request)
    {
        if ($request->search_s == 1) {
            if ($request->checkout) {
                $this->checkOut($request->checkout);
            }
            $search = new SearchGuest($request);
            $search = new SearchActiveGuest($search);

            $guest = $search->getQuery()->get();
            $companies = User::companies();
            $guestCount = Guest::where(['status' => 2])->count();

            return view('admin.search-guests',[
                'companies' => $companies,
                'guests' => $guest,
                'guestCount' => $guestCount
            ]);
        }else {
            $search = new SearchBron($request);
            $search = new SearchActiveGuest($search);

            $guest = $search->getQuery()->get();
            $companies = User::companies();
            $guestCount = Guest::where(['status' => 2])->count();
            if ($request->roomGuestUkaz) {
                $this->checkIn($request);
            }
            return view('admin.search-stlng',[
                'companies' => $companies,
                'guests' => $guest,
                'guestCount' => $guestCount
            ]);
        }




    }

    public function stlng()
    {
        $guests = Guest::where(['status' => 2])
            ->get();
        $companies = User::companies();
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.stlng',[
            'guests' => $guests,
            'companies' => $companies,
            'guestCount' => $guestCount,

        ]);
    }

	public function remove($id)
	{
		$guest = Guest::find($id);
		$guest->status = 3;
		$guest->save();

		return redirect()->back()->with('success','Успешно удалено');
	}

    public function checkOut($id)
    {
        $guest = Guest::find($id);
        $guest->status = 0;
        if ($guest->save()) {
            $guestTime = GuestTime::where('guest_id',$guest->id)->first();
            $guestTime->departure = Carbon::now()->toDateTimeString();
            $guestTime->save();
            return redirect()->back()->with('success','Успешно выселен');
        }
	}

    public function checkIn(Request $request)
    {
        $request->validate([
            'room' => 'required'
        ]);
        $guest = Guest::find($request->idkl);
        $guest->room = $request->room;
        $guest->status = 1;

        if ($guest->save()) {
            $guestTime = GuestTime::where('guest_id',$guest->id)->first();
            $guestTime->entry = Carbon::now()->toDateTimeString();
            $guestTime->save();
            return redirect()->back()->with('success','Успешно обновлено');
        }
    }
}
