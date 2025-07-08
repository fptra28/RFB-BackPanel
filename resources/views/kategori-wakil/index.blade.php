@extends('layouts.admin')

@section('namaPage', 'Kategori Wakil Pialang')

@section('main-content')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 m-0 text-gray-800">{{ __('Kategori Wakil Pialang') }}</h1>
    <a href="{{ route('kategori-wakil.create') }}" class="btn btn-primary">Tambah</a>
</div>

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

<div class="row">
    @forelse ($kategori as $item)
    <div class="col-12 col-sm-6 col-lg-4 mb-4">
        <div class="card border-left-primary shadow h-100 p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <!-- Teks di kiri -->
                <div class="d-flex align-items-center text-primary mb-3 mb-md-0">
                    <i class="fa-solid fa-2x fa-location-dot mr-3"></i>
                    <div>
                        <h5 class="mb-1 font-weight-bold">{{ $item->nama_kategori }}</h5>
                        <small class="text-muted">{{ $item->wakil_pialang_count }} Wakil Pialang</small>
                    </div>
                </div>

                <!-- Tombol container di kanan -->
                <div class="d-flex flex-wrap justify-content-start align-items-center justify-content-md-end">
                    <!-- Tombol "Lihat" -->
                    <a href="{{ route('wakil.index', $item->slug) }}"
                        class="btn btn-sm btn-success rounded-pill px-3 mr-2">
                        Lihat
                    </a>

                    <!-- Tombol "Edit" -->
                    <a href="{{ route('kategori-wakil.edit', $item->id) }}"
                        class="btn btn-sm btn-warning rounded-pill px-3 mr-2">
                        Edit
                    </a>

                    <!-- Tombol Hapus yang akan membuka modal -->
                    <button type="button" class="btn btn-sm btn-danger rounded-pill px-3" data-toggle="modal"
                        data-target="#hapusModal{{ $item->id }}">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="hapusModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus kategori "{{ $item->nama_kategori }}"? Proses ini tidak dapat
                    dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <!-- Form hapus kategori -->
                    <form action="{{ route('kategori-wakil.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="container">
        <div class="alert alert-warning border-left-warning text-center">
            Tidak ada data Kategori Wakil Pialang.
        </div>
    </div>
    @endforelse
</div>

@endsection