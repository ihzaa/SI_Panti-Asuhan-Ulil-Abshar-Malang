<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\ProfilAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;

class ProfilAnakController extends Controller
{
  //
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = ProfilAnak::latest()->get();
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-warning btn-sm btnEdit"><i class="fas fa-pencil-alt"></i></a>';

          $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm btnDelete"><i
          class="fas fa-trash"></i></a>';
          return $btn;
        })
        ->addColumn('id', function () {
          return '#';
        })
        ->addColumn('sekolah', function ($row) {
          return $row->sekolah . ' - Kelas ' . $row->kelas;
        })
        ->addColumn('umur', function ($row) {
          return $row->umur . ' tahun';
        })
        ->addColumn('jenis_kelamin', function ($row) {
          return $row->jenis_kelamin == 1 ? 'Laki - Laki' : 'Perempuan';
        })
        ->addColumn('image', function ($row) {
          return '<a target="_blank" href="' . asset($row->foto_path) . '">
          <img class="table-avatar" src="' . asset($row->foto_path) . '" alt="Avatar">
          </a>';
        })
        ->rawColumns(['action', 'image', 'id', 'jenis_kelamin'])
        ->make(true);
    }
    return view('admin.pages.profil_anak');
  }

  public function store(Request $request)
  {
    if ($files = $request->file('foto')) {
      $destinationPath = 'assets/images/foto_anak_panti'; // upload path
      $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
      $files->move($destinationPath, $profileImage);
      $image = "images/foto_anak_panti/$profileImage";
    }

    $profileAnak = ProfilAnak::create([
      'nama' => $request->nama,
      'foto_path' => $image,
      'jenis_kelamin' => $request->jenKel,
      'umur' => $request->umur,
      'sekolah' => $request->sekolah,
      'kelas' => $request->kelas,
    ]);

    return response()->json(['code' => 200, 'message' => 'Data anak berhasil ditambah', 'data' => $profileAnak], 200);
  }

  public function edit($id)
  {
    if (request()->ajax()) {
      $data = ProfilAnak::findOrFail($id);
      return response()->json(['result' => $data]);
    }
  }

  public function update(Request $request)
  {
    $profilAnak = ProfilAnak::whereId($request->hidden_id);

    if ($request->file('foto') != "") {
      if ($files = $request->file('foto')) {
        $destinationPath = 'assets/images/foto_anak_panti'; // upload path
        $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
        $files->move($destinationPath, $profileImage);
        $image = "images/foto_anak_panti/$profileImage";
      }
    } else {
      $image = $profilAnak->first()->foto_path;
    }

    $form_data = array(
      'nama' => $request->nama,
      'foto_path' => $image,
      'jenis_kelamin' => $request->jenKel_edit,
      'umur' => $request->umur,
      'sekolah' => $request->sekolah,
      'kelas' => $request->kelas,
    );
    $profilAnak->update($form_data);
  }

  public function delete($id)
  {
    $profile = ProfilAnak::find($id);
    File::delete('assets/' . $profile->foto_path);
    $profile->delete();
    return response()->json(['OK' => 200]);
    // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
  }
}
