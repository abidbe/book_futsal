@extends('user.user')
@section('content')
    <header class="header-section text-center">
        <h1>Welcome to Our Futsal Booking Service</h1>
        <p>Discover and book the best futsal fields in town!</p>
    </header>

    <!-- About Section -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center">About Us</h2>
            <p class="text-center">Providing top-notch futsal fields with a seamless booking experience.</p>
            <!-- Additional content -->
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section">
        <div class="container">
            <h2 class="text-center">Our Fields</h2>
            <div class="row d-flex justify-content-center">
                <!-- Gallery items -->
                <!-- Example of a gallery card -->
                @forelse ($lapangans as $lapangan)
                    <div class="col-md-4 mb-3">
                        <div class="card card-custom">

                            @if ($lapangan->image == null)
                                <img src="{{ asset('pngwing.com.png') }}" class="card-img-top" alt="Field">
                            @else
                                <a href="{{ asset('storage/lapangan/' . $lapangan->image) }}" target="_blank">

                                    <img src="{{ asset('storage/lapangan/' . $lapangan->image) }}" class="card-img-top"
                                        alt="Field">
                                </a>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">Lapangan {{ $lapangan->no }}</h5>
                                <a href="{{ route('login') }}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4 mb-3">
                        <div class="card card-custom">
                            <img src="{{ asset('pngwing.com.png') }}" class="card-img-top" alt="Field">
                            <div class="card-body">
                                <h5 class="card-title">Lapangan tidak tersedia</h5>
                            </div>
                        </div>
                    </div>
                @endforelse

                <!-- Repeat for other fields -->
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center">Testimonials</h2>
            <!-- Testimonials content -->
        </div>
    </section>
@endsection
