@extends('layouts.admin')

@section('namaPage', 'Kategori Wakil Pialang')

@push('styles')
<style>
    .sortable-ghost {
        background-color: #f8f9fa !important;
        opacity: 0.7;
    }
    .sortable-drag {
        background-color: #fff;
        border: 1px solid #e3e6f0;
        box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.1);
        cursor: move;
    }
    .sortable-chosen {
        cursor: move;
    }
    tbody tr {
        cursor: move;
    }
</style>
@endpush

@section('main-content')
@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('kategori-wakil.index') }}" class="btn btn-sm btn-secondary mr-2">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h5 class="m-0 font-weight-bold text-primary">Data Wakil Pialang - {{ $kategori->nama_kategori }}</h5>
        </div>
        <a href="{{route('wakil.create', $kategori->slug)}}" class="btn btn-sm btn-primary">Tambah Wakil</a>
    </div>
    <div class="card-body">
        <div class="table-responsive rounded overflow-hidden m-0 border shadow">
            <table class="table table-bordered table-striped table-hover m-0">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle text-center" width="5%">No</th>
                        <th class="align-middle">Nama</th>
                        <th class="align-middle text-center">Nomor Izin</th>
                        <th class="align-middle text-center">Status</th>
                        <th class="align-middle text-center">Kategori</th>
                        <th class="align-middle text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wakilPialang as $index => $item)
                    <tr data-id="{{ $item->id }}">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td class="text-center">{{ $item->nomor_izin }}</td>
                        <td class="text-center">
                            <span class="badge {{ $item->status === 'aktif' ? 'badge-success' : 'badge-danger' }}">
                                @if ($item->status === 'aktif')
                                Aktif
                                @else
                                Nonaktif
                                @endif
                            </span>
                        </td>
                        <td class="align-middle text-center">{{ $item->kategoriWakilPialang->nama_kategori ?? '-' }}
                        </td>
                        <td class="d-flex align-middle">
                            <!-- Edit Button -->
                            <a href="{{ route('wakil.edit', [$item->kategoriWakilPialang->slug, $item->id]) }}"
                                class="btn btn-sm btn-warning text-dark w-100 mx-1">Edit</a>

                            <!-- Delete Button with Modal Trigger -->
                            <button type="button" class="btn btn-sm btn-danger w-100 mx-1" data-toggle="modal"
                                data-target="#deleteModal{{ $item->id }}">Hapus</button>
                        </td>
                    </tr>

                    <!-- Modal for Delete Confirmation -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah kamu yakin ingin menghapus Wakil Pialang <strong>{{ $item->nama }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form
                                        action="{{ route('wakil.destroy', [$item->kategoriWakilPialang->slug, $item->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-warning border-left-warning text-center m-0">
                                Tidak ada data Wakil Pialang pada {{ $kategori->nama_kategori }}.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    function showAlert(type, message) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} border-left-${type} alert-dismissible fade show mb-3`;
        alert.role = 'alert';
        alert.innerHTML = `
            ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        `;
        
        // Insert the alert before the card
        const card = document.querySelector('.card');
        if (card) {
            card.parentNode.insertBefore(alert, card);
        } else {
            document.body.prepend(alert);
        }
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 3000);
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 3 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000);
        });

        const tbody = document.querySelector('table tbody');
        if (!tbody) return;
        
        // Inisialisasi SortableJS untuk seluruh baris
        const sortable = new Sortable(tbody, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                // Cek apakah posisi item berubah
                if (evt.oldIndex === evt.newIndex) {
                    return; // Tidak ada perubahan posisi, hentikan proses
                }
                
                // Ambil semua ID dalam urutan baru (dari atas ke bawah)
                const newOrder = [];
                tbody.querySelectorAll('tr').forEach((row, index) => {
                    newOrder.push(row.getAttribute('data-id'));
                    // Update nomor urut di tampilan (1, 2, 3, ...)
                    const noTd = row.querySelector('td:first-child');
                    if (noTd) noTd.textContent = index + 1;
                });

                // Kirim permintaan AJAX untuk menyimpan urutan baru
                fetch('{{ route("wakil.update-order", $kategori->slug) }}', {
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
                        showAlert('success', 'Urutan Wakil Pialang berhasil diperbarui.');
                        
                        // Refresh nomor urut
                        tbody.querySelectorAll('tr').forEach((row, index) => {
                            const noTd = row.querySelector('td:first-child');
                            if (noTd) {
                                noTd.textContent = index + 1;
                            }
                        });
                    } else {
                        console.error('Gagal memperbarui urutan');
                        showAlert('danger', 'Gagal memperbarui urutan Wakil Pialang. Silakan coba lagi.');
                        // Kembalikan ke posisi semula jika gagal
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('danger', 'Terjadi kesalahan saat menyimpan urutan Wakil Pialang.');
                });
            }
        });
    });
</script>
@endpush

@endsection