<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PESO Lallo') }} - Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-wrapper">
            <!-- Left Section -->
            <div class="auth-left">
                <div class="logo-container">
                    <img src="{{ asset('images/peso_lallo.jpg') }}" alt="PESO Lallo Logo" class="logo" />
                </div>
                <h1>PESO Lallo</h1>
                <p class="subtitle">Special Program for Employment of Students (SPES)</p>
                <p>Apply online and track your application status anytime, anywhere.</p>
            </div>

            <!-- Right Section -->
            <div class="auth-right">
                <h2>Create Account</h2>
                <p class="subtitle">Join us and start your employment journey</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            required 
                            autofocus 
                        />
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input 
                            id="username" 
                            type="text" 
                            name="username" 
                            value="{{ old('username') }}"
                            placeholder="Choose a unique username"
                            required 
                        />
                        @error('username')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            required 
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
                            placeholder="Create a password"
                            required 
                            autocomplete="new-password"
                        />
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            placeholder="Confirm your password"
                            required 
                            autocomplete="new-password"
                        />
                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="checkbox-group">
                        <input 
                            type="checkbox" 
                            id="agree" 
                            name="agree" 
                            required
                        />
                        <label for="agree">
                            I agree to the 
                            <a href="#" style="color: #003d82; text-decoration: none; font-weight: 500;">terms and conditions</a>
                        </label>
                        @error('agree')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn-submit">Sign Up</button>

                    <!-- Login Link -->
                    <div class="auth-footer">
                        Already have an account? 
                        <a href="{{ route('login') }}">Log In here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
