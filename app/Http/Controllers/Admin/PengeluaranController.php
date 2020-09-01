<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use DateTime;

class PengeluaranController extends Controller
{

    public function index()
    {
        // $data['pengeluaran'] = Pengeluaran::all();
        // return view('admin.pages.Pengeluaran.Pengeluaran', compact('data'));
        return view('admin.pages.Pengeluaran.Pengeluaran');
    }

    public function getAll()
    {
        $data = Pengeluaran::all();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]->nom_tampil = number_format($data[$i]->nominal, 0, '.', '.');
            $data[$i]->waktu = $data[$i]->created_at->format('d/m/Y');
            // $data[$i]->created_at = "";
        }
        return response()->json($data);
    }

    public function tambah(Request $request)
    {
        $pengeluaran = new Pengeluaran;
        $pengeluaran->nama_keperluan = $request->ket;
        $pengeluaran->nominal = str_replace(',', '', $request->nom);
        $pengeluaran->created_at = Carbon::createFromFormat('d/m/Y',  $request->tgl);
        $pengeluaran->save();
        return response()->json('ok');
    }

    public function edit_dong(Request $request)
    {
        $pengeluaran = Pengeluaran::find($request->id);
        $pengeluaran->nama_keperluan = $request->ket;
        $pengeluaran->nominal = str_replace(',', '', $request->nom);
        $pengeluaran->created_at = Carbon::createFromFormat('d/m/Y',  $request->tgl);
        $pengeluaran->save();
        return response()->json('ok');
    }

    public function hapus_dong($id)
    {
        Pengeluaran::find($id)->delete();
        return response()->json('ok');
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
