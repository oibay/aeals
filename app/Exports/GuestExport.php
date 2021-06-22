<?php

namespace App\Exports;


use App\Models\Guest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class GuestExport implements FromView
{
    private Request $request;
    private string $options;

    public function __construct(Request $request,$options)
    {
        $this->request = $request;
        $this->options = $options;
    }

    public function view(): View
    {
        switch ($this->options) {
            case 'month':
                $db = Guest::reportMonth($this->request);
                return view('reportmonth',[
                    'db' => $db
                ]);
                break;
            case 'week':
                $db = Guest::reportWeek();
                return view('reportweek',[
                    'db' => $db
                ]);
                break;

            case 'day':
                $db = Guest::reportDays();
                return view('reportdays',[
                    'db' => $db
                ]);
                break;
            case 'stlng':
                $db = Guest::reportBron($this->request);
                return view('reportbron',[
                    'db' => $db
                ]);
                break;

            case 'guests':
                $db = Guest::reportGuests();
                return view('reportGuests',[
                    'db' => $db
                ]);
                break;
        }

    }
}
