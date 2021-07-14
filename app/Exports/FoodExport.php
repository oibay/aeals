<?php

namespace App\Exports;

use App\Models\EventFood;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class FoodExport implements FromView
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
                        'food_type' => $this->request
                    ]);
                break;
        }
    }
}
