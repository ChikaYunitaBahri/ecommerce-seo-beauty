@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-75 shadow-lg rounded overflow-hidden" style="max-width: 900px;">
        <
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white p-5"
            style="background: linear-gradient(135deg, #007bff, #00aaff);">
            <h1 class="fw-bold">Seo Beauty</h1>
            <p>Enhance Your Beauty with Confidence</p>
    </div>


    <div class="col-md-6 bg-white p-5">
        <h2 class="text-center mb-4">Welcome Back</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember"
                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>


            <button type="submit" class="btn w-100"
                style="background: linear-gradient(135deg, #007bff, #00aaff); border: none; color: #fff;">
                Login
            </button>

            <div class="text-center mt-3">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                @endif
            </div>

            <div class="text-center mt-3">
                <span>Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection