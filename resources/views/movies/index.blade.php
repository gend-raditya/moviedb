@extends('layouts.app')

<style>
    .card-img-top {
        height: 270px;
        width: 200px;
        object-fit: cover;
    }

     .card-text.mb-2 {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>


    @section('content')
    <div class="container py-5" style="background-color: #a4c0ea;">
        <h1 class="mb-4 text-center">🎬 Daftar Film Terbaru</h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($movies as $movie)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $movie->cover_image }}" class="card-img-top" alt="{{ $movie->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $movie->title }} ({{ $movie->year }})</h5>

                            <p class="card-text mb-2" style="flex-grow: 0;">
       @if(trim($movie->synopsis) !== '')
        {{ $movie->synopsis }}
    @else
            <em>Belum ada deskripsi.</em>
        @endif
    </p>

                            <p class="card-text mb-2">
                                <span class="badge bg-secondary">{{ $movie->category->category_name }}</span>
                            </p>
                            <a href="{{ route('movies.show', $movie->slug) }}" class="btn btn-primary mt-auto">
                                🎟️ Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-warning text-center w-100">
                        Belum ada film yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
