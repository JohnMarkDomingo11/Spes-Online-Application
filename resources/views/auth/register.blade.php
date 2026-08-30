<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PESO LAL-LO') }} - Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-wrapper">
            <div class="auth-left">
                <div class="logo-container">
                    <img src="{{ asset('images/peso_lallo.jpg') }}" alt="PESO LAL-LO Logo" class="logo" />
                </div>
                <h1>PESO <span>Lal-lo</span></h1>
                <p class="subtitle">Special Program for Employment of Students (SPES)</p>
                <p>Apply online and track your application status anytime, anywhere.</p>
                <div class="auth-features">
                    <div><i aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M9 4h6M9 2h6v4H9zM6 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1M7 12l2 2 4-4M7 17h8" /></svg></i><span>Easy<br>Application</span></div>
                    <div><i aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M4 20V10h4v10H4zm6 0V4h4v16h-4zm6 0v-7h4v7h-4z" /></svg></i><span>Track<br>Status</span></div>
                    <div><i aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M12 3 4 6v5c0 5.2 3.4 8.8 8 10 4.6-1.2 8-4.8 8-10V6l-8-3zm0 5a2 2 0 0 1 2 2v1h1v5H9v-5h1v-1a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1z" /></svg></i><span>Secure &amp;<br>Reliable</span></div>
                </div>
            </div>

            <div class="auth-right">
                <h2>Create <span>Account</span></h2>
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
