@extends('layouts.err')

@section('namaPage', '400 Bad Request')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <!-- Gambar Error 400 -->
        <img src="{{ asset('img/svg/400.svg') }}" alt="400 Error" class="img-fluid mb-4" style="max-width: 500px;">

        <h1 class="display-1 font-weight-bold text-danger">400</h1>
        <h2 class="h3">Permintaan Tidak Valid</h2>
        <p class="lead text-muted">Terjadi kesalahan dengan permintaan yang Anda kirimkan. Periksa kembali data yang
            Anda masukkan.</p>

        <!-- Button to go back to home page -->
        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>
@endsection