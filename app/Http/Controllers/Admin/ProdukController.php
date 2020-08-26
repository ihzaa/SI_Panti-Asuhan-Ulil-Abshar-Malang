<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Produk;
use App\Models\gambar_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProdukController extends Controller
{
    public function index()
    {
        $data = array();
        $data['produk'] = Produk::all();
        return view('admin.pages.Produk.produk', compact('data'));
    }

    public function HalamanTambah()
    {
        return view('admin.pages.produk.tambah-edit');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'image', 'max:500'],
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',

        ]);
        $produk = new produk;
        $produk->name = $request->name;
        $produk->image = $request->image;
        $produk->desc = $request->desc;
        $produk->price = $request->price;

        $produk->save();

        //UPLOAD FOTO SAMPUL
        $extension = $request->file('image')->getClientOriginalExtension();
        // File upload location
        $location = 'images/foto-produk';
        $nameUpload = 'produk' . $produk->id . '.' . $extension;
        // Upload file
        $request->file('image')->move('assets/' . $location, $nameUpload);
        // Import CSV to Database
        $filepath = $location . "/" . $nameUpload;
        $produk->image = $filepath;
        //END UPLOAD FOTO SAMPUL
        $produk->save();

        return redirect(route('admin_produk'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan produk.');
    }


    public function tampilEditProduk($id)
    {
        $data = array();
        $data['produk'] = Produk::find($id);
        return view('admin.pages.produk.tambah-edit', compact('data'));
    }

    public function edit($id, Request $request)
    {
        $this->validate($request, [
            'image' => ['image', 'max:500'],
            'name' => 'required',
            'desc' => 'required'


        ]);
        $produk = Produk::find($id);
        $produk->name = $request->name;
        $produk->desc = $request->desc;
        $produk->price = $request->price;

        if ($request->file('image') != "") {
            File::delete('assets/' . $produk->image);
            //UPLOAD FOTO SAMPUL
            $extension = $request->file('image')->getClientOriginalExtension();
            // File upload location
            $location = 'images/foto-produk';
            $nameUpload = 'produk' . $produk->id . '.' . $extension;
            // Upload file
            $request->file('image')->move('assets/' . $location, $nameUpload);
            // Import CSV to Database
            $filepath = $location . "/" . $nameUpload;
            $produk->image = $filepath;
            //END UPLOAD FOTO SAMPUL
        }

        $produk->save();

        return redirect(route('admin_produk'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil mengubah data produk.');
    }


    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        File::delete('assets/' . $produk->image);

        $gambar = gambar_detail::where('produk_id', $id)->get();
        foreach ($gambar as $f) {
            File::delete('assets/' . $f->image);
        }
        $produk->delete();
        return response()->json(['OK' => 200]);
        // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
    }


    public function tampilgambarProduk($id)
    {
        $data = array();
        $data['produk'] = produk::find($id);
        $data['gambar'] = gambar_detail::where('produk_id', $id)->get();
        return view('admin.pages.produk.gambar-detail', compact('data'));
    }

    public function tambahgambar($id, Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'image', 'max:500'],


        ]);
        $gambar_detail = new gambar_detail;
        $gambar_detail->image = $request->image;
        $gambar_detail->produk_id = $id;

        $gambar_detail->save();

        //UPLOAD FOTO SAMPUL
        $extension = $request->file('image')->getClientOriginalExtension();
        // File upload location
        $location = 'images/foto-produk';
        $nameUpload = 'gambar' . $gambar_detail->id . '.' . $extension;
        // Upload file
        $request->file('image')->move('assets/' . $location, $nameUpload);
        // Import CSV to Database
        $filepath = $location . "/" . $nameUpload;
        $gambar_detail->image = $filepath;
        //END UPLOAD FOTO SAMPUL
        $gambar_detail->save();

        return redirect(route('admin_gambar_produk', ['id' => $id]))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan produk.');
    }

    public function hapusGambar($id)
    {
        $gambar_detail = gambar_detail::find($id);

        File::delete('assets/' . $gambar_detail->image);
        $gambar_detail->delete();
        return response()->json(['OK' => 200]);
        // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
    }
}
