@extends('layouts.admin')

@section('namaPage', 'Edit Banner')

@section('main-content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-gray-800">Edit Banner: {{ $banner->judul }}</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="judul">Judul Banner</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" 
                                   value="{{ old('judul', $banner->judul) }}" required>
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" 
                                      rows="3">{{ old('deskripsi', $banner->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="url">URL Tautan (Opsional)</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                   id="url" name="url" 
                                   placeholder="https://example.com"
                                   value="{{ old('url', $banner->url) }}">
                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Gambar Banner</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">
                                    {{ $banner->image ? basename($banner->image) : 'Pilih gambar baru' }}
                                </label>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Ukuran rekomendasi: 1920x600px, format: JPG/PNG, maks: 2MB</small>
                            <div class="mt-2">
                                @if($banner->image)
                                    <img id="image-preview" 
                                         src="{{ asset('img/banners/' . $banner->image) }}" 
                                         alt="Preview Gambar" 
                                         style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                                @else
                                    <div class="alert alert-warning mt-2">Tidak ada gambar</div>
                                    <img id="image-preview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; display: none; margin-top: 10px;">
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="active" {{ old('status', $banner->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $banner->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('banner.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .custom-file-label::after {
        content: "Pilih File";
    }
    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Pilih File";
    }
</style>
@endpush

@push('scripts')
<script>
// Preview gambar sebelum diupload
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#image-preview')
                .attr('src', e.target.result)
                .css('display', 'block');
            
            // Sembunyikan pesan peringatan jika ada
            $('.alert-warning').hide();
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Tampilkan nama file yang dipilih
$(document).ready(function() {
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        
        // Tampilkan preview gambar
        readURL(this);
    });
    
    // Inisialisasi preview gambar jika ada gambar lama
    @if($banner->image)
        $('#image-preview').show();
    @endif
});
</script>
@endpush
