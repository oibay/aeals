<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventFood;
use App\Models\EventFoodTime;
use App\Models\Guest;
use Illuminate\Http\Request;

class EventFoodController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index()
    {
        $event = EventFood::where(['status' => 1])->get();
        foreach($event as $it) {
            if (date('d-m-Y',strtotime($it->created_at))
                != date('d-m-Y')) {
                EventFood::where('id',$it->id)->update(['status' => 2]);
            }
        }
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.eventfood',[
            'event' => $event,
            'guestCount' => $guestCount
        ]);
    }

    public function show($id)
    {
        $event = EventFood::findOrFail($id);
        $guests = Guest::eventGuests(\request()->location);
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.eventfood-view',[
            'event' => $event,
            'guests' => $guests,
            'guestCount' => $guestCount
        ]);
    }

    public function postEvent(Request $request)
    {
        $event = new EventFood();
        $event->title = date('Y-m-d H:i:s');
        $event->status = 1;
        if ($event->save()) {
            return redirect()->back()->with('success','Успешно добавлено');
        }
    }

    public function eventFoods()
    {

        EventFoodTime::create([
            'user_id' => \request()->user,
            'vouchers' => \request()->q,
            'event_id' => \request()->event
        ]);

        return redirect()->back()->with('success','Успешно');
    }
}
