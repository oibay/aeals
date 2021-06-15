<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index($id)
    {
        $guest = Guest::findorFail($id);

        return view('pdf', [
            'guest' => $guest
        ]);
    }

    public function monthReport()
    {
        $db = Guest::reportMonth();

        return view('reportmonth',[
            'db' => $db
        ]);
    }
}
