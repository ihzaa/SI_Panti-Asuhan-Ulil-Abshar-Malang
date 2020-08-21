<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\blog;
use App\Models\Frontend\Donasi;
use App\Models\Frontend\kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Frontend\manager;
use App\Models\Frontend\sarana;
use App\Models\Frontend\ProfilAnak;

class HomeController extends Controller
{
  public function index()
  {
    $data['last_3month'] = DB::table('donasis')
      ->whereExists(function ($query) {
        $query->from('donasi_masuks')
          ->whereRaw('donasi_masuks.donasi_id = donasis.id');
      })->select(
        // DB::raw('DATE_FORMAT(created_at, "%b") as month'),
        DB::raw('MONTHNAME(created_at) as month'),
        DB::raw('SUM(total_donasi) as sum')
      )
      ->whereMonth('created_at', '<', Carbon::now()->month)
      ->whereMonth('created_at', '>=', Carbon::now()->subMonth(3)->month)
      ->orderBy('month', 'desc')
      ->groupBy('month')
      ->get();

    $jml = count($data['last_3month']);
    $data['jml_last_3month'] = $jml == 2 ? 6 : ($jml == 1 ? 12 : 4);

    $data['donasi'] = DB::table('donasis')
      ->whereExists(function ($query) {
        $query->from('donasi_masuks')
          ->whereRaw('donasi_masuks.donasi_id = donasis.id');
      })->select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(total_donasi) as sum')
      )
      ->whereMonth('created_at', '=', Carbon::now()->month)
      ->groupBy('month')
      ->first();


    $data['donatur_terbaru'] = DB::table('donasis')
      ->whereExists(function ($query) {
        $query->from('donasi_masuks')
          ->whereRaw('donasi_masuks.donasi_id = donasis.id');
      })
      ->whereMonth('created_at', '=', Carbon::now()->month)
      ->orderBy('created_at', 'desc')
      ->take(3)
      ->get();

    $data['jml_hari'] = $this->jumlahHari(Carbon::now()->month, Carbon::now()->year);
    $data['day_now'] = Carbon::now()->day;
    $data['pengurus'] = manager::count();
    $data['anak_asuh'] = ProfilAnak::count();
    $data['sarana'] = sarana::count();

    $data['blogs'] = blog::with('users:id,nama')->latest()->paginate(4);

    return view('frontend.pages.Home.home', $data);
  }

  function jumlahHari($month, $year)
  {
    $hari = date('t', mktime(0, 0, 0, $month, 1, $year));
    return $hari;
  }
  //
  public function donation(Request $request)
  {
    // untuk validasi form
    $this->validate($request, [
      'name' => 'required',
      'nama_alias' => 'required',
      'donasi' => 'required',
      'bank' => 'required',
    ]);

    // insert data ke table books
    $donasi = Donasi::create([
      'nama_donatur' => $request->name,
      'nama_alias' => $request->nama_alias,
      'total_donasi' => $request->donasi,
      'nama_bank' => $request->bank,
      'email' => $request->email,
    ]);

    return response()->json(['code' => 200, 'message' => 'Donation Created successfully', 'data' => $donasi], 200);
  }
}
