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
        return view('admin.pages.dashboard', compact('data'));
    }
}
