<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $guests = Guest::where('status', 0)
            ->whereYear('created_at',2020)
            ->orderBy('created_at', 'DESC')->get();

        return view('admin.archive',[
            'guests' => $guests
        ]);
    }
}
