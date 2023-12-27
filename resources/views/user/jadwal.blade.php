@extends('user.user')
@section('title', 'Jadwal')
@section('content')
<style>
    .card-img-container {
            position: relative;
            overflow: hidden;
            height: 0;
            padding-top: 75%;
            /* 4:3 aspect ratio */
        }

        .square-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }
        .embed-responsive {
    position: relative;
    display: block;
    width: 100%;
    padding: 0;
    overflow: hidden;
}

.embed-responsive::before {
    content: "";
    display: block;
    padding-top: 56.25%; /* Untuk aspek rasio 16:9 */
}

.embed-responsive-item {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
.card-img-containerp, iframe {
    transition: transform 0.3s ease;
}

.card-img-containerp:hover, iframe:hover {
    transform: scale(1.05);
}
</style>
    <div class="container">
        <div class="main-content container-fluid">
            <div class="page-title mt-5 ">
                <h3>Jadwal</h3>
            </div>
            <section class="section my-5">
                <div class="card">
                    <div class="card-body">
                        <section class="section">
                            <div class="container">
                                <div class="row">
                                    @forelse ($lapangans as $lapangan)
                                        <div class="col-md-6">
                                            <div class="card card-img-containerp mb-4 rounded-4 shadow-lg">
                                                <div class="card-img-container m-2 rounded-4">
                                                    @if ($lapangan->image == null)
                                                        <div class="square-image"
                                                            style="background-image: url('{{ asset('pngwing.com.png') }}')"></div>
                                                    @else
                                                        <a href="{{ asset('storage/lapangan/' . $lapangan->image) }}" target="_blank">
                                                            <div class="square-image"
                                                                style="background-image: url('{{ asset('storage/lapangan/' . $lapangan->image) }}')">
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center mb-5">Lapangan {{ $lapangan->no }}</h5>
                                                    <a class="btn btn-outline-success mx-auto d-block mt-4" href="{{ route('jadwal.show', $lapangan) }}">Lihat Jadwal</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-6">
                                            <div class="card mb-4">
                                                <div class="square-image" style="background-image: url('{{ asset('pngwing.com.png') }}')"></div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Lapangan tidak tersedia</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection