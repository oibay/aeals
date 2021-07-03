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
        $ticket  = Ticket::create([
            'department_id' => $request->dep_id,
            'user_id' => Auth::id(),
            'description' => $request->description,
        ]);

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
}
