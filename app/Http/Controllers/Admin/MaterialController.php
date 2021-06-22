<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestMaterial;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','access:admin']);
    }

    public function index()
    {
        $materials = Material::all();

        return view('admin.materials.index',[
            'materials' => $materials
        ]);
    }

    public function showEdit($id)
    {
        $material = Material::findOrFail($id);

        return view('admin.materials.material-edit',[
            'material' => $material
        ]);
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $material = new Material();
        $material->title = $request->title;
        if ($material->save()) {
            return redirect()->back()->with('success','Успешно добавлено');
        }

        return redirect()->back()->with('danger','Попробуйте позже!');
    }

    public function postEdit(Request $request,$id)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $material = Material::findOrFail($id);

        $material->title = $request->title;
        if ($material->save()) {
            return redirect()->back()->with('success','Успешно редактировано');
        }

        return redirect()->back()->with('danger','Попробуйте позже!');
    }

    public function userPost(Request $request,$id)
    {
         if ($request->materials) {
             GuestMaterial::where(['guest_id' => $id])->delete();
             foreach ($request->materials as $key => $value) {
                 GuestMaterial::create([
                     'guest_id' => $id,
                     'material_id' => $key
                 ]);

             }
            return redirect()->back()->with('success','Успешно выполнено');
         }
        return redirect()->back()->with('danger','Попробуйте позже!');
    }
}
