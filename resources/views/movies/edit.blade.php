@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">✏️ Edit Film: {{ $movie->title }}</h2>

        <form action="{{ route('movies.update', $movie->slug) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $movie->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $movie->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Tahun</label>
                <input type="number" name="year" id="year" class="form-control"
                    value="{{ old('year', $movie->year) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Pilih Jenis Gambar</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="image_option" id="option_link" value="link"
                        {{ old('image_option', 'link') === 'link' || $movie->cover_image ? 'checked' : '' }}>
                    <label class="form-check-label" for="option_link">Gunakan Link</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="image_option" id="option_upload" value="upload"
                        {{ old('image_option') === 'upload' ? 'checked' : '' }}>
                    <label class="form-check-label" for="option_upload">Upload Gambar</label>
                </div>
            </div>

            <div class="mb-3" id="link_input"
                style="{{ old('image_option', 'link') === 'link' || $movie->cover_image ? '' : 'display:none;' }}">
                <label for="cover_image" class="form-label">URL Gambar Cover</label>
                <input type="url" name="cover_image" id="cover_image"
                    class="form-control @error('cover_image') is-invalid @enderror"
                    value="{{ old('cover_image', $movie->cover_image) }}">
                @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="upload_input" style="{{ old('image_option') === 'upload' ? '' : 'display:none;' }}">
                <label for="cover_upload" class="form-label">Upload Gambar Baru (Opsional)</label>
                <input type="file" name="cover_upload" id="cover_upload"
                    class="form-control @error('cover_upload') is-invalid @enderror" accept="image/*">
                @error('cover_upload')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="trailer_url" class="form-label">URL Trailer (opsional)</label>
                <input type="url" name="trailer_url" id="trailer_url" class="form-control"
                    value="{{ old('trailer_url', $movie->trailer_url ?? '') }}">
            </div>

            <div class="mb-4">
                <label for="actors" class="form-label fw-semibold">Pemeran (pisahkan dengan koma)</label>
                <input type="text" class="form-control rounded-3 shadow-sm @error('actors') is-invalid @enderror"
                    id="actors" name="actors" value="{{ old('actors', $movie->actors ?? '') }}">
                @error('actors')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="synopsis" class="form-label">Deskripsi / Sinopsis</label>
                <textarea name="synopsis" id="synopsis" rows="5" class="form-control" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">← Batal</a>
        </form>
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
            toggleInputs();
        });
    </script>
@endsection
