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
        return Excel::download(new GuestExport($request,'day'), date('Y-m-d').'_dailyreport.xlsx');
    }

    public function weeklyReport(Request $request)
    {
        return Excel::download(new GuestExport($request,'week'), date('Y-m-d').'_weekreport.xlsx');
    }

    public function monthReport(Request $request)
    {
        $request->validate([
            'month' => 'required'
        ]);
        return Excel::download(new GuestExport($request,'month'), date('Y-m-d').'_monthreport.xlsx');
    }

    public function stlngReport(Request $request)
    {
        return Excel::download(new GuestExport($request,'stlng'), date('Y-m-d').'_bron_report.xlsx');
    }

    public function export(Request $request)
    {
        return Excel::download(new GuestExport($request), 'invoices.xlsx');
    }

    public function guestReport(Request $request)
    {
        return Excel::download(new GuestExport($request,'guests'), date('Y-m-d').'_guests_report.xlsx');
    }
}
