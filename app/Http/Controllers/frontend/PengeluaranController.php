<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Dompdf\Dompdf;
use PDF;


class PengeluaranController extends Controller
{

    public function getAllYear()
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $pengeluaran1 = pengeluaran::selectRaw('year(created_at) year')
        //     ->groupBy('year')
        //     ->whereIn('id', $pengeluaran)
        //     ->get();
        $pengeluaran1 = DB::select("SELECT z.year FROM (SELECT YEAR(d.created_at) AS year FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL UNION SELECT YEAR(created_at) FROM pengeluarans) AS z GROUP BY z.year");

        return $pengeluaran1;
    }

    public function getAllMonthByYear($year)
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $data = pengeluaran::selectRaw('month(created_at) month')
        //     ->groupBy('month')->whereIn('id', $pengeluaran)->whereYear('created_at', '=', $year)->get();
        $data = DB::select("SELECT z.month FROM (SELECT MONTH(d.created_at) AS month FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL AND YEAR(d.created_at) = " . $year . " UNION SELECT MONTH(created_at) FROM pengeluarans WHERE YEAR(created_at) = " . $year . ") AS z GROUP BY z.month");

        // dd($data);

        return $data;
    }

    public function downloadPengeluaranByYear($year)
    {
        set_time_limit(300);
        // $pengeluaran = pengeluaran::pluck('id');
        // $data['pengeluaran'] = pengeluaran::whereIn('id', $pengeluaran)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $data['tahun'] = $year;
        $data['pemasukan'] = DB::select("SELECT MONTH(d.created_at) as bulan, SUM(d.total_donasi) as pemasukan FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL AND YEAR(d.created_at) = " . $year . " GROUP BY bulan ORDER BY bulan");
        $data['pengeluaran'] = DB::select("SELECT MONTH(created_at) as bulan, SUM(nominal) as pengeluaran FROM pengeluarans WHERE YEAR(created_at) = " . $year . " GROUP BY bulan ORDER BY bulan");

        //  dd($data['pemasukan'],$data['pengeluaran']);
        $hasil = array(1 => [0, 0], 2 => [0, 0], 3 => [0, 0], 4 => [0, 0], 5 => [0, 0], 6 => [0, 0], 7 => [0, 0], 8 => [0, 0], 9 => [0, 0], 10 => [0, 0], 11 => [0, 0], 12 => [0, 0]);
        
        foreach ($data['pemasukan'] as $d) {
            $hasil[$d->bulan][0] = $d->pemasukan;
        }
        foreach ($data['pengeluaran'] as $d) {
            $hasil[$d->bulan][1] = $d->pengeluaran;
        }
        for ($i = 1; $i <= 12; $i++) {
            if ($hasil[$i] == [0, 0]) {
                unset($hasil[$i]);
            }
        }
        $data['hasil'] = $hasil;
        $data['keterangan'] = 'Keuangan Tahun ' . $year;
        $data['bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        // return view('Exportable.keuanganTahun', compact('data'));
        $pdf = PDF::loadview('Exportable.keuanganTahun', compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('keuangan tahun ' . $year . '.pdf');
    }

    public function downloadPengeluaranByMonth($month, $year)
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $data['pengeluaran'] = pengeluaran::whereIn('id', $pengeluaran)->whereMonth('created_at', $month)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $data['keuangan'] = DB::select("SELECT d.created_at as tanggal, d.nama_alias as keterangan, d.total_donasi as pemasukan, '-' as pengeluaran FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL AND MONTH(d.created_at)= " . $month . " AND YEAR(d.created_at) = " . $year . " UNION SELECT created_at, nama_keperluan, '-', nominal FROM pengeluarans WHERE MONTH(created_at)= " . $month . " AND YEAR(created_at) = " . $year . " ORDER BY tanggal");
        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['keterangan'] = 'Keuangan Bulan ' . $bulan[$month] . ' ' . $year;
        $pdf = PDF::loadview('Exportable.keuanganBulan', compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('keuangan bulan ' . $bulan[$month] . ' tahun ' . $year . '.pdf');
    }

    public function cek($year)
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $data['pengeluaran'] = Pengeluaran::whereIn('id', $pengeluaran)->whereYear('created_at', '=', $year)->get();
        $data['tahun'] = $year;
        $data['pemasukan'] = DB::select("SELECT MONTH(d.created_at) as bulan, SUM(d.total_donasi) as pemasukan FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL AND YEAR(d.created_at) = " . $year . " GROUP BY bulan ORDER BY bulan");
        $data['pengeluaran'] = DB::select("SELECT MONTH(created_at) as bulan, SUM(nominal) as pengeluaran FROM pengeluarans WHERE YEAR(created_at) = " . $year . " GROUP BY bulan ORDER BY bulan");

        //  dd($data['pemasukan'],$data['pengeluaran']);
        $hasil = array(1 => [0, 0], 2 => [0, 0], 3 => [0, 0], 4 => [0, 0], 5 => [0, 0], 6 => [0, 0], 7 => [0, 0], 8 => [0, 0], 9 => [0, 0], 10 => [0, 0], 11 => [0, 0], 12 => [0, 0]);

        foreach ($data['pemasukan'] as $d) {
            $hasil[$d->bulan][0] = $d->pemasukan;
        }
        foreach ($data['pengeluaran'] as $d) {
            $hasil[$d->bulan][1] = $d->pengeluaran;
        }
        for ($i = 1; $i <= 12; $i++) {
            if ($hasil[$i] == [0, 0]) {
                unset($hasil[$i]);
            }
        }
        $data['hasil'] = $hasil;
        // dd($data['hasil']);

        $data['keterangan'] = 'Keuangan Tahun ' . $year;
        $data['bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('Exportable.keuanganTahun', compact('data'));
    }
    public function cekb($month, $year)
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $data['pengeluaran'] = pengeluaran::whereIn('id', $pengeluaran)->whereMonth('created_at', $month)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $data['keuangan'] = DB::select("SELECT d.created_at as tanggal, d.nama_alias as keterangan, d.total_donasi as pemasukan, '-' as pengeluaran FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL AND MONTH(d.created_at)= " . $month . " AND YEAR(d.created_at) = " . $year . " UNION SELECT created_at, nama_keperluan, '-', nominal FROM pengeluarans WHERE MONTH(created_at)= " . $month . " AND YEAR(created_at) = " . $year . " ORDER BY tanggal");
        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['keterangan'] = 'Keuangan Bulan ' . $bulan[$month] . ' ' . $year;
        return view('Exportable.keuanganBulan', compact('data'));
    }
}
