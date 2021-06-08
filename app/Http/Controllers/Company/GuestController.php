<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::where(['status' => 1,'user_id'=>Auth::id()])
                    ->where('room','<>',null)
                    ->with('guestTime')
                    ->get();

        return view('company.guests',[
            'guests' => $guests
        ]);
    }
}
