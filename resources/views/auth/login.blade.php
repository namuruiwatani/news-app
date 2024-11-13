@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #121212;
        color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 100px auto;
    }

    .card-header {
        color: #b388ff;
        font-size: 28px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-control {
        width: 94%;
        padding: 10px;
        margin-bottom: 15px;
        border: 2px solid #b388ff;
        border-radius: 5px;
        background-color: #1a1a1a;
        color: #fff;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #7c4dff;
    }

    .btn-login {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #b388ff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 10px;
    }

    .btn-login:hover {
        background-color: #7c4dff;
    }

    .google-login-div {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 95%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #4285f4;
        text-align: center;
        margin-bottom: 15px;
        cursor: pointer;
    }

    .google-login {
        color: #fff;
        font-size: 16px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .google-login:hover {
        background-color: #357ae8;
    }

    .register-link {
        color: #b388ff;
        text-decoration: none;
        font-size: 14px;
    }

    .register-link:hover {
        text-decoration: underline;
    }

    .form-group-reg {
        text-align: center;
    }
</style>

<div class="container">
    <div class="card-header">{{ __('Login') }}</div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="google-login-div">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" style="margin-right: 5px;">
                <path fill-rule="evenodd" d="M12.037 21.998a10.313 10.313 0 0 1-7.168-3.049 9.888 9.888 0 0 1-2.868-7.118 9.947 9.947 0 0 1 3.064-6.949A10.37 10.37 0 0 1 12.212 2h.176a9.935 9.935 0 0 1 6.614 2.564L16.457 6.88a6.187 6.187 0 0 0-4.131-1.566 6.9 6.9 0 0 0-4.794 1.913 6.618 6.618 0 0 0-2.045 4.657 6.608 6.608 0 0 0 1.882 4.723 6.891 6.891 0 0 0 4.725 2.07h.143c1.41.072 2.8-.354 3.917-1.2a5.77 5.77 0 0 0 2.172-3.41l.043-.117H12.22v-3.41h9.678c.075.617.109 1.238.1 1.859-.099 5.741-4.017 9.6-9.746 9.6l-.215-.002Z" clip-rule="evenodd" />
            </svg>

            <a href="{{ url('/login/google') }}" class="google-login">Login with Google</a>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-login">
                {{ __('Login') }}
            </button>
        </div>

        <div class="form-group-reg">
            <a href="{{ route('register') }}" class="register-link">{{ __('No account? Register') }}</a>
        </div>
    </form>
</div>
@endsection