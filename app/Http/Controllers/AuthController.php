<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // public function loginPage(){
    //     return view('frontend.login');
    // }

    public function register() {
        return view('frontend.auth.register');
    }

    public function registerProcess(Request $request) {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|confirmed',
        ]);

        //buat user baru
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'hp' => '-',
            'role' => '0',
            'status' => 1,
            //'foto' => 'img-default.jpg',
        ]);

        Auth::login($user);

        return redirect()->route('beranda')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            //kalau admin
            if(Auth::user()->role == 1){
                return redirect()->route('admin');
            }

            //kalau user
            return redirect()->route('beranda');
        }
        return back()->with('error', 'Email atau password salah');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('beranda');
    }
}
