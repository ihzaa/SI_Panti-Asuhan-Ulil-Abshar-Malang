<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\sarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FasilitasController extends Controller
{
    public function index()
    {
      $data = array();
      $data['sarana'] = sarana::all();

      return view('admin.pages.fasilitas.fasilitas',compact('data'));
    }

    public function tampilHalamanTambah()
    {
        return view('admin.pages.fasilitas.tambah-edit');
    }

    public function tambahData(Request $request)
    {
        $this->validate($request, [
            'image' => ['image', 'max:1500','dimensions:min_width=560'],
            'name' => 'required',
            'jumlah' => 'required'
        ]);
        $sarana = new sarana;
        $sarana->name = $request->name;
        $sarana->total = $request->jumlah;
        $sarana->save();

        if ($request->file('image') != "") {
          //UPLOAD FOTO SAMPUL
          $extension = $request->file('image')->getClientOriginalExtension();
          // File upload location
          $location = 'images/foto-fasilitas';
          $nameUpload = 'Fasilitas-' . $sarana->id . '.' . $extension;
          // Upload file
          $request->file('image')->move('assets/' . $location, $nameUpload);
          // Import CSV to Database
          $filepath = $location . "/" . $nameUpload;
          $sarana->image = $filepath;
          //END UPLOAD FOTO SAMPUL
        }

        $sarana->save();

        return redirect(route('admin_fasilitas'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan data fasilitas.');
    }

    public function hapus($id)
    {
        $sarana = sarana::find($id);
        $sarana->delete();
        return response()->json(['OK' => 200]);
        // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
    }

    public function tampilEditFasilitas($id)
    {
        $data = array();
        $data['sarana'] = sarana::find($id);
        return view('admin.pages.fasilitas.tambah-edit', compact('data'));
    }

    public function editFasilitas($id, Request $request)
    {
        $this->validate($request, [
            'image' => ['image', 'max:1500', 'dimensions:min_width=560'],
            'name' => 'required',
            'jumlah' => 'required'
        ]);
        $sarana = sarana::find($id);
        $sarana->name = $request->name;
        $sarana->total = $request->jumlah;

        
        
        if ($request->file('image') != "") {
          unlink('assets/'.$sarana->image);
          //UPLOAD FOTO SAMPUL
          $extension = $request->file('image')->getClientOriginalExtension();
          // File upload location
          $location = 'images/foto-fasilitas';
          $nameUpload = 'Fasilitas-' . $id  . '.' . $extension;
          // Upload file
          $request->file('image')->move('assets/' . $location, $nameUpload);
          // Import CSV to Database
          $filepath = $location . "/" . $nameUpload;
          $sarana->image = $filepath;
          //END UPLOAD FOTO SAMPUL
        }

        $sarana->save();

        return redirect(route('admin_fasilitas'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil mengubah data fasilitas.');
    }
}
