@extends('layouts.admin')

@section('namaPage', 'Produk Multilateral JFX')

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
            <table class="table table-striped table-hover" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr class="text-center align-middle">
                        <th style="width: 5%">No</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ProdukJFX as $index => $item)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
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