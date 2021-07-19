<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Models\TicketDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

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


        }
        $ticket  = Ticket::create([
            'department_id' => $request->dep_id,
            'user_id' => Auth::id(),
            'description' => $request->description ?? null,
            'photo' => $fileName,
            'location' => $request->location,
        ]);

        $department = TicketDepartment::find($request->dep_id);
        $message = "Заявка № *".$ticket->id."*\nЛокация: *".$request->location."* \nОтдел: *".$department->title."*\nСтатус:*Ожидает*\nЭто письмо отправлено роботом и отвечать на него не нужно!";

        //$this->sendToEmail('qwsdoam@gmail.com',$message);

        try {
            Notification::route('telegram', '337997800')
                ->notify(new \App\Notifications\Telegram($message));
        }catch (\Exception $exception) {
            $exception->getMessage();
        }

        return redirect()->back()->with('success','Успешно добавлено!');
    }

    public function approve($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 1 ;
        if ($ticket->save()) {
            $message = "Заявка № <span>".$ticket->id."</span>
            <br/>
            <p>Локация: ".$ticket->location."</p>
			<p>Отдел: ".$ticket->title."</p>
            <p>Статус: <span style='color:green;font-size:20px;font-weight:bold;'>Закрыт</span></p>
            <br>
            <i>Это письмо отправлено <b>роботом</b>
            и отвечать на него не нужно!</i>";

            $this->sendToEmail('qwsdoam@gmail.com',$message);
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

    public function users()
    {
        $users = User::where(['profile_photo_path' => 'zapros'])->get();
        $department = TicketDepartment::all();

        return view('tickets.users',[
            'users' => $users,
            'department' => $department
        ]);
    }

    public function postAddUsers(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = Uuid::uuid4()->toString().'@gmail.com';
        $user->password = bcrypt(123456);
        $user->type_zapros = $request->dep_id;
        $user->profile_photo_path = 'zapros';
        $user->role = 'tickets';

        if ($user->save()) {
            return redirect()->back()->with('success','Успешно обновлено');
        }

        return redirect()->back()->with();
    }
}
