@extends('layouts.admin')

@section('namaPage', 'Edit Lowongan Karier')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 text-gray-800 font-weight-bold">Edit Lowongan</h6>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('karier.update', $karier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_kota">Nama Kota:</label>
                        <input type="text" class="form-control @error('nama_kota') is-invalid @enderror" 
                               id="nama_kota" name="nama_kota" value="{{ old('nama_kota', $karier->nama_kota) }}" required>
                        @error('nama_kota')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Penerima:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $karier->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
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
                <textarea class="form-control @error('responsibilities') is-invalid @enderror tinymce-editor" 
                          id="responsibilities" name="responsibilities" rows="8">{{ old('responsibilities', $karier->responsibilities) }}</textarea>
                @error('responsibilities')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="qualifications">Qualifications:</label>
                <textarea class="form-control @error('qualifications') is-invalid @enderror tinymce-editor" 
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
<script src="https://cdn.tiny.cloud/1/rijrac2uxn06a1q296snq7j1fi420fd29r3lc1o12yzq6fwv/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                                tinymce.init({
                    selector: '.tinymce-editor',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    content_style: 'img{max-width:100%;height:auto;}',
                    image_class_list: [
                        { title: 'Responsive', value: 'img-fluid' },
                    ],
                    setup: (editor) => {
                        const sync = () => editor.save();
                        editor.on('change input undo redo', sync);
                    },
                    images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                        const xhr = new XMLHttpRequest();
                    
                        xhr.open('POST', '{{ route('tinymce.upload') }}');
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.withCredentials = true;
                    
                        xhr.upload.onprogress = (e) => {
                            progress(e.loaded / e.total * 100);
                        };
                    
                        xhr.onload = () => {
                            if (xhr.status !== 200) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }
                    
                            let json;
                            try {
                                json = JSON.parse(xhr.responseText);
                            } catch (e) {
                                reject('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                    
                            if (!json || typeof json.location !== 'string') {
                                reject('Invalid response: ' + xhr.responseText);
                                return;
                            }
                    
                            resolve(json.location);
                        };
                    
                        xhr.onerror = () => {
                            reject('Image upload failed due to a network error.');
                        };
                    
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        xhr.send(formData);
                    }),
                });
            });
        </script>
@endpush

@endsection
