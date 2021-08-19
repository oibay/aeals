<?php

namespace App\Exports;


use App\Models\Guest;
use App\Models\PreviewToPay;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuestExport implements FromView, WithColumnWidths,WithStyles
{
    private Request $request;
    private string $options;

    public function __construct(Request $request,$options)
    {
        $this->request = $request;
        $this->options = $options;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);
        $sheet->getStyle('E1')->getFont()->setBold(true);
        $sheet->getStyle('F1')->getFont()->setBold(true);
        $sheet->getStyle('G1')->getFont()->setBold(true);
        $sheet->getStyle('H1')->getFont()->setBold(true);
        $sheet->getStyle('I1')->getFont()->setBold(true);
        $sheet->getStyle('J1')->getFont()->setBold(true);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 65,
            'C' => 35,
            'D' => 35,
            'E' => 35,
            'F' => 35,
            'G' => 15,
            'H' => 35,
            'I' => 35,
            'J' => 35,
        ];
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
            case 'archive':
                $db = Guest::reportArchive($this->request);
                return view('reportArchive',[
                    'db' => $db
                ]);
                break;
            case 'payment':
                $payed = PreviewToPay::where('data', 1)
                    ->whereBetween('created_at',
                    [Carbon::parse($this->request->entry_to),Carbon::parse($this->request->entry_from) ])
                    ->get();

                return view('reportPayment', [
                    'data' => $payed
                ]);
                break;
        }

    }
}
