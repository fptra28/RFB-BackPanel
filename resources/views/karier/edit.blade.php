@extends('layouts.admin')

@section('namaPage', 'Edit Lowongan Karier')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 text-gray-800 font-weight-bold">Edit Lowongan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('karier.update', $karier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_kota">Nama Kota</label>
                        <input type="text" class="form-control @error('nama_kota') is-invalid @enderror" 
                               id="nama_kota" name="nama_kota" value="{{ old('nama_kota', $karier->nama_kota) }}" required>
                        @error('nama_kota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" class="form-control @error('posisi') is-invalid @enderror" 
                               id="posisi" name="posisi" value="{{ old('posisi', $karier->posisi) }}" required>
                        @error('posisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="responsibilities">Responsibilities:</label>
                <textarea class="form-control @error('responsibilities') is-invalid @enderror" 
                          id="responsibilities" name="responsibilities" rows="8">{{ old('responsibilities', $karier->responsibilities) }}</textarea>
                @error('responsibilities')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="qualifications">Qualifications:</label>
                <textarea class="form-control @error('qualifications') is-invalid @enderror" 
                          id="qualifications" name="qualifications" rows="8">{{ old('qualifications', $karier->qualifications) }}</textarea>
                @error('qualifications')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('karier.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/zxbb8ss6iclrki0fopl5gcne91neckqc4e004atop3wf0mi2/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#responsibilities, #qualifications',
            height: 300,
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
            menubar: 'file edit view insert format tools table help',
            toolbar_mode: 'sliding',
            content_style: 'body { font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    });
</script>
@endpush

@endsection
