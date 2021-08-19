<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PreviewToPay extends Model
{
    use HasFactory;

    protected $table = 'preview_topay';



    public function log()
    {
        return $this->hasMany(LogPreview::class,'pr_id');
    }

    public static function report(Request $request)
    {
        $data =  PreviewToPay::whereYear('preview_topay.created_at', date('Y'))
            ->join('log_previewtopay', 'preview_topay.id', '=', 'log_previewtopay.pr_id')
            ->join('shop_menu', 'shop_menu.id', '=', 'log_previewtopay.sh_id')
            ->select('preview_topay.total as pr_total', 'log_previewtopay.total  as total',
                'shop_menu.title',
                'shop_menu.price',
               )
            ->groupBy('log_previewtopay.pr_id')
        ;


        return $data->get();
    }

}
