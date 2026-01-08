@extends('layouts.admin')

@section('namaPage', 'Berita')

@push('styles')
<style>
    .sortable-ghost {
        opacity: 0.5;
        background: #f8f9fa;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .sortable-chosen {
        cursor: move;
        cursor: grab;
        background-color: #f8f9fa;
    }
    #sortable-tbody tr {
        cursor: move;
        cursor: grab;
    }
    #sortable-tbody tr:active {
        cursor: grabbing;
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

<!-- Filter Berdasarkan Kategori -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 text-gray-800 font-weight-bold">
                @if (request('status') === 'draft')
                Draft
                @elseif (request('kategori') === 'Pengumuman' || request('kategori') === null)
                Berita Pengumuman
                @else
                Berita Info & Kegiatan
                @endif
            </h5>

            <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm shadow">
                Tambah Berita
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Tombol Kategori -->
        <form method="GET" action="{{ route('berita.index') }}" class="mb-3">
            <div class="form-inline">
                <select name="kategori" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <option value="">Pilih Kategori</option>
                    <option value="Pengumuman" {{ request('kategori')==='Pengumuman' ? 'selected' : '' }}>Pengumuman
                    </option>
                    <option value="Info & Kegiatan" {{ request('kategori')==='Info & Kegiatan' ? 'selected' : '' }}>Info
                        & Kegiatan</option>
                </select>

                <a href="{{ route('berita.index', ['status' => 'draft']) }}"
                    class="btn btn-sm {{ request('status') === 'draft' ? 'btn-primary' : 'btn-secondary' }} mx-2">
                    Draft
                </a>

                <a href="{{ route('berita.index') }}" class="btn btn-sm btn-danger ml-2">Reset</a>
            </div>
        </form>

        @if(request('kategori') || request('status') === 'draft')
        <div class="alert alert-info mb-3" id="filter-notification">
            <i class="fas fa-info-circle"></i> Fitur pengurutan dinonaktifkan saat menggunakan filter.
            <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary ml-2">Hilangkan Filter</a>
        </div>
        @endif

        <div class="table-responsive rounded overflow-hidden m-0 border shadow">
            <table class="table table-striped table-hover mb-0" width="100%" cellspacing="0" id="sortable-table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Judul</th>
                        <th class="text-center align-middle">Kategori</th>
                        <th class="text-center align-middle">Tanggal</th>
                        <th class="text-center align-middle">Aksi</th>
                    </tr>
                </thead>

                <tbody id="sortable-tbody">
                    @forelse ($beritaFiltered as $index => $berita)
                    <tr data-id="{{ $berita->id }}">
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="text-left align-middle" style="max-width: 350px;">
                            {{ Str::limit(strip_tags($berita->judul), 90, '...') }}</td>
                        <td class="text-center align-middle">{{ $berita->kategori }}</td>
                        <td class="text-center align-middle" style="max-width: 130px;">{{
                            $berita->created_at->format('D, d F Y, H:i') }}</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="{{ Route('berita.show', $berita->id) }}"
                                    class="btn btn-sm btn-success w-100 mr-1">Lihat</a>
                                <a href="{{ route('berita.edit', $berita->id) }}"
                                    class="btn btn-sm btn-primary w-100 mx-1">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger w-100 ml-1" data-toggle="modal"
                                    data-target="#deleteModal{{ $berita->id }}">
                                    Hapus
                                </button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $berita->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel{{ $berita->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $berita->id }}">Konfirmasi
                                                Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah kamu yakin ingin menghapus berita <strong>"{{ $berita->judul
                                                }}"</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST">
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
                        <td colspan="5" class="text-center">Belum ada berita.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-right text-muted">
            <p class="mb-0"><strong>Jumlah Berita:</strong> <span>{{ $countBerita }} Berita</span></p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 3 seconds, except for filter notification
        document.querySelectorAll('.alert:not(#filter-notification)').forEach(function(alert) {
            setTimeout(function() {
                const alertInstance = new bootstrap.Alert(alert);
                alertInstance.close();
            }, 3000);
        });

        const tbody = document.getElementById('sortable-tbody');
        if (!tbody) return;
        
        // Cek apakah ada filter aktif
        const urlParams = new URLSearchParams(window.location.search);
        const hasFilter = urlParams.has('kategori') || urlParams.get('status') === 'draft';

        if (hasFilter) {
            // Jika ada filter, nonaktifkan drag and drop
            tbody.querySelectorAll('tr').forEach(row => {
                row.style.cursor = 'default';
                row.draggable = false;
            });
            return; // Keluar dari fungsi, tidak inisialisasi Sortable
        }

        // Inisialisasi Sortable hanya jika tidak ada filter
        const sortable = new Sortable(tbody, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            // Mengaktifkan drag dari mana saja di baris
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
                fetch('{{ route("berita.update-order") }}', {
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
                            Urutan berita berhasil diperbarui.
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
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan urutan');
                });
            }
        });
    });
</script>
@endpush