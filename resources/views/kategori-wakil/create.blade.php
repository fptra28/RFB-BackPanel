@extends('layouts.admin')

@section('namaPage', 'Tambah Kategori Wakil Pialang')

@section('main-content')
@if ($errors->any())
<div class="alert alert-danger border-left-danger">
    <strong>Terjadi kesalahan!</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <a href="{{ route('kategori-wakil.index') }}" class="btn btn-secondary mr-3">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h5 class="m-0 font-weight-bold">Form Tambah Kategori</h5>
        </div>
    </div>
    <div class="card-body">
        <form id="kategoriForm" action="{{ route('kategori-wakil.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori"
                    class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                    value="{{ old('nama_kategori') }}" required>
                @error('nama_kategori')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#confirmationModal">
                Simpan
            </button>

            <!-- Modal Konfirmasi -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
                aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Simpan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menyimpan kategori ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" form="kategoriForm">Ya, Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection