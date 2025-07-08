@extends('layout.app')

@section('title')
<title>Riwayat Pengiriman Pupuk</title>
@endsection

@section('css-custom')

@endsection

@section('content')

<div class="dashboard-container">
    <main class="main-content">
        <h1>Riwayat Pengiriman Pupuk</h1>
        <table class="shipment-history">
            <thead>
                <tr>
                    <th>TANGGAL</th>
                    <th>SUPIR</th>
                    <th>TUJUAN</th>
                    <th>INFORMASI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td><a href="#" class="detail-link" data-id="{{ $item->id_laporan }}">Detail</a></td>
                  </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center">Data Tidak Tersedia</td>
                </tr>
                @endforelse
            </tbody>
            
        </table>
        @if ($data->count())
        @include('partials.paginate')
    @endif
    </main>
</div>

 <!-- Modal Laporan -->
 <div id="modalLaporan" class="modal hidden">
    <div class="modal-content">
        <h2>LAPORAN</h2>
        <table class="report-table">
            <tbody id="reportContent">
                <!-- Data akan dimuat di sini -->
            </tbody>
        </table>
        <button id="closeModalButton" class="close-button">Close</button>
    </div>
</div>

@endsection

@section('js-custom')
<script>
   document.addEventListener('DOMContentLoaded', () => {
    // Ambil referensi elemen
    const detailLinks = document.querySelectorAll('.detail-link');
    const modal = document.getElementById('modalLaporan');
    const closeBtn = document.getElementById('closeModalButton');
    const reportContent = document.getElementById('reportContent');

    // Handle klik pada tautan "Detail"
    detailLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Ambil ID dari data-id
            const laporanId = this.dataset.id;

            // Gunakan fetch untuk mendapatkan data detail laporan
            fetch(`/laporan/${laporanId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Laporan tidak ditemukan');
                    }
                    return response.json();
                })
                .then(data => {
                    // Kosongkan dan isi konten modal dengan data yang diterima
                    reportContent.innerHTML = `
                        <tr>
                            <td>Total Pupuk Terjual</td>
                            <td>${data.totalPupukTerjual}</td>
                        </tr>
                        <tr>
                            <td>Uang Makan</td>
                            <td>Rp. ${data.uangMakan}</td>
                        </tr>
                        <tr>
                            <td>Uang Bensin</td>
                            <td>Rp. ${data.uangBensin}</td>
                        </tr>
                        <tr>
                            <td>Uang Tol</td>
                            <td>Rp. ${data.uangTol}</td>
                        </tr>
                        <tr>
                            <td>Bukti Pengiriman</td>
                            <td>
                            <a href="/storage/images/bukti_pengiriman/${data.file}" target="_blank">Lihat Bukti</a>
                                </td>
                        </tr>
                        <tr>
                            <td>Upah Supir</td>
                            <td>Rp. 50000</td>
                        </tr>
                    `;

                    // Tampilkan modal
                    modal.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching laporan:', error);
                    alert('Terjadi kesalahan saat mengambil data laporan.');
                });
        });
    });

    // Handle klik tombol "Close"
    closeBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
    });

    // Handle klik di luar modal
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});

</script>
@endsection
