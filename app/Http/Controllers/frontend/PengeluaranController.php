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
        $pengeluaran = pengeluaran::pluck('id');
        $pengeluaran1 = pengeluaran::selectRaw('year(created_at) year')
            ->groupBy('year')
            ->whereIn('id', $pengeluaran)
            ->get();
        return $pengeluaran1;
    }

    public function getAllMonthByYear($year)
    {
        $pengeluaran = pengeluaran::pluck('id');
        $data = pengeluaran::selectRaw('month(created_at) month')
            ->groupBy('month')->whereIn('id', $pengeluaran)->whereYear('created_at', '=', $year)->get();
        return $data;
    }

    public function downloadPengeluaranByYear($year)
    {
        set_time_limit(300);
        $pengeluaran = pengeluaran::pluck('id');
        $data['pengeluaran'] = pengeluaran::whereIn('id', $pengeluaran)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $data['keterangan'] = 'pengeluaran Tahun ' . $year;
        $pdf = PDF::loadview('Exportable.Pengeluaran', compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('pengeluaran tahun ' . $year . '.pdf');
    }

    public function downloadPengeluaranByMonth($month, $year)
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $data['pengeluaran'] = pengeluaran::whereIn('id', $pengeluaran)->whereMonth('created_at', $month)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $data['pengeluaran']= DB::select("SELECT d.created_at as tanggal, d.nama_alias as keterangan, d.total_donasi as pemasukan, '-' as pengeluaran FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL UNION SELECT created_at, nama_keperluan, '-', nominal FROM pengeluarans ORDER BY tanggal");
        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['keterangan'] = 'pengeluaran Bulan ' . $bulan[$month] . ' ' . $year;
        $pdf = PDF::loadview('Exportable.Pengeluaran', compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('pengeluaran bulan ' . $bulan[$month] . ' tahun ' . $year . '.pdf');
    }

    public function cek($year)
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $data['pengeluaran'] = Pengeluaran::whereIn('id', $pengeluaran)->whereYear('created_at', '=', $year)->get();
        $data['keterangan'] = 'pengeluaran Tahun ' . $year;
        return view('Exportable.pengeluaran', compact('data'));
    }
    public function cekb($month, $year)
    {
        // $pengeluaran = pengeluaran::pluck('id');
        // $data['pengeluaran'] = pengeluaran::whereIn('id', $pengeluaran)->whereMonth('created_at', $month)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $data['pengeluaran']= DB::select("SELECT d.created_at as tanggal, d.nama_alias as keterangan, d.total_donasi as pemasukan, '-' as pengeluaran FROM donasi_masuks dm LEFT JOIN donasis d ON dm.donasi_id=d.id WHERE d.id IS NOT NULL UNION SELECT created_at, nama_keperluan, '-', nominal FROM pengeluarans ORDER BY tanggal");
        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['keterangan'] = 'Keuangan Bulan ' . $bulan[$month] . ' ' . $year;
        return view('Exportable.pengeluaran', compact('data'));
    }
}
