@extends('layouts.err')

@section('namaPage', '404 Not Found')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <!-- Gambar Error di bagian atas -->
        <img src="{{ asset('img/svg/7741849_3747372.svg') }}" alt="404 Error" class="img-fluid mb-4"
            style="max-width: 500px;">
        <h2 class="h3">Ups! Halaman Tidak Ditemukan</h2>
        <p class="lead text-muted">Kami tidak dapat menemukan halaman yang Anda cari. Mungkin halaman tersebut telah
            dihapus, namanya telah diubah, atau sedang tidak tersedia.</p>

        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>
@endsection