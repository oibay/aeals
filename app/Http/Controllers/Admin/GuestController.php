<?php

namespace App\Http\Controllers\Admin;

use App\entities\SearchGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminGuest;
use App\Models\Guest;
use App\Models\User;
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

        return view('admin.guests',[
            'companies' => $companies,
            'guests' => $guests
        ]);
    }

    public function postGuest(AdminGuest $request)
    {
        Guest::createGuest();
    }

    public function editShow(int $id)
    {
        $guest = Guest::findOrFail($id);
        $companies = User::companies();
        return view('admin.guest-edit',[
            'guest' => $guest,
            'companies' => $companies
        ]);
    }

    public function postEditGuest(AdminGuest $request,$id)
    {
        $create = Guest::updateGuest($request,$request->id);

        return redirect()->back();
    }

    public function searchGuest(Request $request)
    {
        $search = (new SearchGuest())
                    ->setCompany($request->company)
                    ->setLocation($request->location)
                    ->setRoomType($request->room_type)
                    ->setEntry($request->entry)
                    ->setDeparture($request->departure)
                    ->setVouchers($request->vouchers);

        dd($search->searchGuest());
    }
}
