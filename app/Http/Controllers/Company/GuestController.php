<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminGuest;
use App\Http\Requests\ImportGuest;
use App\Imports\GuestImport;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class GuestController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','access:company']);
    }

    public function index()
    {
        $guests = Guest::where(['status' => 1,'user_id'=>Auth::id()])
                    ->where('room','<>',null)
                    ->with('guestTime')
                    ->get();

        $guestCount = Guest::where(['status' => 2, 'user_id' => Auth::id()])->count();

        return view('company.guests',[
            'guests' => $guests,
            'guestCount' => $guestCount
        ]);
    }

    public function stlng()
    {
        $guests = Guest::where(['status' => 2,'user_id'=>Auth::id()])
            ->get();
        $guestCount = Guest::where(['status' => 2, 'user_id' => Auth::id()])->count();

        return view('company.stlng',[
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

    public function importGuest(ImportGuest $request)
    {
        if (Excel::import(new GuestImport($request), $request->file)) {
            return redirect()->back()->with('success','Успешно загружено');
        }
        return redirect()->back()->with('danger','Повторите позже!');
    }


}
