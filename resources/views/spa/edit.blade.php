@extends('layouts.admin')

@section('namaPage', 'Edit Produk JFX')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <a href="{{ route('spa.index') }}" class="btn btn-secondary mr-3">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h5 class="m-0 font-weight-bold">Form Edit Produk SPA</h5>
        </div>
    </div>
    <div class="card-body">
        <form id="productForm" action="{{ route('spa.update', $produk->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Menambahkan method PUT untuk update -->

            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <div class="mb-2">
                    <img src="{{ asset('img/produk/' . $produk->image) }}" alt="{{ $produk->name }}" width="150">
                </div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                <small>Biarkan kosong jika tidak ingin mengubah gambar</small>
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $produk->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                    rows="3" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="specs">Spesifikasi</label>
                <textarea class="form-control @error('specs') is-invalid @enderror" id="specs" name="specs"
                    rows="8">{{ old('specs', $produk->specs) }}</textarea>
                @error('specs')
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengubah produk ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Ya, Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/rijrac2uxn06a1q296snq7j1fi420fd29r3lc1o12yzq6fwv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#specs',
        height: 700,
        plugins: `
            print preview paste importcss searchreplace autolink autosave save directionality
            code visualblocks visualchars fullscreen image link media template codesample table
            charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount
            imagetools textpattern noneditable help charmap quickbars emoticons
        `,
        toolbar: `
            undo redo | bold italic underline strikethrough | fontfamily fontsize blocks |
            alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist |
            forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview
            save print | insertfile image media template link anchor codesample | ltr rtl | table
        `,
        menubar: 'file edit view insert format tools table help',
        toolbar_mode: 'sliding',
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        image_advtab: true,
        branding: false,

        // Aktifkan Table Toolbar Lengkap
        table_toolbar: `
            tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow |
            tableinsertcolbefore tableinsertcolafter tabledeletecol | tablecellprops tablemergecells
        `,

        content_style: `
            body { font-family:Helvetica,Arial,sans-serif; font-size:14px }
            table { border-collapse: collapse; width: 100%; border: 1px solid #d1d5db; }
            th, td { border: 1px solid #d1d5db; padding: 8px; text-align: center; }
            th { background-color: #f3f4f6; font-weight: bold; }
        `,

        setup: function (editor) {
            editor.on('NodeChange', function (e) {
                if (e && e.element.nodeName.toLowerCase() === 'table') {
                    e.element.classList.add('table-auto', 'w-full', 'border', 'border-gray-300');
                }
            });
        }
    });

    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('productForm').submit();
    });
</script>

@endsection