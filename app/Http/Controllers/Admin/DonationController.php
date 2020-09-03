<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Frontend\Donasi;
use App\Models\Frontend\DonasiMasuk;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class DonationController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = DB::table('donasis')
        ->whereNotExists(function ($query) {
          $query->from('donasi_masuks')
            ->whereRaw('donasi_masuks.donasi_id = donasis.id');
        })
        ->get();
      return Datatables::of($data)
        ->addIndexColumn()

        ->addColumn('action', function ($row) {
          $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Confirm" class="edit btn btn-primary btn-sm confirmDonation"><i class="fas fa-check"></i></a>';

          $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDonation"><i
          class="fas fa-trash"></i></a>';
          return $btn;
        })
        ->addColumn('created_at', function ($row) {
          return \Carbon\Carbon::parse($row->created_at)->translatedFormat("l, d F Y h:i a");
        })
        ->addColumn('total_donasi', function ($row) {
          $hasil_rupiah = "Rp " . number_format($row->total_donasi, 2, ',', '.');
          return $hasil_rupiah;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    $data['bank'] = Bank::all();
    return view('admin.pages.Donasi.donasi', $data);
  }

  public function donasi_masuk(Request $request)
  {
    if ($request->ajax()) {
      $data = DB::table('donasis')
        ->whereExists(function ($query) {
          $query->from('donasi_masuks')
            ->whereRaw('donasi_masuks.donasi_id = donasis.id');
        })
        ->get();
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Confirm" class="edit btn btn-warning btn-sm cancelConfirm"><i class="fas fa-backspace"></i></a>';

          $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDonation"><i
          class="fas fa-trash"></i></a>';
          return $btn;
        })
        ->addColumn('created_at', function ($row) {
          return \Carbon\Carbon::parse($row->created_at)->translatedFormat("l, d F Y h:i a");
        })
        ->addColumn('total_donasi', function ($row) {
          $hasil_rupiah = "Rp " . number_format($row->total_donasi, 2, ',', '.');
          return $hasil_rupiah;
        })
        ->rawColumns(['action', 'image'])
        ->make(true);
    }

    return view('admin.pages.Donasi.index');
  }

  public function cancel_confirmation($id)
  {
    DonasiMasuk::where('donasi_id', $id)->delete();

    return response()->json(['code' => 200, 'message' => 'Donation Created successfully', 'data' => $id], 200);
  }

  public function confirmation($id)
  {
    DonasiMasuk::create(['donasi_id' => $id]);

    $donasi = Donasi::find($id);
    if ($donasi->email != "") {
      $details = [
        'tgl_buat' => '',
        'title' => "Terima kasih $donasi->nama_donatur atas donasi anda",
        'total' => $donasi->total_donasi,
        'bank' => $donasi->nama_bank,
        'nama' => $donasi->nama_donatur,
        'tgl' => Carbon::parse($donasi->created_at)->translatedFormat("l, d F Y h:i a")
      ];
      Mail::to($donasi->email)->send(new \App\Mail\Donatur\DonaturEmailKonfirmasi($details));
    }
    return response()->json(['code' => 200, 'message' => 'Donation Created successfully', 'data' => $id], 200);
  }

  public function delete($id)
  {
    $donasi = Donasi::find($id);
    File::delete('assets/' . $donasi->image_path);
    $donasi_masuk = DonasiMasuk::where('donasi_id', $id);
    $donasi_masuk->delete();
    $donasi->delete();
    return response()->json(['OK' => 200]);
    // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
  }

  public function testing()
  {
    $details = [
      'title' => "Terima kasih ja atas donasi anda",
      'total' => "120000",
      'bank' => "Mandiri",
      'nama' => "Ihza AHmad"
    ];
    Mail::to("ihzaahmad0@gmail.com")->send(new \App\Mail\Donatur\DonaturEmailKonfirmasi($details));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'nama_asli' => 'required',
      'donasi' => 'required',
      // 'bank' => 'required',
    ]);

    // insert data ke table books
    $donasi = Donasi::create([
      'created_at' => $request->date_create,
      'nama_donatur' => $request->nama_asli,
      'nama_alias' => $request->nama_alias,
      'total_donasi' => $request->rupiah,
      'nama_bank' => $request->bank,
      'email' => $request->email,
      'alamat' => $request->alamat
    ]);

    DonasiMasuk::create(['donasi_id' => $donasi->id]);

    if ($request->email != "") {
      $details = [
        'tgl_buat' => $request->date_create,
        'title' => "Terima kasih $request->nama_asli atas donasi anda",
        'total' => $request->rupiah,
        'bank' => $request->bank,
        'nama' => $request->nama_asli,
        'tgl' => Carbon::parse($donasi->created_at)->translatedFormat("l, d F Y h:i a")
      ];
      Mail::to($donasi->email)->send(new \App\Mail\Donatur\DonaturEmailKonfirmasi($details));
    }

    return $request;
  }
}
