@extends('user.user')
@section('title', 'Login')
@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div class="card col-xl-6">
        <div class="card-header">
            {{ __('Login') }}
        </div>
        <div class="card-body">
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-success">{{ __('Log in') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection