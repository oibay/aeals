<?php

namespace App\Http\Controllers;
use App\Exports\GuestExport;
use App\Models\Guest;
use Maatwebsite\Excel\Facades\Excel;
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


}
