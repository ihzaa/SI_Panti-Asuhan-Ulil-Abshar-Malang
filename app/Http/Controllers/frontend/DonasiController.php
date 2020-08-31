<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Donasi;
use App\Models\Frontend\DonasiMasuk;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use PDF;


class DonasiController extends Controller
{
    public function getAllYear()
    {
        $donasi_masuk = DonasiMasuk::pluck('donasi_id');
        $donasi = Donasi::selectRaw('year(created_at) year')
            ->groupBy('year')
            ->whereIn('id', $donasi_masuk)
            ->get();
        return $donasi;
    }

    public function getAllMonthByYear($year)
    {
        $donasi_masuk = DonasiMasuk::pluck('donasi_id');
        $data = Donasi::selectRaw('month(created_at) month')
            ->groupBy('month')->whereIn('id', $donasi_masuk)->whereYear('created_at', '=', $year)->get();
        return $data;
    }

    public function downloadDonasiByYear($year)
    {
        $donasi_masuk = DonasiMasuk::pluck('donasi_id');
        $data['donasi'] = Donasi::whereIn('id', $donasi_masuk)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $data['keterangan'] = 'Donasi Tahun ' . $year;
        $pos = url()->current();
        if (strpos($pos, 'adm1n') !== false) {
            $data['adm1n'] = true;
        } else {
            $data['adm1n'] = false;
        }
        $pdf = PDF::loadview('Exportable.donasi', compact('data'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('donasi tahun ' . $year . '.pdf');
    }

    public function downloadDonasiByMonth($month, $year)
    {
        $donasi_masuk = DonasiMasuk::pluck('donasi_id');
        $data['donasi'] = Donasi::whereIn('id', $donasi_masuk)->whereMonth('created_at', $month)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['keterangan'] = 'Donasi Bulan ' . $bulan[$month] . ' ' . $year;
        $pos = url()->current();
        if (strpos($pos, 'adm1n') !== false) {
            $data['adm1n'] = true;
        } else {
            $data['adm1n'] = false;
        }
        $pdf = PDF::loadview('Exportable.donasi', compact('data'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('donasi bulan ' . $bulan[$month] . ' tahun ' . $year . '.pdf');
    }

    // public function cek($year)
    // {
    //     $donasi_masuk = DonasiMasuk::pluck('donasi_id');
    //     $data['donasi'] = Donasi::whereIn('id', $donasi_masuk)->whereYear('created_at', '=', $year)->get();
    //     $data['keterangan'] = 'Donasi Tahun ' . $year;
    //     return view('Exportable.donasi', compact('data'));
    // }
    // public function cekb($month, $year)
    // {
    //     $donasi_masuk = DonasiMasuk::pluck('donasi_id');
    //     $data['donasi'] = Donasi::whereIn('id', $donasi_masuk)->whereMonth('created_at', $month)->whereYear('created_at', '=', $year)->orderBy('created_at')->get();
    //     $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    //     $data['keterangan'] = 'Donasi Bulan ' . $bulan[$month] . ' ' . $year;
    //     return view('Exportable.donasi', compact('data'));
    // }
}
