<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password - Saadani Kasa Bay Admin</title>

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
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .login-bg {
            background: linear-gradient(135deg, #065f46 0%, #059669 50%, #10b981 100%);
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
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4">
                <i class="fas fa-leaf text-golden-600 text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Saadani Kasa Bay</h1>
            <p class="text-golden-100">Reset Password</p>
        </div>

        <!-- Reset Form -->
        <div class="glass-effect rounded-2xl p-8 shadow-2xl">
            <div class="text-center mb-6">
                <i class="fas fa-key text-white text-3xl mb-3"></i>
                <h2 class="text-xl font-semibold text-white mb-2">Forgot Your Password?</h2>
                <p class="text-golden-100 text-sm">Enter your email address and we'll send you a link to reset your password.</p>
            </div>

            <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-6">
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
                           class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all duration-200"
                           placeholder="Enter your email address">
                    @error('email')
                        <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-white text-golden-600 py-3 px-4 rounded-lg font-semibold hover:bg-golden-50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-golden-600 transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Send Reset Link
                </button>

                <!-- Back to Login -->
                <div class="text-center">
                    <a href="{{ route('admin.login') }}" 
                       class="text-sm text-white hover:text-golden-200 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back to Login
                    </a>
                </div>
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
                &copy; {{ date('Y') }} Saadani Kasa Bay. All rights reserved.
            </p>
        </div>
    </div>

    <script>
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
