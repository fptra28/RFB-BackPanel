@extends('layouts.admin')

@section('namaPage', 'Kategori Wakil Pialang')

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

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('kategori-wakil.index') }}" class="btn btn-sm btn-secondary mr-2">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h5 class="m-0 font-weight-bold text-primary">Data Wakil Pialang - {{ $kategori->nama_kategori }}</h5>
        </div>
        <a href="{{route('wakil.create', $kategori->slug)}}" class="btn btn-sm btn-primary">Tambah Wakil</a>
    </div>
    <div class="card-body">
        <div class="table-responsive rounded overflow-hidden m-0 border shadow">
            <table class="table table-bordered table-striped table-hover m-0">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle text-center">No</th>
                        <th class="align-middle text-center">Nama</th>
                        <th class="align-middle text-center">Nomor Izin</th>
                        <th class="align-middle text-center">Status</th>
                        <th class="align-middle text-center">Kategori</th>
                        <th class="align-middle text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wakilPialang as $index => $item)
                    <tr>
                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $item->nama }}</td>
                        <td class="align-middle text-center">{{ $item->nomor_izin }}</td>
                        <td class="align-middle text-center">
                            <span class="badge badge-{{ $item->status === 'aktif' ? 'success' : 'danger' }} ">
                                @if ($item->status === 'aktif')
                                Aktif
                                @else
                                Nonaktif
                                @endif
                            </span>
                        </td>
                        <td class="align-middle text-center">{{ $item->kategoriWakilPialang->nama_kategori ?? '-' }}
                        </td>
                        <td class="d-flex align-middle">
                            <!-- Edit Button -->
                            <a href="{{ route('wakil.edit', [$item->kategoriWakilPialang->slug, $item->id]) }}"
                                class="btn btn-sm btn-warning text-dark w-100 mx-1">Edit</a>

                            <!-- Delete Button with Modal Trigger -->
                            <button type="button" class="btn btn-sm btn-danger w-100 mx-1" data-toggle="modal"
                                data-target="#deleteModal{{ $item->id }}">Hapus</button>
                        </td>
                    </tr>

                    <!-- Modal for Delete Confirmation -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah kamu yakin ingin menghapus Wakil Pialang <strong>{{ $item->nama }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form
                                        action="{{ route('wakil.destroy', [$item->kategoriWakilPialang->slug, $item->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-warning border-left-warning text-center m-0">
                                Tidak ada data Wakil Pialang pada {{ $kategori->nama_kategori }}.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection