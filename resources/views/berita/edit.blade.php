@extends('layouts.admin')

@section('namaPage', 'Edit Berita')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <a href="{{ route('berita.index') }}" class="btn btn-secondary mr-3">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h5 class="m-0 font-weight-bold">Form Edit Berita</h5>
        </div>
    </div>
    <div class="card-body">
        <!-- Mengubah route ke 'berita.update' dan menambahkan method PUT -->
        <form id="productForm" action="{{ route('berita.update', $berita->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Status Berita (Pindah ke Paling Atas) -->
            <div class="form-group">
                <label for="status">Status Berita</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draft
                    </option>
                    <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : ''
                        }}>Published</option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex">
                <div class="form-group w-100 mr-1">
                    <label for="image">Gambar</label>
                    @if ($berita->image)
                    <!-- Menampilkan gambar yang sudah ada -->
                    <img src="{{ asset('img/berita/' . $berita->image) }}" alt="Gambar Berita" class="mt-2" width="100">
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group w-100 ml-1">
                    <label for="kategori">Kategori</label>
                    <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori"
                        required>
                        <option value="Info & Kegiatan" {{ old('kategori', $berita->kategori) == 'Info & Kegiatan' ?
                            'selected' : '' }}>Info & Kegiatan</option>
                        <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' :
                            '' }}>Pengumuman</option>
                    </select>
                    @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="judul">Judul Berita</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                    value="{{ old('judul', $berita->judul) }}" required>
                @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="isi">Isi Berita</label>
                <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="8"
                    required>{{ old('isi', $berita->isi) }}</textarea>
                @error('isi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menyimpan perubahan pada Berita ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Ya, Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/rijrac2uxn06a1q296snq7j1fi420fd29r3lc1o12yzq6fwv/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#isi',
        height: 700,
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
        menubar: 'file edit view insert format tools table help',
        toolbar_mode: 'sliding',
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        image_advtab: true,
        branding: false,
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

    // Kirim form setelah klik konfirmasi
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('productForm').submit();
    });
</script>
@endsection