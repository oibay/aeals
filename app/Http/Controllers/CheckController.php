<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function qstat($id,$user)
    {
        $add = Ticket::find($id);
        $add->qstat = 1;
        $add->qstat_user = $user;
        if ($add->save()) {
            echo 'Успешно!';
        }
    }
}
