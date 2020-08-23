<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\telepon;
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

    public function aturNomerWa(Request $request)
    {
        telepon::find(1)->update([
            'no_telp' => $request->telp
        ]);
        return response()->json(true);
    }

    public function aturApiKey(Request $request)
    {
        telepon::find(1)->update([
            'key' => $request->key
        ]);
        $curl = curl_init();
        $telp = telepon::find(1);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.callmebot.com/whatsapp.php?phone=$telp->no_telp&text=Halo,%20nomer%20ini%20akan%20menerima%20pesan%20jika%20ada%20donasi%20yang%20masuk&apikey=$telp->key",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return response()->json(true);
    }

    public function getDataAdmin()
    {
        $data = telepon::find(1);
        return response()->json($data);
    }
}
