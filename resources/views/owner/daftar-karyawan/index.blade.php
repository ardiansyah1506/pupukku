@extends('layout.app')

@section('title')
    <title>Daftar Karyawan</title>
@endsection

@section('css-custom')
@endsection
@section('content')
    <div class="dashboard-container">
        <main class="main-content">
            <h1>Daftar Karyawan</h1>
            <table class="employee-table">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>STATUS</th>
                        <th>RINCIAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->status == 0 ? 'OFF' : 'ON' }}</td>
                            <td>
                                <button class="detail-button {{ $item->status == 0 ? 'inactive' : '' }}"
                                    {{ $item->status == 0 ? 'disabled' : '' }} data-id="{{ $item->pekerjaan_aktif_id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @include('partials.paginate')
        </main>
    </div>

    <!-- Modal Detail Karyawan -->
    <div id="employeeModal" class="modal hidden">
        <div class="modal-content">
            <h2>LAPORAN</h2>
            <p><strong>Total Pupuk Dibawa:</strong> <span id="pupuk"></span></p>
            <p><strong>Kendaraan:</strong> <span id="kendaraan"></span></p>
            <p><strong>Tujuan:</strong> <span id="tujuan"></span></p>
            <p><strong>Status:</strong> <span id="status"></span></p>
            <button id="closeEmployeeModal" class="close-button">Close</button>
        </div>
    </div>
@endsection


@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailButtons = document.querySelectorAll('.detail-button:not(.inactive)');
            const modal = document.getElementById('employeeModal');
            const closeModalButton = document.getElementById('closeEmployeeModal');

            // Elemen untuk data di modal
            const pupukSpan = document.getElementById('pupuk');
            const kendaraanSpan = document.getElementById('kendaraan');
            const tujuanSpan = document.getElementById('tujuan');
            const statusSpan = document.getElementById('status');

            // Event listener untuk tombol Detail
            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id'); // Ambil ID pekerjaan aktif

                    // Ambil data detail dari server
                    fetch(`/laporan/detail-karyawan/${id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Data tidak ditemukan');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Isi modal dengan data yang diterima dari server
                            pupukSpan.textContent = data.total_karung || '-';
                            kendaraanSpan.textContent = data.kendaraan || '-';
                            tujuanSpan.textContent = data.tujuan || '-';
                            statusSpan.textContent = data.status == 1 ? 'Dalam Perjalanan' :
                                'Tidak Aktif';

                            // Tampilkan modal
                            modal.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            alert('Terjadi kesalahan saat mengambil data karyawan.');
                        });
                });
            });

            // Tutup modal
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Tutup modal jika klik di luar konten
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
