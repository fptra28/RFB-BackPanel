@extends('layouts.admin')

@section('namaPage', 'Edit Wakil Pialang')

@section('main-content')
@if ($errors->any())
<div class="alert alert-danger border-left-danger">
    <ul class="mb-0 pl-3">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('wakil.index', $kategori->slug) }}" class="btn btn-sm btn-secondary mr-2">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h5 class="m-0 font-weight-bold text-primary">Edit Wakil Pialang - {{ $kategori->nama_kategori }}</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('wakil.update', [$kategori->slug, $wakil->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Menggunakan method PUT untuk update -->

            <div class="form-group">
                <label for="nama">Nama Wakil Pialang</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $wakil->nama) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="nomor_izin">Nomor Izin</label>
                <input type="text" class="form-control" id="nomor_izin" name="nomor_izin"
                    value="{{ old('nomor_izin', $wakil->nomor_izin) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="aktif" {{ $wakil->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="non-aktif" {{ $wakil->status === 'non-aktif' ? 'selected' : '' }}>Nonaktif
                    </option>
                </select>
            </div>

            <!-- Hidden: relasi kategori berdasarkan slug -->
            <input type="hidden" name="kategori_wakil_pialang_id" value="{{ $kategori->id }}">

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection