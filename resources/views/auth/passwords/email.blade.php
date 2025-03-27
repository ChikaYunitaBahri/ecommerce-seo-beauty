@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-75 shadow-lg rounded overflow-hidden" style="max-width: 900px;">

        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white p-5"
            style="background: linear-gradient(135deg, #007bff, #00aaff);">
            <h1 class="fw-bold">Seo Beauty</h1>
            <p class="text-center small">Reset your password and continue enjoying our premium services.</p>
        </div>


        <div class="col-md-6 bg-white p-5">
            <h2 class="text-center mb-4">{{ __('Reset Password') }}</h2>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn w-100"
                        style="background: linear-gradient(135deg, #007bff, #00aaff); border: none; color: #fff;">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Back to Login') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection