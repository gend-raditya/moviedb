@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">➕ Tambah Kategori Film</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="category_name" class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="category_name" id="category_name"
                        class="form-control @error('category_name') is-invalid @enderror"
                        value="{{ old('category_name') }}" required>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
