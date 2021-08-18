<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\LogPreview;
use App\Models\PreviewToPay;
use App\Models\ShopMenu;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:shop']);
    }

    public function index()
    {
        $shop = ShopMenu::all();
        return view('shop.index',[
            'shop' => $shop
        ]);
    }

    public function payToPay($id)
    {
        $preview = PreviewToPay::find($id);

        return view('shop.preview_send_to_pay',[
            'data' => $preview
        ]);
    }

    public function sendToPay(Request $request)
    {
        if ($request->checked) {
            $total = 0 ;
            $data = array();
            foreach ($request->checked as $key => $value) {
                $product = ShopMenu::find($key);

                $data[] = array('id' => $product->id,'total' => $request->total[$key]);


                //echo $data =  "<p style='font-size:20px'> ".$product->title. " -<strong style='color:black;'>".($product->price * $request->total[$key])." тг</strong></p>";
                $total += ($product->price * $request->total[$key]);

            }


            $preview = new PreviewToPay;
            $preview->data = '0';

            $preview->total = $total;

            $preview->save();

            foreach ($data as $datum) {
                LogPreview::create([
                    'sh_id' => $datum['id'],
                    'pr_id' => $preview->id,
                    'total' => $datum['total']
                ]);
            }
        }

        return redirect('shop/paytopay/'.$preview->id);
    }

    public function approved($id)
    {
        $preview = PreviewToPay::find($id);
        $preview->data = 1;
        $preview->save();

        return redirect('/shop')->with('success','Успешно подтверждено');
    }

    public function payed()
    {
        $payed = PreviewToPay::where('data',1)->get();

        return view('shop.payed',[
            'data' => $payed
        ]);
    }

}
