<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  //
  public function donation(Request $request)
  {
    // untuk validasi form
    $this->validate($request, [
      'name' => 'required',
      'donasi' => 'required',
      'bank' => 'required',
    ]);

    // insert data ke table books
    $donasi = Donasi::create([
      'nama_donatur' => $request->name,
      'total_donasi' => $request->donasi,
      'nama_bank' => $request->bank,
    ]);

    return response()->json(['code' => 200, 'message' => 'Donation Created successfully', 'data' => $donasi], 200);
    // DB::table('donasis')->insert([
    //   'nama_buku' => $request->name,
    //   'tipe_buku' => $request->type,
    //   'stock_buku' => $request->stock,
    //   'penulis' => $request->writer,
    //   'penerbit' => $request->publisher,
    //   'tanggal_terbit' => $request->date
    // ]);
    // alihkan halaman tambah buku ke halaman books
    // return redirect('/books')->with('status', 'Data Buku Berhasil Ditambahkan');
  }
}
