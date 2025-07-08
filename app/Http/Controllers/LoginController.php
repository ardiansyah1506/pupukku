<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Coba login dengan username
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'owner') {
                return redirect()->route('pekerjaan.index');
            } 
            if (Auth::user()->role == 'pegawai') {
                return redirect()->route('dashboard.index');
            } 
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


    public function showRegisterForm()
    {
        return view('register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:owner,pegawai', // Hanya menerima 'owner' atau 'pegawai'
        ]);

        // Simpan data user
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_perusahaan' => 0,
            'role' => $request->role,
        ]);

        // Redirect ke halaman login setelah sukses registrasi
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
