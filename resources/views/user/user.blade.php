<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('voler/dist/assets/css/style.css') }}">
    <link href="{{ asset('voler/dist/assets/js/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('voler/dist/assets/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ asset('voler/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('voler/dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('voler/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        .navbar-custom {
        margin-bottom: 20px; /* Adjust the margin as needed */
    }
    .navbar-brand {
        margin-right: 20px; /* Adjust the margin as needed */
    }

        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav .nav-link {
            color: #333;
        }

        .header-section {
            padding: 60px 0;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('header-background.jpg') no-repeat center center;
            background-size: cover;
            color: white;
        }

        .section {
            padding: 60px 0;
        }


        .card-custom {
            transition: transform 0.3s;
        }

        .card-custom:hover {
            transform: scale(1.05);
        }

        .logo {
            width: 50px;
            /* Sesuaikan dengan lebar yang diinginkan */
            height: auto;
            /* Tinggi disesuaikan secara otomatis sesuai aspek ratio */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #291053;
            color: #fff;
            /* Ganti dengan warna latar belakang yang Anda inginkan */
            
            padding: 10px 0;
            /* Sesuaikan dengan padding yang Anda inginkan */
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="logo" src="{{ asset('logo.png') }}" alt="Semar Futsal Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/jadwal') }}">Jadwal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/bookinguser') }}">Booking</a>
                            </li>
                            
                                    <li class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown"
                                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                            <div class="d-none d-md-block d-lg-inline-block">Hi, {{ Auth::user()->name }} <i data-feather="chevron-down"></i></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ url('profile') }}"><i data-feather="user" ></i> Account</a>
                                            <div class="dropdown-divider" ></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                            
                                                <a class="dropdown-item"
                                                href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                            this.closest('form').submit();"><i data-feather="log-out"></i>{{ __('Logout') }}</a>
                                            </form>
                                        </div>
                                    </li>
                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    @yield('content')
    @include('sweetalert::alert')

    <!-- Footer -->
    <footer class="footer text-center shadow">
        <p>&copy; 2023 Semar Futsal. All Rights Reserved.</p>
    </footer>

    @include('layouts.script')
</body>

</html>
