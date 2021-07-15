<?php

namespace App\Exports;

use App\Models\EventFood;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FoodExport implements FromView, WithColumnWidths,WithStyles
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
            case 'food':;
                    $food = EventFood::foodReport($this->request);
                    return view('reportFood',[
                        'food' => $food,
                        'food_type' => $this->request->food,
                    ]);
                break;
        }
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 65,
            'C' => 35,
            'D' => 35,
            'E' => 10,
            'F' => 35,
            'G' => 15,
            'H' => 35,
            'I' => 35,
            'J' => 35,
        ];
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
}
