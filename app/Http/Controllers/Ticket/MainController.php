<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','access:tickets']);
    }

    public function index()
    {
        if (Auth::user()->profile_photo_path == 'zapros') {
            $ticket = Ticket::where('department_id',Auth::user()->type_zapros)->get();


            return view('tickets.index_cc',[
                'ticket' => $ticket,

            ]);
        }else {
            $ticket = Ticket::all();
            $department = TicketDepartment::all();

            return view('tickets.index',[
                'ticket' => $ticket,
                'department' => $department
            ]);
        }

    }

    public function showAddTicket()
    {

    }

    public function postAddTicket(Request $request)
    {
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'required',
        ]);

        $fileName = 0;

        if ($request->hasFile('file')) {
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('images'), $fileName);
            $imageUrl = 'https://aea-ls.kz/public/images/'.$fileName;

        }
        $ticket  = Ticket::create([
            'department_id' => $request->dep_id,
            'user_id' => Auth::id(),
            'description' => $request->description ?? null,
            'photo' => $fileName,
            'location' => $request->location,
        ]);

        $department = TicketDepartment::find($request->dep_id);

        $message = "Заявка № <span>".$ticket->id."</span>
            <br/>
            <p>Локация: ".$request->location."</p>
            <p>Описание: ".$request->description ?? null ."</p>
            <p>Фотография: <img src='{{ $imageUrl }}'></p>
            <br>
            <i>Это письмо отправлено <b>роботом</b>
            и отвечать на него не нужно!</i>";
         $this->sendToEmail('qwsdoam@gmail.com',$message);

        return redirect()->back()->with('success','Успешно добавлено!');
    }

    public function approve($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 1 ;
        if ($ticket->save()) {
            return redirect()->back()->with('success','Статус успешно изменено!');
        }
        return redirect()->back()->with('danger','Попробуйте заново!');
    }

    public function department()
    {
        $dep = TicketDepartment::all();

        return view('tickets.department_index',[
            'dep' => $dep
        ]);
    }

    public function postAddDepartment(Request $request)
    {
        $dep = new TicketDepartment();
        $dep->title = $request->title;

        if ($dep->save()) {
            return redirect()->back()->with('success','Успешно добавлено');
        }
    }

    private function sendToEmail($to, $message)
    {
        $subject = "Robot - Бизнес Парк Заявки";
        $headers = "From: AeaLS.kz <support@aea-ls.kz>\r\nContent-type: text/html; charset=utf-8 \r\n";
        $d = mail($to, $subject, $message, $headers);
        if ($d) {
            return true;
        }
        return false;
    }
}
