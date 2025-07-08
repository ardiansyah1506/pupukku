@extends('layout.app')

@section('title', 'Admin - Daftar Perusahaan')

@section('css-custom')
<style>
    /* Reset and base styles */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    /* Container */
    .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Card */
    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 20px;
        border-bottom: none;
    }

    .card-header h4 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .card-body {
        padding: 20px;
    }

    /* Alerts */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: none;
        position: relative;
        display: flex;
        align-items: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-dismissible {
        padding-right: 50px;
    }

    .btn-close {
        position: absolute;
        right: 15px;
        top: 15px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: inherit;
        opacity: 0.7;
    }

    .btn-close:hover {
        opacity: 1;
    }

    /* Grid system */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: -10px;
    }

    .col-md-6 {
        flex: 0 0 50%;
        padding: 10px;
    }

    .col-12 {
        flex: 0 0 100%;
        padding: 10px;
    }

    /* Form controls */
    .form-control, .form-select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group-text {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-right: none;
        padding: 12px 15px;
        border-radius: 8px 0 0 8px;
        color: #6c757d;
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 8px 8px 0;
    }

    /* Table */
    .table-responsive {
        overflow-x: auto;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        margin: 0;
    }

    .table th {
        background: #343a40;
        color: white;
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        border: none;
    }

    .table td {
        padding: 12px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .table tr:hover {
        background-color: #f8f9fa;
    }

    .table tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .bg-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .bg-success {
        background-color: #28a745;
        color: white;
    }

    .bg-danger {
        background-color: #dc3545;
        color: white;
    }

    .bg-secondary {
        background-color: #6c757d;
        color: white;
    }

    .bg-info {
        background-color: #17a2b8;
        color: white;
    }

    /* Buttons */
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        margin: 2px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-1px);
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-1px);
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
        transform: translateY(-1px);
    }

    .btn-outline-primary {
        background-color: transparent;
        color: #007bff;
        border: 2px solid #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-group {
        display: flex;
        gap: 2px;
    }

    /* Utilities */
    .text-center {
        text-align: center;
    }

    .text-muted {
        color: #6c757d;
    }

    .text-decoration-none {
        text-decoration: none;
    }

    .fw-bold {
        font-weight: 600;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .me-1 {
        margin-right: 0.25rem;
    }

    .me-2 {
        margin-right: 0.5rem;
    }

    .py-4 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .d-inline {
        display: inline;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    /* Code styling */
    code {
        background-color: #f8f9fa;
        padding: 4px 8px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 13px;
        color: #e83e8c;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-dialog {
        background: white;
        border-radius: 10px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideIn 0.3s ease;
    }

    .modal-lg {
        max-width: 800px;
    }

    .modal-content {
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 20px;
        border-top: 1px solid #e9ecef;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-close {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #6c757d;
    }

    .btn-close:hover {
        color: #000;
    }

    /* Image */
    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .rounded {
        border-radius: 8px;
    }

    #buktiBayarImage {
        max-height: 500px;
        object-fit: contain;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 100%;
        }
        
        .table-responsive {
            font-size: 14px;
        }
        
        .card-body {
            padding: 15px;
        }
        
        .btn-group {
            flex-direction: column;
            gap: 5px;
        }
    }

    /* Icon spacing */
    .fas {
        margin-right: 5px;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-building me-2"></i>
                        Daftar Perusahaan Terdaftar
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'">&times;</button>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari perusahaan...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="0">Menunggu Verifikasi</option>
                                <option value="1">Terverifikasi</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="perusahaanTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>PIC</th>
                                    <th>Username</th>
                                    <th>No. HP</th>
                                    <th>Bank</th>
                                    <th>No. Rekening</th>
                                    <th>Status</th>
                                    <th>Bukti Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($perusahaan as $index => $item)
                                <tr data-status="{{ $item->status }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $item->perusahaan }}</div>
                                        <small class="text-muted">{{ Str::limit($item->alamat, 50) }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $item->nama }}</div>
                                        <small class="text-muted">{{ $item->created_at->format('d M Y H:i') }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $item->username }}</span>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $item->no_hp }}" class="text-decoration-none">
                                            <i class="fas fa-phone me-1"></i>{{ $item->no_hp }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($item->jenis_bank != '-')
                                            <span class="badge bg-info">{{ $item->jenis_bank }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->norek != '-')
                                            <code>{{ $item->norek }}</code>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == '0')
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>Menunggu
                                            </span>
                                        @elseif($item->status == '1')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Terverifikasi
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times me-1"></i>Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->bukti_bayar != '-')
                                            <button class="btn btn-sm btn-outline-primary" onclick="showBukti('{{ asset('storage/' . $item->bukti_bayar) }}')">
                                                <i class="fas fa-image me-1"></i>Lihat
                                            </button>
                                        @else
                                            <span class="text-muted">Belum upload</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($item->status == '0')
                                                <button class="btn btn-sm btn-success" onclick="konfirmasi({{ $item->id }}, '{{ $item->nama }}')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="tolak({{ $item->id }}, '{{ $item->nama }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-info" onclick="showDetail({{ $item->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Belum ada perusahaan yang terdaftar</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bukti Bayar -->
<div class="modal" id="buktiBayarModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" onclick="closeModal('buktiBayarModal')">&times;</button>
            </div>
            <div class="modal-body text-center">
                <img id="buktiBayarImage" src="" class="img-fluid rounded" alt="Bukti Bayar">
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal" id="detailModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Perusahaan</h5>
                <button type="button" class="btn-close" onclick="closeModal('detailModal')">&times;</button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Detail content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal" id="konfirmasiModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pendaftaran</h5>
                <button type="button" class="btn-close" onclick="closeModal('konfirmasiModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 3rem; margin-bottom: 1rem; color: #28a745;"></i>
                    <p>Apakah Anda yakin ingin mengkonfirmasi pendaftaran perusahaan <strong id="namaPerusahaanKonfirmasi"></strong>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('konfirmasiModal')">Batal</button>
                <form id="konfirmasiForm" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>Konfirmasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-custom')
<script>
function showBukti(imageUrl) {
    document.getElementById('buktiBayarImage').src = imageUrl;
    showModal('buktiBayarModal');
}

function konfirmasi(id, nama) {
    document.getElementById('namaPerusahaanKonfirmasi').textContent = nama;
    document.getElementById('konfirmasiForm').action = `/daftar/konfirmasi/${id}`;
    showModal('konfirmasiModal');
}

function tolak(id, nama) {
    if (confirm(`Apakah Anda yakin ingin menolak pendaftaran perusahaan ${nama}?`)) {
        // Add your reject logic here
        window.location.href = `/daftar/tolak/${id}`;
    }
}

function showDetail(id) {
    fetch(`/daftar/detail/${id}`)
        .then(response => response.json())
        .then(data => {
            const detailContent = document.getElementById('detailContent');
            detailContent.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Perusahaan</h6>
                        <table class="table">
                            <tr><th>Nama Perusahaan:</th><td>${data.perusahaan}</td></tr>
                            <tr><th>PIC:</th><td>${data.nama}</td></tr>
                            <tr><th>Username:</th><td>${data.username}</td></tr>
                            <tr><th>No. HP:</th><td>${data.no_hp}</td></tr>
                            <tr><th>Alamat:</th><td>${data.alamat}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Pembayaran</h6>
                        <table class="table">
                            <tr><th>Bank:</th><td>${data.jenis_bank}</td></tr>
                            <tr><th>No. Rekening:</th><td>${data.norek}</td></tr>
                            <tr><th>Status:</th><td>
                                ${data.status == '0' ? '<span class="badge bg-warning">Menunggu</span>' : 
                                  data.status == '1' ? '<span class="badge bg-success">Terverifikasi</span>' : 
                                  '<span class="badge bg-danger">Ditolak</span>'}
                            </td></tr>
                            <tr><th>Tgl. Daftar:</th><td>${new Date(data.created_at).toLocaleDateString('id-ID')}</td></tr>
                        </table>
                    </div>
                </div>
            `;
            showModal('detailModal');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat detail perusahaan');
        });
}

// Modal functions
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('show');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal(this.id);
        }
    });
});

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#perusahaanTable tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});

// Status filter
document.getElementById('statusFilter').addEventListener('change', function() {
    const filter = this.value;
    const rows = document.querySelectorAll('#perusahaanTable tbody tr');
    
    rows.forEach(row => {
        const status = row.getAttribute('data-status');
        if (filter === '' || status === filter) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal.show').forEach(modal => {
            closeModal(modal.id);
        });
    }
});
</script>
@endsection