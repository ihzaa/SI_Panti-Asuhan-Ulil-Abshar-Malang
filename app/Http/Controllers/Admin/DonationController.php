<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Donasi;
use App\Models\Frontend\DonasiMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
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
          return \Carbon\Carbon::parse($row->created_at)->toDayDateTimeString();
        })
        ->addColumn('total_donasi', function ($row) {
          $hasil_rupiah = "Rp " . number_format($row->total_donasi, 2, ',', '.');
          return $hasil_rupiah;
        })
        ->addColumn('image', function ($row) {
          return '<a target="_blank" href="' . asset($row->image_path) . '"><img src="' . asset($row->image_path) . '" alt="" width="150"></a>';
        })
        ->rawColumns(['action', 'image'])
        ->make(true);
    }
    return view('admin.pages.donasi');
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
          return \Carbon\Carbon::parse($row->created_at)->toDayDateTimeString();
        })
        ->addColumn('total_donasi', function ($row) {
          $hasil_rupiah = "Rp " . number_format($row->total_donasi, 2, ',', '.');
          return $hasil_rupiah;
        })
        ->addColumn('image', function ($row) {
          return '<a target="_blank" href="' . asset($row->image_path) . '"><img src="' . asset($row->image_path) . '" alt="" width="150"></a>';
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
}
