<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login - {{ \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        golden: {
                            50: '#fefbf3',
                            100: '#fdf4e1',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#B78B3E',
                            700: '#9A7235',
                            800: '#7D5F2C',
                            900: '#6B5426'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .login-bg {
            background: linear-gradient(135deg, #6B5426 0%, #7D5F2C 25%, #9A7235 50%, #B78B3E 75%, #f59e0b 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Brand -->
        <div class="text-center mb-8">
            @php
                $siteName = \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay');
                $siteLogo = \App\Models\WebsiteSetting::get('site_logo');
            @endphp

            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4">
                @if($siteLogo)
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="w-12 h-12 object-contain">
                @else
                    <i class="fas fa-leaf text-golden-600 text-2xl"></i>
                @endif
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">{{ $siteName }}</h1>
            <p class="text-golden-100">Admin Panel</p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-2xl p-8 shadow-2xl">
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required 
                           autofocus
                           class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-golden-400 focus:border-golden-400 transition-all duration-200"
                           placeholder="Enter your email">
                    @error('email')
                        <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-golden-400 focus:border-golden-400 transition-all duration-200"
                               placeholder="Enter your password">
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors duration-200">
                            <i id="password-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               class="w-4 h-4 text-golden-600 bg-white/20 border-white/30 rounded focus:ring-golden-400 focus:ring-2">
                        <span class="ml-2 text-sm text-white">Remember me</span>
                    </label>
                    
                    <a href="{{ route('admin.password.request') }}"
                       class="text-sm text-golden-100 hover:text-golden-200 transition-colors duration-200">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-white text-golden-600 py-3 px-4 rounded-lg font-semibold hover:bg-golden-50 focus:outline-none focus:ring-2 focus:ring-golden-500 focus:ring-offset-2 focus:ring-offset-golden-600 transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign In
                </button>
            </form>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mt-6 bg-green-500/20 border border-green-400/30 text-green-100 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mt-6 bg-red-500/20 border border-red-400/30 text-red-100 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-golden-100 text-sm">
                &copy; {{ date('Y') }} {{ \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay') }}. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Auto-hide messages after 5 seconds
        setTimeout(() => {
            const messages = document.querySelectorAll('.bg-green-500\\/20, .bg-red-500\\/20');
            messages.forEach(message => {
                message.style.transition = 'opacity 0.3s ease-out';
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>
