@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
            <h4 class="mb-0">Tambah Film Baru</h4>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('movies.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">Judul Film</label>
                    <input
                        type="text"
                        class="form-control rounded-3 shadow-sm @error('title') is-invalid @enderror"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category_id" class="form-label fw-semibold">Genre</label>
                    <select
                        class="form-select rounded-3 shadow-sm @error('category_id') is-invalid @enderror"
                        id="category_id"
                        name="category_id"
                        required>
                        <option value="">-- Pilih Genre --</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
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
                    <input
                        type="number"
                        class="form-control rounded-3 shadow-sm @error('year') is-invalid @enderror"
                        id="year"
                        name="year"
                        value="{{ old('year') }}"
                        required>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cover_image" class="form-label fw-semibold">Link Poster</label>
                    <input
                        type="url"
                        class="form-control rounded-3 shadow-sm @error('cover_image') is-invalid @enderror"
                        id="cover_image"
                        name="cover_image"
                        value="{{ old('cover_image') }}"
                        required>
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="synopsis" class="form-label fw-semibold">Deskripsi</label>
                    <textarea
                        class="form-control rounded-3 shadow-sm @error('synopsis') is-invalid @enderror"
                        id="synopsis"
                        name="synopsis"
                        rows="4"
                        required>{{ old('synopsis') }}</textarea>
                    @error('synopsis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-pill">Simpan</button>
                    <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
