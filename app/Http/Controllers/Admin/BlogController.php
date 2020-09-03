<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\blog_foto;
use App\Models\Frontend\blog;
use App\Models\Frontend\blog_kategori;
use App\Models\Frontend\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $blog = blog::find($id);
        File::delete('assets/' . $blog->sampul_foto);
        $foto = blog_foto::where('blog_id', $id)->get();
        foreach ($foto as $f) {
            File::delete(substr($f->path, 1));
        }
        $blog->delete();
        return response()->json(['OK' => 200]);
        // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
    }

    public function tampilHalamanTambah()
    {
        $data = array();
        $data['kategori'] = kategori::get(['id', 'nama']);
        return view('admin.pages.Blog.tambah-edit', compact('data'));
    }

    public function tambahBlog(Request $request)
    {
        $this->validate($request, [
            'konten' => 'required',
            'judul' => 'required',
            'foto_sampul' => ['required', 'image', 'max:256']
        ]);
        $detail = $request->konten;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        $blog = new blog;
        $blog->judul = $request->judul;
        $blog->user_id = Auth::id();
        $blog->sampul_foto = "a";
        $blog->konten = "b";
        $blog->save();

        //UPLOAD FOTO SAMPUL
        $extension = $request->file('foto_sampul')->getClientOriginalExtension();
        // File upload location
        $location = 'images/blog-thumbnail';
        $nameUpload = $blog->id . 'thumbnail.' . $extension;
        // Upload file
        $request->file('foto_sampul')->move('assets/' . $location, $nameUpload);
        // Import CSV to Database
        $filepath = $location . "/" . $nameUpload;
        $blog->sampul_foto = $filepath;
        //END UPLOAD FOTO SAMPUL

        //UPLOAD GAMBAR DI KONTEN KALAU ADA
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = $blog->id . '-' . $k . '-' . time() . '.png';
            $path = '/assets/images/blog/' . $image_name;
            blog_foto::create([
                'path' => $path,
                'blog_id' => $blog->id
            ]);
            File::put('assets/images/blog/' . $image_name, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $path);
        }
        $detail = $dom->savehtml();
        $blog->konten = $detail;
        $blog->save();
        blog_kategori::create([
            'blog_id' => $blog->id,
            'kategori_id' => $request->kategori
        ]);

        return redirect(route('admin_pages_blog_index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan postingan blog.');
    }

    public function tambahKategori(Request $request)
    {
        $kategori = kategori::where('nama', $request->data)->first();
        if ($kategori != "") {
            return response()->json([
                'status' => false
            ]);
        }
        kategori::create([
            "nama" => $request->data
        ]);
        $kategori = kategori::withCount(['blog'])->orderBy('nama')->get(['id', 'nama']);
        return response()->json([
            'status' => true,
            'data' => $kategori
        ]);
    }

    public function editBlogIndex($id)
    {
        $data = array();
        $data['blog'] = blog::find($id);
        $data['kategori'] = kategori::get(['id', 'nama']);
        return view('admin.pages.Blog.tambah-edit', compact('data'));
    }

    public function editBlog($id, Request $request)
    {
        $this->validate($request, [
            'konten' => 'required',
            'judul' => 'required',
            'foto_sampul' => ['image', 'max:256']
        ]);
        $blog = blog::find($id);
        $blog->judul = $request->judul;
        if ($request->file('foto_sampul') != "") {
            File::delete('assets/' . $blog->sampul_foto);
            //UPLOAD FOTO SAMPUL
            $extension = $request->file('foto_sampul')->getClientOriginalExtension();
            // File upload location
            $location = 'images/blog-thumbnail';
            $nameUpload = $blog->id . 'thumbnail.' . $extension;
            // Upload file
            $request->file('foto_sampul')->move('assets/' . $location, $nameUpload);
            // Import CSV to Database
            $filepath = $location . "/" . $nameUpload;
            $blog->sampul_foto = $filepath;
            //END UPLOAD FOTO SAMPUL
        }
        $detail = $request->konten;
        // if ($detail != $blog->konten) {
        $dom = new \domdocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        //UPLOAD GAMBAR DI KONTEN KALAU ADA
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            if ($data[0] != '/') {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = $blog->id . '-' . $k . '-' . time() . '.png';
                $path = '/assets/images/blog/' . $image_name;
                blog_foto::create([
                    'path' => $path,
                    'blog_id' => $blog->id
                ]);
                File::put('assets/images/blog/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', $path);
            }
        }
        $detail = $dom->savehtml();
        $blog->konten = $detail;
        // }

        $blog->save();
        blog_kategori::where('blog_id', $blog->id)->update([
            'kategori_id' => $request->kategori
        ]);

        return redirect(route('admin_pages_blog_index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan postingan blog.');
    }

    public function getAllKategori()
    {
        $data = kategori::withCount(['blog'])->orderBy('nama')->get();
        return response()->json($data);
    }

    public function hapusKategori($id)
    {
        kategori::find($id)->delete();
        return $this->getAllKategori();
    }

    public function editKategori($id, Request $request)
    {
        kategori::find($id)->update([
            'nama' => $request->data
        ]);
        return $this->getAllKategori();
    }
}
