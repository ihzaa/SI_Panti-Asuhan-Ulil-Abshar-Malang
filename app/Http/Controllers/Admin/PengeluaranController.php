<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{

    public function index()
    {
        $data['pengeluaran'] = Pengeluaran::all();

        return view('admin.pages.Pengeluaran.Pengeluaran', compact('data'));
    }

    public function HalamanTambah()
    {
        return view('admin.pages.pengeluaran.tambah-edit');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'pengeluaran' => 'required',
            'nominal' => 'required',
            'date' => 'required',

        ]);
        $pengeluaran = new Pengeluaran;
        $pengeluaran->nama_keperluan = $request->pengeluaran;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->created_at = $request->date;


        $pengeluaran->save();


        return redirect(route('admin_pengeluaran'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan pengeluaran.');
    }


    public function tampilEdit($id)
    {
        $data = array();
        $data['pengeluaran'] = Pengeluaran::find($id);
        return view('admin.pages.Pengeluaran.tambah-edit', compact('data'));
    }

    public function edit($id, Request $request)
    {
        $this->validate($request, [

            'pengeluaran' => 'required',
            'nominal' => 'required',
            'date' => 'required',


        ]);
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->nama_keperluan = $request->pengeluaran;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->created_at = $request->date;

        $pengeluaran->save();

        return redirect(route('admin_pengeluaran'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil mengubah data pengeluaran.');
    }


    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return response()->json(['OK' => 200]);
        // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
    }
}
