@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">🎬 Daftar Kategori Film</h2>

    <div class="mb-4 text-end">
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        ➕ Tambah Kategori
    </a>
</div>

    <div class="row">
        @forelse ($categories as $category)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <i class="bi bi-folder-fill me-2"></i>{{ $category->category_name }}
                        </h5>
                        <p class="card-text text-secondary">{{ $category->description }}</p>

                        {{-- Tombol opsional --}}
                        {{--
                        <a href="{{ route('movies.byCategory', $category->id) }}" class="btn btn-outline-primary btn-sm mt-2">
                            🎥 Lihat Film
                        </a>
                        --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada kategori yang tersedia.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- Tambahkan gaya hover --}}
@push('styles')
<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
@endsection
