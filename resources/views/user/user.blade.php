<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://kit.fontawesome.com/0da30534c0.js" crossorigin="anonymous"></script>
    <title>Semar Futsal - @yield('title')</title>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <style>
        .navbar-brand img {
            height: 30px;
            width: auto;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        .footer {
            background-color: #f8f9fa;
            padding-top: 20px;
            text-align: center;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
            /* You can adjust the animation duration and timing function here */
        }

        .navbar-nav .nav-item.active .nav-link {
            position: relative;
            padding-bottom: 5px;
        }

        .navbar-nav .nav-item.active .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: rgb(92, 92, 92);
        }
    </style>

</head>

<body class="fade-in">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #e0fccc !important;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="logo" src="{{ asset('logo.png') }}" alt="Semar Futsal Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item {{ \Route::is('welcome') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item {{ \Route::is('jadwal', 'jadwal.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/jadwal') }}">Jadwal</a>
                            </li>
                            <li class="nav-item {{ \Route::is('bookinguser.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/bookinguser') }}">Booking</a>
                            </li>

                            <li class="dropdown ms-3">
                                <a href="#" data-bs-toggle="dropdown" data-bs-target="#dropdownMenu"
                                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                    <b class="d-none d-md-block d-lg-inline-block">Hi, {{ Auth::user()->name }} <i
                                            data-feather="chevron-down"></i></b>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" id="dropdownMenu">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                            
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();"><i
                                                data-feather="log-out"></i>{{ __('Logout') }}</a>
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item {{ \Route::is('welcome') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item {{ \Route::is('jadwal', 'jadwal.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/jadwal') }}">Jadwal</a>
                            </li>
                            <li class="nav-item {{ \Route::is('login') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item {{ \Route::is('register') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Add your content here -->
    <div class="main-content">
        @yield('content')
    </div>
    @include('sweetalert::alert')
    <!-- Footer -->
    <footer class="footer text-center" style="background: #e0fccc !important;">
        <p>&copy; 2023 Semar Futsal. All Rights Reserved.</p>
    </footer>
    @include('layouts.script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    
</body>

</html>
