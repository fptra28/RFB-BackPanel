@extends('layouts.admin')

@section('namaPage', 'Kelola Karier')

@section('main-content')

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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 text-gray-800 font-weight-bold">Daftar Karier</h5>
            <a href="{{ route('karier.create') }}" class="btn btn-primary btn-sm shadow">
                <i class="fas fa-plus"></i> Tambah Karier
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive rounded overflow-hidden mb-0 border shadow">
            <table class="table table-striped table-hover" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr class="text-center align-middle">
                        <th style="width: 5%">No</th>
                        <th style="width: 15%">Kota</th>
                        <th style="width: 20%">Posisi</th>
                        <th class="d-none d-md-table-cell" style="width: 20%">Email</th>
                        <th class="d-none d-lg-table-cell" style="width: 25%">Responsibilities</th>
                        <th class="d-none d-xl-table-cell" style="width: 25%">Qualifications</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kariers as $index => $karier)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $karier->nama_kota }}</td>
                        <td class="align-middle">{{ $karier->posisi }}</td>
                        <td class="align-middle d-none d-md-table-cell">
                            <small class="text-muted">{{ $karier->email }}</small>
                        </td>
                        <td class="align-middle d-none d-lg-table-cell">
                            <small>{{ \Illuminate\Support\Str::limit(strip_tags($karier->responsibilities), 50) }}</small>
                        </td>
                        <td class="align-middle d-none d-xl-table-cell">
                            <small>{{ \Illuminate\Support\Str::limit(strip_tags($karier->qualifications), 50) }}</small>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('karier.edit', $karier->id) }}" class="btn btn-sm btn-primary w-100 mr-1">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger w-100 ml-1" data-toggle="modal" data-target="#deleteModal{{ $karier->id }}">Hapus</button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $karier->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $karier->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $karier->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data karier untuk <strong>"{{ $karier->nama_kota }} - {{ $karier->posisi }}"</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="{{ route('karier.destroy', $karier->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data karier</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-right text-muted">
            <p class="mb-0"><strong>Jumlah Karier:</strong> <span>{{ $kariers->count() }} Data</span></p>
        </div>
    </div>
</div>

@endsection