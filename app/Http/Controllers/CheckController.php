<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketDepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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

    public function approved($id)
    {
        $add = Ticket::find($id);
        $department = TicketDepartment::find($add->department_id);
        $message = "Здравствуйте " . $department->user['name'] . "\nЗаявка от " . User::find($add->user_id)->name . "\nЗаявка № *" . $add->id . "*\nЛокация: *" . $add->location . "* \nОтдел: *" . $department->title . "*\nСтатус:*Подтверждено*\nОписание:" . $add->description . "";


        $add->approved = 1;
        $urlFile = '';
        if ($add->photo) {
            $urlFile = 'https://aea-ls.kz/public/images/' . $add->photo;
        }
        $user = User::where('type_zapros', $department->id)->first();
        if ($add->save()) {
            try {

                 Notification::route('telegram', $department->user['telegramid'])
                 ->notify(new \App\Notifications\Telegram($message, $urlFile, $add->id, $user,1));

                 $array = [829600339,754572114,337997800];
                 foreach ($array as $item) {
                 Notification::route('telegram', $item)
                 ->notify(new \App\Notifications\Telegram($message, $urlFile, $add->id, $user, 1));
                 }

            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }
        }
    }
}
