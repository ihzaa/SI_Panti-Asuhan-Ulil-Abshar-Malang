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
        $data['blogs'] = blog::with('users:id,nama')->orderBy('id', 'DESC')->paginate(5);
        $data['kategoris'] = kategori::withCount(['blog'])->orderBy('nama')->get();
        // return $data;
        return view('frontend.pages.Blog.blog', compact('data'));
    }

    public function single_blog($id)
    {
        $data = array();
        $data['kategoris'] = kategori::withCount(['blog'])->orderBy('nama')->get();
        blog::find($id)->increment('jumlah_dibaca');
        $data['blog'] = blog::find($id);
        return view('frontend.pages.Blog.single-blog', compact('data'));
    }
}
