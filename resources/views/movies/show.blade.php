@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row g-5 align-items-start">
            <!-- Cover Image -->
            <div class="col-md-4">
                <div class="shadow rounded-4 overflow-hidden">
                    <img src="{{ asset($movie->cover_image) }}" alt="{{ $movie->title }}"
                        class="img-fluid w-100 object-fit-cover" style="max-height: 500px;">
                </div>
            </div>

            <!-- Movie Details -->
            <div class="col-md-8">
                <h2 class="fw-bold">{{ $movie->title }} <span class="text-muted fs-5">({{ $movie->year }})</span></h2>

                <!-- Rating -->
                <p class="mb-2">
                    <strong>⭐ Rating:</strong>
                    <span class="badge bg-warning text-dark">{{ $movie->rating ?? 'N/A' }}/10</span>
                </p>

                <!-- Genre -->
                <p class="mb-3">
                    <strong>Kategori:</strong>
                    <span class="badge bg-dark-subtle text-dark fs-6">
                        <i class="bi bi-folder-fill me-1"></i>{{ $movie->category->category_name }}
                    </span>
                </p>

                <!-- Sinopsis dalam Card -->
                <div class="mb-4">
                    <h5 class="fw-semibold text-primary">Sinopsis</h5>
                    <div class="card shadow-sm rounded-3 border-0">
                        <div class="card-body">
                            @if ($movie->synopsis && trim($movie->synopsis) !== '')
                                <p class="text-secondary mb-0">{{ $movie->synopsis }}</p>
                            @else
                                <p class="text-muted mb-0"><em>Belum ada deskripsi untuk film ini.</em></p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Trailer -->
                @if (!empty($movie->trailer_url))
                    <div class="mb-4">
                        <h5 class="fw-semibold text-primary">🎞️ Trailer</h5>
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm">
                            <iframe src="{{ $movie->trailer_url }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                <!-- Cast -->
                @if (!empty($movie->cast))
                    <div class="mb-4">
                        <h5 class="fw-semibold text-primary">🎭 Pemeran</h5>
                        <ul class="list-group list-group-flush">
                            @foreach (explode(',', $movie->cast) as $actor)
                                <li class="list-group-item ps-0">{{ trim($actor) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="mt-4">
                    <a href="{{ route('movies.index') }}" class="btn btn-outline-primary rounded-pill px-4 mb-3">
                        ← Kembali ke Daftar Film
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('movies.edit', $movie->slug) }}" class="btn btn-warning rounded-pill px-3">
                            ✏️ Edit
                        </a>
                        @can('delete')
                            <form action="{{ route('movies.destroy', $movie->slug) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus film ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-3">
                                    🗑️ Hapus
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
