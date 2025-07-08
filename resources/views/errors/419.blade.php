@extends('layouts.err')

@section('namaPage', '419 Page Expired')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <!-- Gambar Error 419 -->
        <img src="{{ asset('img/svg/419.svg') }}" alt="419 Error" class="img-fluid mb-4" style="max-width: 500px;">

        <h1 class="display-1 font-weight-bold text-info">419</h1>
        <h2 class="h3">Sesi Anda Telah Berakhir</h2>
        <p class="lead text-muted">Sesi Anda telah berakhir. Silakan refresh halaman atau login kembali untuk
            melanjutkan.</p>

        <!-- Button to refresh or login again -->
        <a href="{{ route('login') }}" class="btn btn-success mb-3">Login Kembali</a>

        <br>

        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>
@endsection