@extends('layouts.admin')

@section('namaPage', 'Kelola Karier')

@push('styles')
<style>
    .sortable-ghost {
        opacity: 0.5;
        background: #f8f9fa;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .sortable-chosen {
        cursor: move;
        background-color: #f8f9fa;
    }
    .sortable-drag {
        cursor: grabbing;
        background-color: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: rotate(1deg);
    }
    .sortable-ghost td {
        border: 2px dashed #3490dc;
        background: #f0f7ff;
    }
    #sortable-tbody tr {
        cursor: move;
        cursor: grab;
    }
    #sortable-tbody tr:active {
        cursor: grabbing;
    }
</style>
@endpush

@section('main-content')

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger border-left-danger alert-dismissible fade show mb-3" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success alert-dismissible fade show mb-3" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 text-gray-800 font-weight-bold">Daftar Karier</h5>
            <a href="{{ route('karier.create') }}" class="btn btn-primary btn-sm shadow">
                <i class="fas fa-plus"></i> Tambah Karier
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive rounded overflow-hidden mb-0 border shadow">
            <table class="table table-striped table-hover" width="100%" cellspacing="0" id="sortable-table">
                <thead class="thead-dark">
                    <tr class="text-center align-middle">
                        <th style="width: 5%">No</th>
                        <th style="width: 15%">Kota</th>
                        <th style="width: 20%">Posisi</th>
                        <th class="d-none d-md-table-cell" style="width: 20%">Email</th>
                        <th class="d-none d-lg-table-cell" style="width: 25%">Responsibilities</th>
                        <th class="d-none d-xl-table-cell" style="width: 25%">Qualifications</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortable-tbody">
                    @forelse ($kariers as $index => $karier)
                    <tr data-id="{{ $karier->id }}">
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $karier->nama_kota }}</td>
                        <td class="align-middle">{{ $karier->posisi }}</td>
                        <td class="align-middle d-none d-md-table-cell">
                            <small class="text-muted">{{ $karier->email }}</small>
                        </td>
                        <td class="align-middle d-none d-lg-table-cell">
                            <small>{{ \Illuminate\Support\Str::limit(strip_tags($karier->responsibilities), 50) }}</small>
                        </td>
                        <td class="align-middle d-none d-xl-table-cell">
                            <small>{{ \Illuminate\Support\Str::limit(strip_tags($karier->qualifications), 50) }}</small>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('karier.edit', $karier->id) }}" class="btn btn-sm btn-primary w-100 mr-1">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger w-100 ml-1" data-toggle="modal" data-target="#deleteModal{{ $karier->id }}">Hapus</button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $karier->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $karier->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $karier->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data karier untuk <strong>"{{ $karier->nama_kota }} - {{ $karier->posisi }}"</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="{{ route('karier.destroy', $karier->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data karier</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-right text-muted">
            <p class="mb-0"><strong>Jumlah Karier:</strong> <span>{{ $kariers->count() }} Data</span></p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 3 seconds
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                const alertInstance = new bootstrap.Alert(alert);
                alertInstance.close();
            }, 3000);
        });

        const tbody = document.getElementById('sortable-tbody');
        if (!tbody) return;
        
        // Simpan urutan asli
        let originalOrder = [];
        tbody.querySelectorAll('tr').forEach(row => {
            originalOrder.push(row.getAttribute('data-id'));
        });

        // Inisialisasi SortableJS
        const sortable = new Sortable(tbody, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onStart: function() {
                // Simpan urutan asli saat mulai drag
                originalOrder = [];
                tbody.querySelectorAll('tr').forEach(row => {
                    originalOrder.push(row.getAttribute('data-id'));
                });
            },
            onEnd: function() {
                // Ambil semua ID dalam urutan baru
                const newOrder = [];
                tbody.querySelectorAll('tr').forEach((row, index) => {
                    newOrder.push(row.getAttribute('data-id'));
                    // Update nomor urut
                    const noTd = row.querySelector('td:first-child');
                    noTd.textContent = index + 1;
                });

                // Cek apakah ada perubahan urutan
                const hasChanged = JSON.stringify(originalOrder) !== JSON.stringify(newOrder);

                // Hanya kirim permintaan jika ada perubahan
                if (!hasChanged) return;

                // Kirim permintaan AJAX untuk menyimpan urutan baru
                fetch('{{ route("karier.update-order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ order: newOrder })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tampilkan notifikasi sukses
                        const alert = document.createElement('div');
                        alert.className = 'alert alert-success border-left-success alert-dismissible fade show mb-3';
                        alert.role = 'alert';
                        alert.innerHTML = `
                            Urutan karier berhasil diperbarui.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        `;
                        // Sisipkan notifikasi sebelum card
                        const card = document.querySelector('.card');
                        card.parentNode.insertBefore(alert, card);

                        // Sembunyikan notifikasi setelah 3 detik
                        setTimeout(() => {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }, 3000);
                    }
                    if (data.success) {
                        // Tampilkan notifikasi sukses
                        showAlert('success', 'Urutan karier berhasil diperbarui.');
                    } else {
                        throw new Error(data.message || 'Gagal memperbarui urutan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('danger', 'Gagal memperbarui urutan: ' + error.message);
                    // Reload halaman untuk sinkronisasi dengan server
                    setTimeout(() => window.location.reload(), 2000);
                });
            }
        });
        
        // Fungsi untuk menampilkan notifikasi
        function showAlert(type, message) {
            // Buat elemen alert baru
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} border-left-${type} alert-dismissible fade show`;
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>`;
            
            // Tambahkan ke container notifikasi di atas tabel
            const container = document.getElementById('notification-container');
            container.insertBefore(alertDiv, container.firstChild);
            
            // Sembunyikan setelah 5 detik
            setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => alertDiv.remove(), 150);
            }, 5000);
        }
    });
</script>
@endpush