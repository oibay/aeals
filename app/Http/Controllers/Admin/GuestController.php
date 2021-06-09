<?php

namespace App\Http\Controllers\Admin;

use App\entities\Search\SearchActiveGuest;
use App\entities\Search\SearchGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddGuestRequest;
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
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.guests',[
            'companies' => $companies,
            'guests' => $guests,
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
        return view('admin.guest-edit',[
            'guest' => $guest,
            'companies' => $companies,
            'guestCount' => $guestCount
        ]);
    }

    public function postEditGuest(AdminGuest $request,$id)
    {
        $create = Guest::updateGuest($request,$request->id);

        return redirect()->back()->with('success','Успешно добавлено');
    }

    public function searchGuest(Request $request)
    {

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
}
