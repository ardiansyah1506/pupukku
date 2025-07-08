<?php

namespace App\Http\Controllers;

use App\Models\DaftarPerusahaan;
use App\Models\ListPerusahaan;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class DaftarPerusahaanController extends Controller
{

    public function index(){
        return view('daftar.index');
    }
    public function detail($id){
    $perusahaan = DaftarPerusahaan::findOrFail($id);
        return view('daftar.detail',compact('perusahaan'));
    }

    public function create($id){
        return view('daftar.create',compact('id'));
    }

    public function admin()
{
    $perusahaan = DaftarPerusahaan::orderBy('created_at', 'desc')->get();
    return view('daftar.admin', compact('perusahaan'));
}

public function konfirmasi($id)
{
    $perusahaan = DaftarPerusahaan::findOrFail($id);
    
    $perusahaan->update([
        'status' => '1', // Set status menjadi verified
    ]);
    $ListPeruahaan = ListPerusahaan::create([
        'nama' => $perusahaan->perusahaan
    ]);
    User::create([
        'nama' => $perusahaan->nama,
        'username' => $perusahaan->username,
        'password' => $perusahaan->password,
        'id_perusahaan' => $perusahaan->id,
        'role' => 'owner',
    ]);

    // LOG aktivitas konfirmasi
    \Log::info('Konfirmasi pendaftaran perusahaan', [
        'id' => $perusahaan->id,
        'nama' => $perusahaan->nama,
        'username' => $perusahaan->username,
        'waktu' => now()->toDateTimeString(),
        'admin_ip' => request()->ip(),
    ]);

    return redirect()->back()->with('success', 'Pendaftaran perusahaan berhasil dikonfirmasi!');
}

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'perusahaan' => 'required|string|max:255',
            'username' => 'required|string|unique:daftar_perusahaan,username',
            'password' => 'required|string|min:6',
        ]);
    
        $perusahaan = DaftarPerusahaan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'perusahaan' => $request->perusahaan,
            'username' => $request->username,
            'password' => Hash::make($request->password), // WAJIB di-hash!
            'bukti_bayar' => '-',
            'norek' => '-',
            'jenis_bank' => '-',
            'status' => '0',
        ]);
    
        // LOG aktivitas
        \Log::info('Pendaftaran perusahaan baru', [
            'id' => $perusahaan->id,
            'nama' => $perusahaan->nama,
            'username' => $perusahaan->username,
            'waktu' => now()->toDateTimeString(),
            'ip_address' => $request->ip(),
        ]);
    
        return redirect()->route('daftar.detail', ['id' => $perusahaan->id])
    ->with('success', 'Bukti bayar berhasil diunggah! Tunggu verifikasi.');

}
    
public function uploadBuktiBayar(Request $request, $id)
{
    $request->validate([
        'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'bank' => 'required|string',
        'norek' => 'required|string',
    ]);

    $perusahaan = DaftarPerusahaan::findOrFail($id);

    // Simpan file
    $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

    // Simpan bukti dan bank yang dipilih
    $perusahaan->update([
        'bukti_bayar' => $path,
        'norek' => $request->norek,
        'jenis_bank' => $request->bank,
        'status' => '0', // tetap 0, menunggu verifikasi admin
    ]);
    return redirect()->route('daftar.detail', ['id' => $perusahaan->id])
    ->with('success', 'Bukti bayar berhasil diunggah! Tunggu verifikasi.');
}

}
