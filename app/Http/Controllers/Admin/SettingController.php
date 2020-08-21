<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SettingController extends Controller
{
  //
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Bank::latest()->get();
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

        ->rawColumns(['action'])
        ->make(true);
    }
    return view('admin.pages.Setting.setting');
  }

  public function add_bank(Request $request)
  {
    $bank = Bank::create([
      'nama_bank' => $request->nama_bank,
      'no_rekening' => $request->no_rekening,
    ]);

    return response()->json(['code' => 200, 'message' => 'Data bank berhasil ditambah', 'data' => $bank], 200);
  }

  public function bank_edit($id)
  {
    if (request()->ajax()) {
      $data = Bank::findOrFail($id);
      return response()->json(['result' => $data]);
    }
  }

  public function bank_update(Request $request)
  {
    $form_data = array(
      'nama_bank' => $request->nama_bank,
      'no_rekening' => $request->no_rekening,
    );
    Bank::whereId($request->hidden_id)->update($form_data);
  }

  public function bank_delete($id)
  {
    $bank = Bank::find($id);
    $bank->delete();
    return response()->json(['OK' => 200]);
    // return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus postingan blog.');
  }
}
