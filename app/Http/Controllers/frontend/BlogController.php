<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\blog;
use App\Models\Frontend\kategori;

class BlogController extends Controller
{
    public function index()
    {
        $data = array();
        $data['blogs'] = blog::with('users:id,name')->orderBy('id', 'DESC')->paginate(5);
        $data['kategoris'] = kategori::withCount(['blog'])->orderBy('nama')->get();
        // return $data;
        return view('frontend.pages.blog', compact('data'));
    }
}
