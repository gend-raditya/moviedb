@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow rounded-4 border-0">
            <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
                <h4 class="mb-0">Tambah Film Baru</h4>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Judul Film</label>
                        <input type="text" class="form-control rounded-3 shadow-sm @error('title') is-invalid @enderror"
                            id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="form-label fw-semibold">Genre</label>
                        <select class="form-select rounded-3 shadow-sm @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id" required>
                            <option value="">-- Pilih Genre --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="year" class="form-label fw-semibold">Tahun Rilis</label>
                        <input type="number" class="form-control rounded-3 shadow-sm @error('year') is-invalid @enderror"
                            id="year" name="year" value="{{ old('year') }}" required>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Pilih Jenis Gambar</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="image_option" id="option_link"
                                value="link" {{ old('image_option', 'link') === 'link' ? 'checked' : '' }}>
                            <label class="form-check-label" for="option_link">Gunakan Link</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="image_option" id="option_upload"
                                value="upload" {{ old('image_option') === 'upload' ? 'checked' : '' }}>
                            <label class="form-check-label" for="option_upload">Upload Gambar</label>
                        </div>
                    </div>

                    <div class="mb-4" id="link_input"
                        style="{{ old('image_option', 'link') === 'link' ? '' : 'display:none;' }}">
                        <label for="cover_image" class="form-label fw-semibold">Link Poster</label>
                        <input type="url"
                            class="form-control rounded-3 shadow-sm @error('cover_image') is-invalid @enderror"
                            id="cover_image" name="cover_image" value="{{ old('cover_image') }}">
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4" id="upload_input"
                        style="{{ old('image_option') === 'upload' ? '' : 'display:none;' }}">
                        <label for="cover_upload" class="form-label fw-semibold">Upload Gambar</label>
                        <input type="file"
                            class="form-control rounded-3 shadow-sm @error('cover_upload') is-invalid @enderror"
                            id="cover_upload" name="cover_upload" accept="image/*">
                        @error('cover_upload')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                   <div class="mb-4">
                        <label for="synopsis" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control rounded-3 shadow-sm @error('synopsis') is-invalid @enderror" id="synopsis"
                            name="synopsis" rows="4" required>{{ old('synopsis') }}</textarea>
                        @error('synopsis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success px-4 py-2 rounded-pill">Simpan</button>
                        <a href="{{ route('movies.index') }}"
                            class="btn btn-outline-secondary px-4 py-2 rounded-pill">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const linkOption = document.getElementById('option_link');
            const uploadOption = document.getElementById('option_upload');
            const linkInput = document.getElementById('link_input');
            const uploadInput = document.getElementById('upload_input');

            function toggleInputs() {
                if (linkOption.checked) {
                    linkInput.style.display = '';
                    uploadInput.style.display = 'none';
                } else {
                    linkInput.style.display = 'none';
                    uploadInput.style.display = '';
                }
            }

            linkOption.addEventListener('change', toggleInputs);
            uploadOption.addEventListener('change', toggleInputs);
            toggleInputs(); // Panggil pertama kali saat load
        });
    </script>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const linkOption = document.getElementById('linkOption');
            const uploadOption = document.getElementById('uploadOption');
            const linkInput = document.getElementById('linkInput');
            const uploadInput = document.getElementById('uploadInput');

            function toggleInputs() {
                if (linkOption.checked) {
                    linkInput.style.display = '';
                    uploadInput.style.display = 'none';
                } else {
                    linkInput.style.display = 'none';
                    uploadInput.style.display = '';
                }
            }

            linkOption.addEventListener('change', toggleInputs);
            uploadOption.addEventListener('change', toggleInputs);

            toggleInputs(); // Initial state
        });
    </script>
@endpush
