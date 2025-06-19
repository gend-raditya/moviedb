@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="container py-5">
        <div class="row g-5 align-items-start">
            <!-- Cover Image -->
            <div class="col-md-4">
                <div class="shadow rounded-4 overflow-hidden" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#trailerModal">
                    <img src="{{ $movie->cover_image }}" alt="{{ $movie->title }}" class="img-fluid w-100 object-fit-cover"
                        style="max-height: 500px;">
                </div>
            </div>

            <!-- Movie Details -->
            <div class="col-md-8">
                <h2 class="fw-bold">{{ $movie->title }} <span class="text-muted fs-5">({{ $movie->year }})</span></h2>

                <p class="mb-1"><strong>Rating:</strong>
                    <span class="badge bg-warning text-dark">{{ $movie->rating ?? 'N/A' }}/10</span>
                </p>

                <p class="mb-1"><strong>Kategori:</strong>
                    <span>{{ $movie->category->category_name }}</span>
                </p>

                @if (!empty($movie->actors))
                    <p class="mb-2"><strong>Pemeran:</strong> {{ $movie->actors }}</p>
                @endif



                <!-- Sinopsis dan Pemeran dalam satu card -->
                <div class="mb-2">
                    <h5 class="fw-semibold text-primary">Sinopsis</h5>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            {{-- Sinopsis --}}
                            @if ($movie->synopsis && trim($movie->synopsis) !== '')
                                <p class="text-secondary mb-3">{{ $movie->synopsis }}</p>
                            @else
                                <p class="text-muted mb-3"><em>Belum ada deskripsi untuk film ini.</em></p>
                            @endif

                        </div>
                    </div>
                </div>


                <!-- Tombol Trailer -->
                @if (!empty($movie->trailer_url))
                    <a href="#" class="btn btn-danger rounded-pill px-4 mb-3" data-bs-toggle="modal"
                        data-bs-target="#trailerModal">
                        ▶️ Tonton Trailer
                    </a>
                @endif

                <!-- Tombol Aksi -->
                <div class="mt-2">
                    <a href="{{ route('movies.index') }}" class="btn btn-outline-primary rounded-pill px-4 mb-3">
                        ← Kembali ke Daftar Film
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('movies.edit', $movie->slug) }}" class="btn btn-warning rounded-pill px-3">✏️
                            Edit</a>
                        @can('delete')
                            <form action="{{ route('movies.destroy', $movie->slug) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus film ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-3">🗑️ Hapus</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Trailer -->
    @if (!empty($movie->trailer_url))
        @php
            $url = $movie->trailer_url;
            if (Str::contains($url, 'watch?v=')) {
                $embedUrl = str_replace('watch?v=', 'embed/', $url);
                $embedUrl = strtok($embedUrl, '&'); // hapus parameter tambahan
            } elseif (Str::contains($url, 'youtu.be')) {
                $videoId = explode('?', substr(parse_url($url, PHP_URL_PATH), 1))[0];
                $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
            } else {
                $embedUrl = $url;
            }
        @endphp

        <div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 overflow-hidden">
                    <div class="modal-header">
                        <h5 class="modal-title" id="trailerModalLabel">🎞️ Trailer: {{ $movie->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe id="trailerFrame" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trailerModal = document.getElementById('trailerModal');
            const trailerFrame = document.getElementById('trailerFrame');
            const originalSrc = trailerFrame.getAttribute('src');

            trailerModal.addEventListener('show.bs.modal', function() {
                trailerFrame.setAttribute('src', originalSrc + '?autoplay=1');
            });

            trailerModal.addEventListener('hidden.bs.modal', function() {
                trailerFrame.setAttribute('src', originalSrc);
            });
        });
    </script>
@endpush
