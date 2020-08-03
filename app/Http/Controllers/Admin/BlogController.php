<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data = array();
        $data['blogs'] = blog::all();
        return view('admin.pages.Blog.index', compact('data'));
    }

    public function hapus($id)
    {
        blog::find($id)->delete();
        return response()->json(['OK' => 200]);
        // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
    }
}
