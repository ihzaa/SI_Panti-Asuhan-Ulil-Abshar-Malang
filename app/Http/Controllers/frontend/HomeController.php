<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Frontend\blog;
use App\Models\Frontend\Donasi;
use App\Models\Frontend\kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Frontend\manager;
use App\Models\Frontend\sarana;
use App\Models\Frontend\ProfilAnak;
use App\Models\telepon;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $data['last_3month'] = DB::table('donasis')
            ->whereExists(function ($query) {
                $query->from('donasi_masuks')
                    ->whereRaw('donasi_masuks.donasi_id = donasis.id');
            })->select(
                // DB::raw('DATE_FORMAT(created_at, "%b") as month'),
                DB::raw('MONTHNAME(created_at) as month'),
                DB::raw('SUM(total_donasi) as sum')
            )
            ->whereMonth('created_at', '<', Carbon::now()->month)
            ->whereMonth('created_at', '>=', Carbon::now()->subMonth(3)->month)
            ->orderBy('month', 'desc')
            ->groupBy('month')
            ->get();

        $jml = count($data['last_3month']);
        $data['jml_last_3month'] = $jml == 2 ? 6 : ($jml == 1 ? 12 : 4);

        $data['donasi'] = DB::table('donasis')
            ->whereExists(function ($query) {
                $query->from('donasi_masuks')
                    ->whereRaw('donasi_masuks.donasi_id = donasis.id');
            })->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_donasi) as sum')
            )
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->groupBy('month')
            ->first();


        $data['donatur_terbaru'] = DB::table('donasis')
            ->whereExists(function ($query) {
                $query->from('donasi_masuks')
                    ->whereRaw('donasi_masuks.donasi_id = donasis.id');
            })
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $data['jml_hari'] = $this->jumlahHari(Carbon::now()->month, Carbon::now()->year);
        $data['day_now'] = Carbon::now()->day;
        $data['pengurus'] = manager::count();
        $data['anak_asuh'] = ProfilAnak::count();
        $data['sarana'] = sarana::count();
        $data['bank'] = Bank::all();
        $data['blogs'] = blog::with('users:id,nama')->latest()->paginate(4);

        return view('frontend.pages.Home.home', $data);
    }

    function jumlahHari($month, $year)
    {
        $hari = date('t', mktime(0, 0, 0, $month, 1, $year));
        return $hari;
    }
    //
    public function donation(Request $request)
    {
        // untuk validasi form
        $this->validate($request, [
            'name' => 'required',
            'nama_alias' => 'required',
            'donasi' => 'required',
            'bank' => 'required',
        ]);

        // insert data ke table books
        $donasi = Donasi::create([
            'nama_donatur' => $request->name,
            'nama_alias' => $request->nama_alias,
            'total_donasi' => $request->donasi,
            'nama_bank' => $request->bank,
            'email' => $request->email,
        ]);


        $curl = curl_init();
        $telp = telepon::find(1);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.callmebot.com/whatsapp.php?phone=$telp->no_telp&text=Halo%20Bossss%20ada%20donasi%20masuk%20dari%20" . $request->name . "%20silahkan%20periksa%20mobile%20banking&apikey=$telp->key",
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
        return response()->json([$response]);

        // return response()->json(['code' => 200, 'message' => 'Donation Created successfully', 'data' => $donasi], 200);
    }
}
