@extends('Staff.layouts.staff')

@section('title', 'Dashboard')

@section('content')
<div class="login-container">
    <h2 class="text-center mb-4">Login</h2>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>

        <div class="mt-3 text-center">
            <p class="mb-0 footer-text">Don't have an account?
                <a href="{{ route('showRegisterForm') }}" class="btn btn-link">Register here</a>
            </p>
            <p class="footer-text">
                <a href="#" class="btn btn-link" style="color: #007bff;">Forgot Password?</a>
            </p>
        </div>

    </form>
</div>
@endsection