@extends('layout.app')

@section('title')
    <title>Daftar Penarikan Gaji</title>
@endsection

@section('css-custom')
@endsection

@section('content')
@include('partials.modal')
    <div class="dashboard-container">
        <main class="main-content">
            <h1>Daftar Penarikan Gaji</h1>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>STATUS</th>
                        <th>RINCIAN</th>
                    </tr>
                </thead>
                <tbody id="salaryTableBody">
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>
                                {{ $item->status == 0 ? 'Meminta Penarikan' : 'Terbayar' }}
                            </td>
                            <td>
                                <button class="detail-button {{ $item->status == 0 ? '' : 'inactive' }}"
                                    data-id="{{ $item->id }}"
                                    {{ $item->status == 0 ? '' : 'disabled' }}
                                    >
                                    {{ $item->status == 0 ? 'Detail' : 'Selesai' }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($data->count())
            @include('partials.paginate')
        @endif
        
        </main>
    </div>

    <!-- Modal Detail Penarikan -->
    <div id="withdrawalModal" class="modal hidden">
        <div class="modal-content">
            <h2>RINCIAN</h2>
            <p><strong>Nama:</strong> <span id="nama"></span></p>
            <p><strong>Bank:</strong> <span id="bank"></span></p>
            <p><strong>No. Rek.:</strong> <span id="norek"></span></p>
            <p><strong>Gaji:</strong> <span id="gaji"></span></p>
            <button id="closeModalButton" class="close-button">Tutup</button>
            <button id="confirmButton" class="confirm-button">Lanjut</button>
        </div>
    </div>

    <!-- Modal Form Pengajuan -->
    <div id="withdrawalFormModal" class="modal hidden">
        <div class="modal-content">
            <form action="{{ route('RiwayatPenarikan.bayar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id">
                <label for="buktiTransfer">Bukti Transfer</label>
                <input type="file" id="buktiTransfer" name="bukti_transfer" accept="image/*" required>

                <button id="closeFormButton" type="button" class="close-button">Tutup</button>
                <button type="submit" class="confirm-button">Kirim</button>
            </form>
        </div>
    </div>
@endsection

@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailButtons = document.querySelectorAll('.detail-button:not(.inactive)');
            const withdrawalModal = document.getElementById('withdrawalModal');
            const withdrawalFormModal = document.getElementById('withdrawalFormModal');
            const closeModalButton = document.getElementById('closeModalButton');
            const confirmButton = document.getElementById('confirmButton');
            const closeFormButton = document.getElementById('closeFormButton');

            const namaSpan = document.getElementById('nama');
            const bankSpan = document.getElementById('bank');
            const norekSpan = document.getElementById('norek');
            const gajiSpan = document.getElementById('gaji');
            const hiddenInputId = document.getElementById('id'); // Tangkap input hidden ID

            // Klik tombol Detail
            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id'); // Ambil data-id dari tombol

                    // Ambil data detail dari server
                    fetch(`/riwayat-penarikan/${id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal mengambil data penarikan.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            namaSpan.textContent = data.nama;
                            bankSpan.textContent = data.bank;
                            norekSpan.textContent = data.norek;
                            gajiSpan.textContent = data.gaji;

                            // Isi input hidden dengan ID
                            hiddenInputId.value = id;

                            // Tampilkan modal detail
                            withdrawalModal.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            alert('Terjadi kesalahan saat mengambil data detail.');
                        });
                });
            });

            // Klik tombol Close di modal detail
            closeModalButton.addEventListener('click', function() {
                withdrawalModal.classList.add('hidden');
            });

            // Klik tombol Lanjut di modal detail
            confirmButton.addEventListener('click', function() {
                withdrawalModal.classList.add('hidden');
                withdrawalFormModal.classList.remove('hidden');
            });

            // Klik tombol Close di modal form
            closeFormButton.addEventListener('click', function() {
                withdrawalFormModal.classList.add('hidden');
            });
        });
    </script>
@endsection
