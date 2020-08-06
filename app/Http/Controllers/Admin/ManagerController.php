<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManagerController extends Controller
{
    public function index()
    {
      $data = array();
      $data['managers'] = manager::all();

      return view('admin.pages.manager.managers',compact('data'));
    }

    public function tampilHalamanTambah()
    {
        return view('admin.pages.manager.tambah-edit');
    }

    public function tambahData(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'image', 'max:500'],
            'name' => 'required',
            'position' => 'required'
        ]);
        $manager = new manager;
        $manager->name = $request->name;
        $manager->image = "a";
        $manager->position = $request->position;
        $manager->position_desc = $request->position_desc;
        $manager->save();

        //UPLOAD FOTO SAMPUL
        $extension = $request->file('image')->getClientOriginalExtension();
        // File upload location
        $location = 'images/foto-pengurus';
        $nameUpload = 'pengurus-'. $manager->id . '.' . $extension;
        // Upload file
        $request->file('image')->move('assets/' . $location, $nameUpload);
        // Import CSV to Database
        $filepath = $location . "/" . $nameUpload;
        $manager->image = $filepath;
        //END UPLOAD FOTO SAMPUL
        $manager->save();

        return redirect(route('admin_manager'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan data pengurus.');
    }

    public function hapus($id)
    {
        $manager = manager::find($id);

        File::delete('assets/' . $manager->image);
        $manager->delete();
        return response()->json(['OK' => 200]);
        // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
    }

    public function tampilEditPengurus($id)
    {
        $data = array();
        $data['manager'] = manager::find($id);
        return view('admin.pages.manager.tambah-edit', compact('data'));
    }

    public function editBlog($id, Request $request)
    {
        $this->validate($request, [
            'image' => ['image', 'max:500'],
            'name' => 'required',
            'position' => 'required'
        ]);
        $manager = manager::find($id);
        $manager->name = $request->name;
        $manager->position = $request->position;
        $manager->position_desc = $request->position_desc;
        if ($request->file('image') != "") {
          //UPLOAD FOTO SAMPUL
          $extension = $request->file('image')->getClientOriginalExtension();
          // File upload location
          $location = 'images/foto-pengurus';
          $nameUpload = 'pengurus-'. $manager->id . '.' . $extension;
          // Upload file
          $request->file('image')->move('assets/' . $location, $nameUpload);
          // Import CSV to Database
          $filepath = $location . "/" . $nameUpload;
          $manager->image = $filepath;
          //END UPLOAD FOTO SAMPUL
        }
        
        $manager->save();

        return redirect(route('admin_manager'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil mengubah data pengurus.');
    }
}
