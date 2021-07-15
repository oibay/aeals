<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventFood;
use App\Models\EventFoodTime;
use App\Models\Guest;
use Carbon\Carbon;
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
            'guestCount' => $guestCount,
            'eventArchive' => 2,
            'eventNowExists' => EventFood::whereDate('created_at',Carbon::now())->exists(),
        ]);
    }

    public function show($id)
    {
        $event = EventFood::findOrFail($id);


        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.eventfood-view',[
            'event' => $event,
            'guestCount' => $guestCount
        ]);
    }

    public function postEvent(Request $request)
    {
        $event = new EventFood();
        $event->title = date('Y-m-d');
        $event->status = 1;
        if ($event->save()) {
            $guests = Guest::guests();
            foreach($guests as $item) {
                EventFoodTime::create([
                    'user_id' => $item->id,
                    'vouchers' => null,
                    'event_id' => $event->id
                ]);
            }
            return redirect()->back()->with('success','Успешно добавлено');
        }
    }

    public function eventFoods()
    {

        $event = EventFoodTime::where(['event_id' => \request()->event,'user_id' => \request()->user])->first();
        switch (\request()->q) {
            case 'Завтрак':
                $event->vouchers = \request()->q;
                $event->save();
            break;
            case 'Обед':
                $event->lunch = \request()->q;
                $event->save();

            break;
            case 'Ужин':
                $event->dinner = \request()->q;
                $event->save();
            break;
        }

        return redirect()->back()->with('success','Успешно');
    }

    public function archive()
    {
        $event = EventFood::where(['status' => 2])->get();

        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.eventfood',[
            'event' => $event,
            'guestCount' => $guestCount,
            'eventArchive' => 1
        ]);
    }


}
