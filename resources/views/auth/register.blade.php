@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-75 shadow-lg rounded overflow-hidden" style="max-width: 900px;">
        <!-- Left Section: Gradient Biru -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white p-5"
            style="background: linear-gradient(135deg, #007bff, #00aaff);">
            <h1 class="fw-bold">Seo Beauty</h1>
            <p>Enhance Your Beauty with Confidence</p>
        </div>

        <!-- Right Section: Form Register -->
        <div class="col-md-6 bg-white p-5">
            <h2 class="text-center mb-4">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}"
                        required autocomplete="email">
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
                        name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password"
                        class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>

                <!-- Tombol Register dengan Gradient Biru -->
                <div class="d-grid">
                    <button type="submit" class="btn w-100"
                        style="background: linear-gradient(135deg, #007bff, #00aaff); border: none; color: #fff;">
                        Register
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <small>Already have an account? 
                    <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection