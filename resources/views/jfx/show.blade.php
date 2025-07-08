@extends('layouts.admin')

@section('namaPage')
{{$produk->name}}
@endsection

@section('main-content')
@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
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
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('jfx.index') }}" class="btn btn-secondary btn-sm shadow">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <a href="{{ route('jfx.edit', $produk->id) }}" class="btn btn-primary btn-sm shadow">
                Edit Produk
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center align-items-center flex-column mb-3">
            <!-- Menampilkan gambar produk dengan kelas img-fluid untuk membuatnya responsif -->
            <h4 class="mt-3 font-weight-bold">{{ $produk->name }}</h4>
            <img src="{{ asset('img/produk/jfx/'.$produk->image) }}" alt="{{ $produk->name }}" class="img-fluid rounded"
                style="max-width: 500px; width: 100%; height: auto;" loading="lazy">
        </div>
        <div>
            <!-- Menampilkan deskripsi produk -->
            <p class="lead">{{ $produk->deskripsi }}</p>
        </div>
        <div>
            <h5 class="text-center font-weight-bold">Spesifikasi Produk</h5>
            <!-- Pastikan specs aman dan tidak berisiko XSS -->
            {!! $produk->specs !!}
        </div>
    </div>
</div>
@endsection