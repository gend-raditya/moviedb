@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">✏️ Edit Film: {{ $movie->title }}</h2>

    <form action="{{ route('movies.update', $movie->slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
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
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $movie->year) }}" required>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">URL Gambar Cover</label>
            <input type="url" name="cover_image" id="cover_image" class="form-control" value="{{ old('cover_image', $movie->cover_image) }}" required>
        </div>

        <div class="mb-3">
            <label for="synopsis" class="form-label">Deskripsi / Sinopsis</label>
            <textarea name="synopsis" id="synopsis" rows="5" class="form-control" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">← Batal</a>
    </form>
</div>
@endsection
