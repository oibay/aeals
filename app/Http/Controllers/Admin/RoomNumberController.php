<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomNumber;
use Illuminate\Http\Request;

class RoomNumberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index()
    {
        $room = RoomNumber::all();

        return view('admin.room.index',[
            'room' => $room
        ]);
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'number' => ['required','integer'],
            'location' => 'required'
        ]);

        $add = new RoomNumber();
        $add->number = $request->number;
        $add->location = $request->location;
        if ($add->save()) {
            return redirect()->back()->with('success','Успешно добавлено');
        }
        return redirect()->back()->with('danger','Попробуйте позже!');
    }

    public function showEdit($id)
    {
        $room = RoomNumber::findOrFail($id);

        return view('admin.room.edit',[
            'room' => $room
        ]);
    }

    public function postEdit(Request $request,$id)
    {
        $request->validate([
            'number' => ['required','integer','digits_between:2,5'],
            'location' => 'required'
        ]);

        $edit = RoomNumber::findOrfail($id);
        $edit->number = $request->number;
        $edit->location = $request->location;
        if ($edit->save()) {
            return redirect()->back()->with('success','Успешно редактировано');
        }

        return redirect()->back()->with('danger','Попробуйте позже!');
    }
}
