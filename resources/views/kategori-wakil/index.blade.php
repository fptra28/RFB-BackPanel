@extends('layouts.admin')

@section('namaPage', 'Kategori Wakil Pialang')

@section('main-content')
<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 text-gray-800 font-weight-bold">Daftar Kategori Wakil Pialang</h6>
        <a href="{{ route('kategori-wakil.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>
    <div class="card-body">
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
                <div class="card border-left-primary shadow h-100 p-3 bg-white">
                    <div class="d-flex flex-column">
                        <!-- Baris Pertama: Nama Kategori -->
                        <div class="d-flex align-items-center text-primary mb-2">
                            <i class="fa-solid fa-2x fa-location-dot mr-3"></i>
                            <h5 class="m-0 font-weight-bold">{{ $item->nama_kategori }}</h5>
                        </div>
                        
                        <!-- Baris Kedua: Info dan Tombol -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <!-- Jumlah Wakil Pialang -->
                            <div class="mb-2 mb-md-0">
                                <small class="text-muted">{{ $item->wakil_pialang_count }} Wakil Pialang</small>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="d-flex flex-wrap gap-1">
                                <!-- Tombol "Lihat" -->
                                <a href="{{ route('wakil.index', $item->slug) }}" 
                                   class="btn btn-sm btn-success rounded-pill px-3">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Tombol "Edit" -->
                                <a href="{{ route('kategori-wakil.edit', $item->id) }}" 
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <button type="button" 
                                        class="btn btn-sm btn-danger rounded-pill px-3" 
                                        data-toggle="modal"
                                        data-target="#hapusModal{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
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
                <div class="alert alert-info">Tidak ada data kategori wakil pialang.</div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection