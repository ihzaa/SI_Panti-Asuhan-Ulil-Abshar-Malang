<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Donasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  public function index()
  {
    $data = DB::table('donasis')
      ->whereExists(function ($query) {
        $query->from('donasi_masuks')
          ->whereRaw('donasi_masuks.donasi_id = donasis.id');
      });

    $months['donasi'] = $data->select(
      DB::raw('MONTH(created_at) as month'),
      DB::raw('SUM(total_donasi) as sum')
    )
      ->whereMonth('created_at', '=', Carbon::now()->month)
      ->groupBy('month')
      ->first();
    $months['kebutuhan'] = 10000000;
    return view('frontend.pages.home', $months);
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
