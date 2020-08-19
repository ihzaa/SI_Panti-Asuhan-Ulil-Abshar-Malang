<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Produk;
use App\Models\gambar_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProdukController extends Controller
{
    public function index()
    {
        
        $data= Produk::paginate(6);
  
        return view('frontend.pages.produk',compact('data'));
    }

    public function produk_detail($id)
    {
       
        $data['produk']= Produk::find($id);
        $data['gambar'] = gambar_detail::where('produk_id', $id)->get();

        return view('frontend.pages.produk_detail', compact('data'));
    }

}
