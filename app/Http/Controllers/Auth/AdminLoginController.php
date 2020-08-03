<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function loginGet()
    {
        return view('admin.pages.Auth.login');
    }

    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user != []) {
            $role = role::find($user->role_id);
            Auth::guard($role->nama)->loginUsingId($user->id);
            return redirect(route('admin_dashboard'));
        } else {
            return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'username atau password salah!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('login_admin_get'));
    }
}
