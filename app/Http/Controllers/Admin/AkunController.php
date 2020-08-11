<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $data = array();
        $data['nama'] = Auth::user()->nama;
        return view('admin.pages.kelola_akun', compact('data'));
    }

    public function ubahPass(Request $request)
    {
        $usr = DB::table('users')->where('id', Auth::id())->first();
        if (Hash::check($request->old, $usr->password)) {
            User::whereId(Auth::id())->update([
                'password' => Hash::make($request->new)
            ]);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function ubahNama(Request $request)
    {
        User::whereId(Auth::id())->update([
            'nama' => $request->nama
        ]);
        return response()->json([
            'status' => true
        ]);
    }
}
