<?php


namespace App\Http\Controllers\Ticket;


use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Ticket;

class AnalyticsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','access:analytics']);
    }

    public function index()
    {
        $guests = Guest::checkInAnalytics();

        return view('analytics.index',[
            'guests' => $guests
        ]);
    }

    public function guests()
    {
        $guests = Guest::guestsAnalytics();

        return view('analytics.guests',[
            'guests' => $guests
        ]);
    }

    public function requests()
    {
        $ticket = Ticket::all();

        return view('analytics.requests',[
            'ticket' => $ticket,

        ]);
    }

}
