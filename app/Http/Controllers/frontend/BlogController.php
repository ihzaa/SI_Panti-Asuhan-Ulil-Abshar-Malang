<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\blog;
use App\Models\Frontend\blog_kategori;
use App\Models\Frontend\kategori;
use Illuminate\Http\Request;

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

    public function cari($cari)
    {
        $data = array();
        $data['blogs'] = blog::with('users:id,nama')->where('judul', 'LIKE', '%' . strtoupper(urldecode($cari)) . '%')->orderBy('id', 'DESC')->paginate(5);
        $data['kategoris'] = kategori::withCount(['blog'])->orderBy('nama')->get();
        // return $data;
        return view('frontend.pages.Blog.blog', compact('data'));
    }

    public function kategori($kat)
    {
        $data = array();
        $arr_id = blog_kategori::where('kategori_id', $kat)->pluck('blog_id');
        $data['blogs'] = blog::with('users:id,nama')->whereIn('id',$arr_id)->orderBy('id', 'DESC')->paginate(5);
        $data['kategoris'] = kategori::withCount(['blog'])->orderBy('nama')->get();
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
