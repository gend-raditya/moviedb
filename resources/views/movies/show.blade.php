@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row g-5">
            <!-- Cover Image -->
            <div class="col-md-4">
                <img src="{{ asset($movie->cover_image) }}" alt="{{ $movie->title }}" class="card-img-top">
            </div>

            <!-- Movie Details -->
            <div class="col-md-8">
                <h2 class="mb-3">{{ $movie->title }} ({{ $movie->year }})</h2>

                <p class="mb-1">
                    <strong>Kategori:</strong>
                    <span class="badge bg-secondary">{{ $movie->category->category_name }}</span>
                </p>

                <!-- Synopsis / Deskripsi film -->
                @if ($movie->synopsis && trim($movie->synopsis) !== '')
                    <p>{{ $movie->synopsis }}</p>
                @else
                    <p><em>Belum ada deskripsi untuk film ini.</em></p>
                @endif

                <!-- Tombol Kembali, di blok terpisah -->
                <div class="mt-4 mb-3">
                    <a href="{{ route('movies.index') }}" class="btn btn-outline-primary">
                        ← Kembali ke Daftar Film
                    </a>
                </div>

                <!-- Tombol Edit dan Hapus berdampingan -->
                <div class="d-flex gap-2">
                    <a href="{{ route('movies.edit', $movie->slug) }}" class="btn btn-warning">
                        ✏️ Edit
                    </a>
                    @can('delete')


                    <form action="{{ route('movies.destroy', $movie->slug) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus film ini?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            🗑️ Hapus
                        </button>
                        @endcan
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
