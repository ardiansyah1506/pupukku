<?php

namespace App\Http\Controllers;

use App\Models\DaftarGaji;
use App\Models\PengajuanGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;

        $data = DaftarGaji::where('id_user', $idUser)->first();
        return view('karyawan.dashboard.index', compact('data'));
    }

    public function PengajuanGaji(Request $request)
    {
        // Validasi input
        $request->validate([
            'bank' => 'required|string',
            'no_rekening' => 'required|numeric',
            'nama' => 'required|string',
            'total_pengajuan' => 'required|numeric|min:0',
        ]);

        $idUser = Auth::user()->id;
        $data = DaftarGaji::where('id_user', $idUser)->first();

        // Periksa apakah data gaji tersedia
        if (!$data) {
            return redirect()->route('dashboard.index')->with('warning', 'Data gaji tidak ditemukan.');
        }

        // Periksa apakah pengajuan melebihi total gaji
        if ($data->total_gaji < $request->total_pengajuan) {
            return redirect()->route('dashboard.index')->with('warning', 'Jumlah tidak valid atau melebihi saldo!.');
        }
        $id = Auth::user()->id_perusahaan;

        // Simpan data ke database dengan transaksi
        DB::transaction(function () use ($request, $data, $id) {
            // Insert data pengajuan gaji
            PengajuanGaji::create([
                'bank' => $request->bank,
                'no_rekening' => $request->no_rekening,
                'nama' => $request->nama,
                'total_pengajuan' => $request->total_pengajuan,
                'id_daftar_gaji' => $data->id,
                'id_perusahaan' => $id,
            ]);

            // Kurangi total_gaji pada DaftarGaji
            $data->total_gaji -= $request->total_pengajuan;
            $data->save(); // Simpan perubahan ke database
        });

        // Redirect ke halaman sukses
        return redirect()->route('dashboard.index')->with('success', 'Proses Permintaan Penarikan Upah Berhasil.');
    }

}
