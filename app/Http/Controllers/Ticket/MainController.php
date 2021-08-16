<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Models\TicketDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\File;


class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'access:tickets']);
    }

    public function index()
    {
        if (Auth::user()->profile_photo_path == 'zapros') {
            $ticket = Ticket::where('department_id', Auth::user()->type_zapros)->get();
            return view('tickets.index_cc', [
                'ticket' => $ticket,
            ]);
        } else {
            $ticket = Ticket::where('user_id', Auth::id())->get();
            $department = TicketDepartment::all();

            return view('tickets.index', [
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
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'location' => 'required',
        ]);

        $fileName = 0;
        $urlFile = '';
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $fileName);
            $urlFile = 'https://aea-ls.kz/public/images/' . $fileName;

        }
        $ticket = Ticket::create([
            'department_id' => $request->dep_id,
            'user_id' => Auth::id(),
            'description' => $request->description ?? null,
            'photo' => $fileName,
            'location' => $request->location,
        ]);
        $user = User::where('type_zapros', $request->dep_id)->first();

        $department = TicketDepartment::find($request->dep_id);
        $message = "Здравствуйте " . $user->name . "\nЗаявка от " . Auth::user()->name . "\nЗаявка № *" . $ticket->id . "*\nЛокация: *" . $request->location . "* \nОтдел: *" . $department->title . "*\nСтатус:*Ожидает*\nОписание:" . $request->description . "";

        if (Auth::user()->profile_photo_path == 'zakup') {


            $messageSend = "
        <p><img src='" . $urlFile . "' alt=''></p>
        <p>Здравствуйте <strong>Али</strong></p>

            <p>Заявка № <em>" . $ticket->id . "</em></p>

            <p>Локация: <u><em>" . $request->location . "</em></u></p>

            <p>Отдел: <em>" . $department->title . "</em></p>

            <p>Статус: <strong>Ожидает</strong> <a href='https://aea-ls.kz/req/approved/" . $ticket->id . "'><button>Подтвердить</button></a></p>
            <p>Описание: <strong>" . $request->description . "</strong></p>
            <p>&nbsp;</p>
            <p><br />
            <em>Это письмо отправлено <strong>роботом</strong> и отвечать на него не нужно!</em></p>

        ";
            //$this->sendToEmail("Новая Заявка №" . $ticket->id, $messageSend);
        }


        try {


            Notification::route('telegram', $user->telegramid)
                ->notify(new \App\Notifications\Telegram($message, $urlFile, $ticket->id, $user));

            $array = [829600339, 754572114, 337997800];
            foreach ($array as $item) {
                Notification::route('telegram', $item)
                    ->notify(new \App\Notifications\Telegram($message, $urlFile, $ticket->id, $user, 1));
            }

        } catch (\Exception $exception) {
            ($exception->getMessage());
        }

        return redirect()->back()->with('success', 'Успешно добавлено!');
    }

    public function approve($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 1;
        if ($ticket->save()) {
            if ($ticket->photo) {
                $ticket = Ticket::find($ticket->id);
                unlink(public_path('images/' . $ticket->photo));
                $ticket->photo = null;
                $ticket->save();
            }
            $message = "Заявка № <span>" . $ticket->id . "</span>
            <br/>
            <p>Локация: " . $ticket->location . "</p>
			<p>Отдел: " . $ticket->title . "</p>
            <p>Статус: <span style='color:green;font-size:20px;font-weight:bold;'>Закрыт</span></p>
            <br>
            <i>Это письмо отправлено <b>роботом</b>
            и отвечать на него не нужно!</i>";


            return redirect()->back()->with('success', 'Статус успешно изменено!');
        }
        return redirect()->back()->with('danger', 'Попробуйте заново!');
    }

    public function department()
    {
        $dep = TicketDepartment::all();

        return view('tickets.department_index', [
            'dep' => $dep
        ]);
    }

    public function postAddDepartment(Request $request)
    {
        $dep = new TicketDepartment();
        $dep->title = $request->title;

        if ($dep->save()) {
            return redirect()->back()->with('success', 'Успешно добавлено');
        }
    }


    public function users()
    {
        $users = User::where(['profile_photo_path' => 'zapros'])->get();
        $department = TicketDepartment::all();

        return view('tickets.users', [
            'users' => $users,
            'department' => $department
        ]);
    }

    public function postAddUsers(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = Uuid::uuid4()->toString() . '@gmail.com';
        $user->password = bcrypt(123456);
        $user->telegramid = $request->telegramid;
        $user->type_zapros = $request->dep_id;
        $user->profile_photo_path = 'zapros';
        $user->role = 'tickets';

        if ($user->save()) {
            return redirect()->back()->with('success', 'Успешно обновлено');
        }

        return redirect()->back()->with();
    }


    private function sendToEmail($subject, $message)
    {
        $subject = $subject;
        $headers = "From: AeaLS.kz <support@aea-ls.kz>\r\nContent-type: text/html; charset=utf-8 \r\n";
        $d = mail('bizzpar0k@gmail.com', $subject, $message, $headers);
        if ($d) {
            return true;
        }
        return false;
    }


}
