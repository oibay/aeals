<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPreview extends Model
{
    use HasFactory;
    protected $table = 'log_previewtopay';
    protected $guarded = [];

    public function menu()
    {
        return $this->hasOne(ShopMenu::class,'id','sh_id');
    }
}
