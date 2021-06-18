<?php

namespace App\Http\Controllers;

use App\Exports\GuestExport;
use App\Models\Guest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index()
    {
        return view('report.index');
    }

    public function dailyReport(Request $request)
    {
        return Excel::download(new GuestExport($request,'day'), 'dailyreport.xlsx');
    }

    public function weeklyReport(Request $request)
    {
        return Excel::download(new GuestExport($request,'week'), 'weekreport.xlsx');
    }

    public function monthReport(Request $request)
    {
        $request->validate([
            'month' => 'required'
        ]);
        return Excel::download(new GuestExport($request,'month'), 'monthreport.xlsx');
    }

    public function export(Request $request)
    {
        return Excel::download(new GuestExport($request), 'invoices.xlsx');
    }
}
