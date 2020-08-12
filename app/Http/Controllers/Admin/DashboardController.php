<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\blog;
use App\Models\Frontend\Donasi;
use App\Models\Frontend\DonasiMasuk;
use App\Models\Frontend\manager;
use App\Models\Frontend\Produk;
use App\Models\Frontend\ProfilAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['pengurus'] = manager::count();
        $data['anak'] = ProfilAnak::count();
        $data['produk'] = Produk::count();
        $data['blog'] = blog::count();
        $data['donasi_masuk'] = DonasiMasuk::count();
        $masuk = DonasiMasuk::pluck('donasi_id');
        $data['donasi_belum'] = Donasi::whereNotIn('id', $masuk)->count();
        $data['donasi'] = array();
        $data['total_donasi'] = 0;
        for ($i = 1; $i <= 12; $i++) {
            $total = DB::table('donasis')->select(DB::raw('sum(total_donasi) as total'))->whereIn('id', $masuk)->whereMonth('created_at', '=', "$i")->whereYear('created_at', '=', date('Y'))->pluck('total');
            array_push($data['donasi'], $total[0] == null ? "0" : $total[0]);
            $data['total_donasi'] += $total[0];
        }

        return view('admin.pages.dashboard', compact('data'));
    }
}
