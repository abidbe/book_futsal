@extends('user.user')
<title>Semar Futsal</title>
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
.card, iframe {
    transition: transform 0.3s ease;
}

.card:hover, iframe:hover {
    transform: scale(1.05);
}
    </style>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-6 order-md-last">
                <img src="{{ asset('football.png') }}" alt="Ilustrasi orang main bola" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h2>Solusi booking futsal lebih cepat</h2>
                    <p>Nikmati pengalaman booking futsal yang praktis, efisien, dan terpercaya dengan Semar Futsal.</p>
                    <a class="btn btn-outline-success" >Booking Sekarang!</a>
                </div>
            </div>
        </div>
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250">
        <path fill="#e0fccc" fill-opacity="1"
            d="M0,192L30,202.7C60,213,120,235,180,240C240,245,300,235,360,208C420,181,480,139,540,138.7C600,139,660,181,720,197.3C780,213,840,203,900,165.3C960,128,1020,64,1080,74.7C1140,85,1200,171,1260,197.3C1320,224,1380,192,1410,176L1440,160L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
        </path>
    </svg>
    <section style="background: #e0fccc;">
        <div class="container py-3">
            <h2 class="text-center mb-5">Lapangan</h2>
            <div class="row">
                @forelse ($lapangans as $lapangan)
                    <div class="col-md-6">
                        <div class="card mb-4 rounded-4 shadow-lg">
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
                            <div class="card-body ">
                                <h5 class="card-title text-center mb-5">Lapangan {{ $lapangan->no }}</h5>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-outline-success mt-4" href="{{ route('jadwal.show', $lapangan) }}">Lihat Jadwal</a>
                                </div>
                                
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250">
        <path fill="#e0fccc" fill-opacity="1"
            d="M0,64L26.7,58.7C53.3,53,107,43,160,58.7C213.3,75,267,117,320,149.3C373.3,181,427,203,480,192C533.3,181,587,139,640,144C693.3,149,747,203,800,197.3C853.3,192,907,128,960,112C1013.3,96,1067,128,1120,144C1173.3,160,1227,160,1280,149.3C1333.3,139,1387,117,1413,106.7L1440,96L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z">
        </path>
    </svg>
    <section class="container pb-5 mb-5">
        <h2 class="text-center mb-5">Alamat</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.7455536462485!2d110.34058407575056!3d-7.816735677623779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a571fe01da83b%3A0xbc7eed5d8126b3a1!2sSemar%20Futsal!5e0!3m2!1sid!2sid!4v1703330963884!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center mt-4">
                <div>
                    <div class="d-flex align-items-center mb-2 gap-3">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <p class="m-0">Tegal Kenanga, Tirtonirmolo, Kec. Kasihan,
                            Kabupaten Bantul, Daerah Istimewa Yogyakarta 55184</p>
                    </div>
                    <div class="d-flex align-items-center mb-2 gap-3">
                        <i class="fab fa-instagram mr-2"></i><a class="pb-1"
                            href="https://www.instagram.com/semarfutsal/">@semarfutsal</a></div>
                    <div class="d-flex align-items-center mb-2 gap-3">
                        <i class="fas fa-phone mr-2"></i>123-456-7890</div>
                </div>
            </div>
        </div>
    </section>
@endsection
