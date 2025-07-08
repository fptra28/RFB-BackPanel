@extends('layouts.admin')

@section('namaPage')
{{$berita->judul}}
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
            <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-sm shadow">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-primary btn-sm shadow">
                Edit Berita
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center align-items-center flex-column mb-3">
            <!-- Menampilkan gambar berita dengan kelas img-fluid untuk membuatnya responsif -->
            <h4 class="mt-3 font-weight-bold text-center">{{ $berita->judul }}</h4>
            @if($berita->image)
            <img src="{{ asset('img/berita/' . $berita->image) }}" alt="{{ $berita->judul }}" class="img-fluid rounded"
                style="max-height: 300px; width: auto; height: 100%;" loading="lazy">
            @endif
        </div>
        <div>
            <!-- Menampilkan isi berita -->
            <p class="lead">{!! $berita->isi !!}</p>
        </div>
    </div>
</div>
@endsection