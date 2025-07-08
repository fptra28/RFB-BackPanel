@extends('layouts.err')

@section('namaPage', '500 Not Found')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <!-- Gambar Error 500 -->
        <img src="{{ asset('img/svg/500.svg') }}" alt="500 Error" class="img-fluid mb-4" style="max-width: 500px;">

        <h1 class="display-1 font-weight-bold text-danger">500</h1>
        <h2 class="h3">Oops! Terjadi Kesalahan pada Server</h2>
        <p class="lead text-muted">Kami mengalami masalah sementara di server. Mohon coba lagi nanti.</p>

        <!-- Button to contact support -->
        <p class="text-muted">Jika masalah terus berlanjut, Anda bisa menghubungi tim support kami.</p>

        <a href="mailto:support@domain.com" class="btn btn-warning mb-3">Hubungi Support</a>

        <br>

        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>
@endsection