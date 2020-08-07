<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\blog;
use App\Models\Frontend\Donasi;
use App\Models\Frontend\kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  public function index()
  {
    $donasi = DB::table('donasis')
      ->whereExists(function ($query) {
        $query->from('donasi_masuks')
          ->whereRaw('donasi_masuks.donasi_id = donasis.id');
      });

    $data['donasi'] = $donasi->select(
      DB::raw('MONTH(created_at) as month'),
      DB::raw('SUM(total_donasi) as sum')
    )
      ->whereMonth('created_at', '=', Carbon::now()->month)
      ->groupBy('month')
      ->first();
    $data['kebutuhan'] = 10000000;

    $data['blogs'] = blog::with('users:id,nama')->latest()->paginate(4);
    return view('frontend.pages.home', $data);
  }
  //
  public function donation(Request $request)
  {
    // untuk validasi form
    $this->validate($request, [
      'name' => 'required',
      'donasi' => 'required',
      'bank' => 'required',
      'image' => 'required'
    ]);

    if ($files = $request->file('image')) {
      $destinationPath = 'assets/images/bukti_transfer'; // upload path
      $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
      $files->move($destinationPath, $profileImage);
      $image = "images/bukti_transfer/$profileImage";
    }

    // insert data ke table books
    $donasi = Donasi::create([
      'nama_donatur' => $request->name,
      'total_donasi' => $request->donasi,
      'nama_bank' => $request->bank,
      'image_path' => $image
    ]);

    return response()->json(['code' => 200, 'message' => 'Donation Created successfully', 'data' => $donasi], 200);
  }
}
