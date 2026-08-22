<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PESO Lallo') }} - Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-wrapper">
            <!-- Left Section -->
            <div class="auth-left">
                <div class="logo-container">
                    <img src="{{ asset('images/peso_lallo.jpg') }}" alt="PESO Lallo Logo" / class="logo">
                </div>
                <h1>PESO Lallo</h1>
                <p class="subtitle">Special Program for Employment of Students (SPES)</p>
                <p>Apply online and track your application status anytime, anywhere.</p>
            </div>

            <!-- Right Section -->
            <div class="auth-right">
                <h2>Welcome Back</h2>
                <p class="subtitle">Please log in to your account.</p>

                <!-- Session Status -->
                @if ($errors->any())
                    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <strong>Login Failed!</strong>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="Email Address"
                            required 
                            autofocus 
                            autocomplete="email"
                        />
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            placeholder="Password"
                            required 
                            autocomplete="current-password"
                        />
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="checkbox-group">
                        <input 
                            type="checkbox" 
                            id="remember_me" 
                            name="remember"
                        />
                        <label for="remember_me">Remember me</label>
                    </div>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    @endif

                    <!-- Login Button -->
                    <button type="submit" class="btn-submit">Login</button>

                    <!-- Sign Up Link -->
                    <div class="auth-footer">
                        Don't have an account? 
                        <a href="{{ route('register') }}">Sign Up here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
