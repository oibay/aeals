<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index()
    {
        $guests = Guest::where('status', 0)
			->whereYear('created_at',2021)
			->orderBy('created_at', 'DESC')
			->get();
	
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.archive',[
            'guests' => $guests,
            'guestCount' => $guestCount
        ]);
    }
}
