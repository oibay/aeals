<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index()
    {
        $companies = User::companies();
        $guestCount = Guest::where(['status' => 2])->count();
        return view('admin.company',[
            'companies' => $companies,
            'guestCount' => $guestCount
        ]);
    }

    public function showEdit($id)
    {
        $user = User::find($id);

        return view('admin.company-edit',[
            'user' => $user
        ]);
    }

    public function postCompany(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'company'
        ]);

        if ($user) {
            return redirect()->back()->with('success','Успешно добавлено');
        }

        return redirect()->back()->with('danger','Повторите позже!');
    }

    public function postEditCompany(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        if ($user->save()) {
            return redirect()->back()->with('success','Успешно обновлено');
        }
        return redirect()->back()->with('danger','Повторите позже!');
    }
}



