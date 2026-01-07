@extends('layouts.admin')

@section('namaPage', 'Produk Multilateral JFX')

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
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 text-gray-800 font-weight-bold">{{ __('Produk Multilateral JFX') }}</h5>
            <a href="{{ route('jfx.create') }}" class="btn btn-primary btn-sm shadow">
                Tambah Produk
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive rounded overflow-hidden mb-0 border shadow">
            <table class="table table-striped table-hover" width="100%" cellspacing="0" id="sortable-table">
                <thead class="thead-dark">
                    <tr class="text-center align-middle">
                        <th style="width: 5%">No</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortable-tbody">
                    @forelse ($ProdukJFX as $index => $item)
                    <tr data-id="{{ $item->id }}">
                        <td class="text-center align-middle">
                            {{ $index + 1 }}
                        </td>
                        <td class="align-middle">{{ $item->name }}</td>
                        <td class="align-middle" style="max-width: 350px;">
                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 150) }}
                        </td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('jfx.show', $item->id) }}" class="btn btn-sm btn-success w-100 mr-1">
                                    Lihat
                                </a>
                                <a href="{{ route('jfx.edit', $item->id) }}" class="btn btn-sm btn-primary w-100 mx-1">
                                    Edit
                                </a>
                                <!-- Tombol Trigger Modal -->
                                <button type="button" class="btn btn-sm btn-danger w-100 ml-1" data-toggle="modal"
                                    data-target="#deleteModal{{ $item->id }}">
                                    Hapus
                                </button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi
                                                Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah kamu yakin ingin menghapus produk <strong>{{ $item->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <form action="{{ route('jfx.destroy', $item->id) }}" method="POST">
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
                        <td colspan="4" class="text-center">Tidak ada data produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-right text-muted">
            <p class="mb-0"><strong>Jumlah Produk:</strong> <span>{{ $countProduk }} Produk</span></p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('sortable-tbody');
        
        // Simpan urutan asli
        let originalOrder = [];
        tbody.querySelectorAll('tr').forEach(row => {
            originalOrder.push(row.getAttribute('data-id'));
        });

        // Inisialisasi SortableJS untuk seluruh baris
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
            onEnd: function(evt) {
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
                fetch('{{ route("jfx.update-order") }}', {
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
                        alert.className = 'alert alert-success alert-dismissible fade show';
                        alert.role = 'alert';
                        alert.innerHTML = `
                            Urutan produk berhasil diperbarui.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        `;
                        document.querySelector('.card-body').insertBefore(alert, document.querySelector('.table-responsive'));

                        // Sembunyikan notifikasi setelah 3 detik
                        setTimeout(() => {
                            alert.classList.remove('show');
                            setTimeout(() => alert.remove(), 150);
                        }, 3000);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
</script>
@endpush