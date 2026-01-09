@extends('layouts.admin')

@section('title', 'Detail Banner: ' . $banner->judul)

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center py-3">
                    <h5 class="m-0 font-weight-bold text-gray-800">Detail Banner: {{ $banner->judul }}</h5>
                    <div>
                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('banner.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                @if($banner->image)
                                    <img src="{{ asset('img/banners/' . $banner->image) }}" alt="{{ $banner->judul }}" class="img-fluid rounded shadow" style="max-height: 300px;">
                                @else
                                    <div class="alert alert-warning">Gambar tidak ditemukan</div>
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                                        <span class="text-muted">Tidak ada gambar</span>
                                    </div>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="40%">Status</th>
                                    <td>
                                        <span class="badge {{ $banner->status === 'active' ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $banner->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>URL Tautan</th>
                                    <td>
                                        @if($banner->url)
                                            <a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a>
                                        @else
                                            <span class="text-muted">Tidak ada tautan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat</th>
                                    <td>{{ $banner->created_at->translatedFormat('d F Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui</th>
                                    <td>{{ $banner->updated_at->translatedFormat('d F Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">{{ $banner->judul }}</h4>
                            <hr>
                            <div class="mb-4">
                                <h5>Deskripsi:</h5>
                                <div class="p-3 bg-light rounded">
                                    {!! nl2br(e($banner->deskripsi ?? 'Tidak ada deskripsi')) !!}
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-3 border-top">
                                <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" class="d-inline" 
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Hapus Banner
                                    </button>
                                </form>
                                
                                <form action="{{ route('banner.toggle-status', $banner->id) }}" method="POST" class="d-inline" 
                                    onsubmit="return confirm('Apakah Anda yakin ingin mengubah status banner ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $banner->status === 'active' ? 'btn-warning' : 'btn-success' }}">
                                        <i class="fas {{ $banner->status === 'active' ? 'fa-eye-slash' : 'fa-eye' }}"></i> 
                                        {{ $banner->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .img-thumbnail {
        max-width: 100%;
        height: auto;
    }
</style>
@endpush

@push('scripts')
<script>
    // Tambahkan script khusus halaman show di sini jika diperlukan
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tooltip
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush

@endsection
