<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view("admin.auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            "email"    => "required|email",
            "password" => "required|string|min:8"
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role === 'user')
            {
                auth()->logout();
                Alert::error('Oops!', 'Invalid Login!');
                return redirect()->back();
            }
            return redirect()->route("admin.user.total");
        }
        Alert::error('Oops!', 'Not Registered!');
        return redirect()->back();
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("admin.login");
    }
}
