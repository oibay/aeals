<?php

namespace App\Http\Controllers\Admin\Canteen;

use App\Http\Controllers\Controller;
use App\Models\CanteenProduct;
use App\Models\CanteenProductDetail;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:canteenad']);
    }

    public function index()
    {
        return view('canteen.add');
    }

    public function productAdd(Request $request)
    {
         return $this->createProduct($request);
    }

    public function showEditProduct($id)
    {
        $product = CanteenProduct::find($id);

        return view('canteen.edit',[
            'product' => $product,
        ]);
    }

    public function productUpdate(Request $request, $id)
    {
        return $this->createProduct($request, $id);
    }

    private function calculate(Request $request)
    {
        $percentage = 30;

        $productVes = $request->brutto ? $request->brutto : $request->netto;

        if ($productVes == '1') {

            $calc = ($productVes * $request->price);
        }else {

            $calc = ($productVes / $request->gramm) * $request->price;
        }

        $plusPercentage = ($percentage / 100) * $calc;
        return [$calc, ($calc + $plusPercentage)];
    }

    private function createProduct(Request $request, int $id = null)
    {

        $productName =  $id ? CanteenProduct::findOrFail($id) :
                        new CanteenProduct ;

        $productName->title = $request->productName;
        $productName->gramm = $request->gramm;

        if ($productName->save()) {
            $details = CanteenProductDetail::create([
                'product_id' => $productName->id,
                'title' => $request->title,
                'brutto' => $request->brutto,
                'netto' => $request->netto,
                'comment' => $request->comment,
                'price' => $request->price,
                'sum' => $this->calculate($request)[0],
                'total' => $this->calculate($request)[1]
            ]);

            if ($details) {
                return redirect('canteenad/editproduct/'.$productName->id);
            }
        }
    }
}
