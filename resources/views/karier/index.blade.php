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
        <div class="table-responsive rounded overflow-hidden m-0 border shadow">
            <table class="table table-striped table-hover mb-0" width="100%" cellspacing="0" id="karierTable">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Kota</th>
                        <th class="text-center align-middle">Posisi</th>
                        <th class="text-center align-middle">Responsibilities</th>
                        <th class="text-center align-middle">Qualifications</th>
                        <th class="text-center align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kariers as $index => $karier)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="text-center align-middle">{{ $karier->nama_kota }}</td>
                        <td class="text-center align-middle">{{ $karier->posisi }}</td>
                        <td class="align-middle">
                            <div class="text-truncate" style="max-width: 200px;" title="{!! strip_tags($karier->responsibilities) !!}">
                                {!! Str::limit(strip_tags($karier->responsibilities), 100) !!}
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="text-truncate" style="max-width: 200px;" title="{!! strip_tags($karier->qualifications) !!}">
                                {!! Str::limit(strip_tags($karier->qualifications), 100) !!}
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('karier.edit', $karier->id) }}" 
                                   class="btn btn-sm btn-primary mx-1" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('karier.destroy', $karier->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mx-1" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data karier</td>
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

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        $("#karierTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [[0, 'asc']],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush

@endsection