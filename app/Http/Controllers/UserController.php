<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $id = Auth::user()->id_perusahaan;
        $data = User::where('role', '!=', 'owner')
        ->where('id_perusahaan',$id)->paginate(5); // Menampilkan 10 data per halaman
        return view('owner.user.index',compact('data'));
    }

    public function store(Request $request)
    {
        $id = Auth::user()->id_perusahaan;
        // Validasi input
        $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Simpan data user
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
            'id_perusahaan' => $id,
        ]);

        // Redirect ke halaman login setelah sukses registrasi
        return redirect()->route('user.index')->with('success', 'Berhasil Menambahkan Akun Pegawai.');
    }
}
