<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProdukController extends Controller
{
    public function index()
    {
        $data = array();
        $data['produk'] = produk::all();
  
        return view('frontend.pages.produk',compact('data'));
    }

}
