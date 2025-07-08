<?php

namespace App\Http\Controllers;

use App\Models\DaftarGaji;
use App\Models\PengajuanGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPenarikanController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil gaji berdasarkan user
        $dataGaji = DaftarGaji::where('id_user', $user->id)->first();

        if (!$dataGaji) {
            // Jika tidak ada data gaji, tampilkan pesan kosong
            return view('karyawan.riwayat_penarikan.index', ['data' => []])
                ->with('info', 'Belum ada pengajuan gaji untuk user ini.');
        }

        // Ambil pengajuan gaji berdasarkan daftar gaji
        $data = PengajuanGaji::where('id_daftar_gaji', $dataGaji->id)->paginate(5);

        return view('karyawan.riwayat_penarikan.index', compact('data'));
    }

    public function DaftarGaji()
    {
        $id = Auth::user()->id_perusahaan;
        $data = PengajuanGaji::paginate(5)->where('id_perusahaan',$id);

        return view('owner.daftar-gaji.index', compact('data'));
    }

    public function bayar(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|numeric|exists:pengajuan_gaji,id',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        // Simpan file bukti transfer
        if ($request->hasFile('bukti_transfer')) {
            $fileName = $request->file('bukti_transfer')->getClientOriginalName(); // Ambil nama asli file
            $imagePath = $request->file('bukti_transfer')->storeAs('images/bukti_transfer',$fileName ,'public'); // Simpan ke folder
        } else {
            return back()->withErrors(['bukti_transfer' => 'File harus berupa gambar.']);
        }

        // Cari data pengajuan berdasarkan ID
        $data = PengajuanGaji::where('id', $request->input('id'))->first();

        if (!$data) {
            return back()->withErrors(['id' => 'Pengajuan tidak ditemukan.']);
        }

        // Update status pengajuan menjadi "Terbayar"
        $data->update([
            'status' => 1,
            'file' => $fileName, // Simpan path file bukti transfer
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('RiwayatPenarikan.DaftarGaji')->with('success', 'Pembayaran berhasil diproses.');
    }

    public function show($id)
    {
        $laporan = PengajuanGaji::find($id);

        if (!$laporan) {
            return response()->json(['error' => 'Laporan tidak ditemukan'], 404);
        }

        // Format data yang akan dikirim ke AJAX
        return response()->json([
            'file' => $laporan->file,
            'nama' => $laporan->nama,
            'bank' => $laporan->bank,
            'norek' => $laporan->no_rekening,
            'gaji' => $laporan->total_pengajuan,
            // 'upahSupir' => $laporan->upah_supir,
        ]);
    }
}
