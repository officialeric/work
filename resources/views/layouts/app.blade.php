<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay');
        $siteTagline = \App\Models\WebsiteSetting::get('site_tagline', 'Luxury Eco-Lodge Tanzania');
        $siteDescription = \App\Models\WebsiteSetting::get('site_description', 'Discover Saadani Kasa Bay, a luxury eco-lodge facing the Indian Ocean in Tanzania. Experience pristine beaches, wildlife safaris, and sustainable tourism.');
        $siteFavicon = \App\Models\WebsiteSetting::get('site_favicon');
    @endphp

    <title>@yield('title', $siteName . ' - ' . $siteTagline)</title>
    <meta name="description" content="@yield('description', $siteDescription)">

    <!-- Favicon -->
    @if($siteFavicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteFavicon) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . $siteFavicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
                        'display': ['Playfair Display', 'ui-serif', 'Georgia']
                    },
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46'
                        },
                        amber: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        .font-display { font-family: 'Playfair Display', ui-serif, Georgia, serif; }
        .text-shadow-lg { text-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        html { scroll-behavior: smooth; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
        .animate-fade-in-left { animation: fadeInLeft 0.6s ease-out; }
        .animate-fade-in-right { animation: fadeInRight 0.6s ease-out; }

        .animate-delay-100 { animation-delay: 0.1s; }
        .animate-delay-200 { animation-delay: 0.2s; }
        .animate-delay-300 { animation-delay: 0.3s; }
        .animate-delay-400 { animation-delay: 0.4s; }

        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            transition: transform 0.3s ease;
        }
        .gallery-item:hover { transform: scale(1.05); }
        .gallery-item img { transition: transform 0.3s ease; }
        .gallery-item:hover img { transform: scale(1.1); }

        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        /* Enhanced Hero Section Styles */
        #hero-video {
            filter: brightness(0.8) contrast(1.1);
        }

        .hero-title-glow {
            text-shadow:
                0 0 10px rgba(16, 185, 129, 0.3),
                0 0 20px rgba(16, 185, 129, 0.2),
                0 0 30px rgba(16, 185, 129, 0.1),
                0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-stats {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Pulse animation for video play button */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            100% {
                transform: scale(2.4);
                opacity: 0;
            }
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }

        /* Enhanced text shadows */
        .text-shadow-hero {
            text-shadow:
                0 2px 4px rgba(0, 0, 0, 0.5),
                0 4px 8px rgba(0, 0, 0, 0.3),
                0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Gradient text effect */
        .gradient-text {
            background: linear-gradient(135deg, #10b981, #34d399, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced backdrop blur */
        .backdrop-blur-strong {
            backdrop-filter: blur(20px) saturate(180%);
        }

        /* Loading Spinner Animations */
        @keyframes spin-emerald {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse-emerald {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes bounce-emerald {
            0%, 100% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
            50% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        .spinner-emerald {
            animation: spin-emerald 1s linear infinite;
        }

        .pulse-emerald {
            animation: pulse-emerald 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .bounce-emerald {
            animation: bounce-emerald 1s infinite;
        }

        /* Loading overlay */
        .loading-overlay {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
        }

        /* Progress bar animation */
        @keyframes progress-indeterminate {
            0% {
                left: -35%;
                right: 100%;
            }
            60% {
                left: 100%;
                right: -90%;
            }
            100% {
                left: 100%;
                right: -90%;
            }
        }

        .progress-indeterminate {
            animation: progress-indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900 overflow-x-hidden">
    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 bg-white z-[9999] flex items-center justify-center transition-opacity duration-500">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-amber-200 border-t-amber-300 rounded-full spinner-emerald mx-auto mb-6"></div>
            <div class="space-y-2">
                <h3 class="text-xl font-semibold text-gray-800">{{ $siteName }}</h3>
                <p class="text-amber-300 font-medium">Loading your dream escape...</p>
                <div class="flex justify-center space-x-1 mt-4">
                    <div class="w-2 h-2 bg-amber-300 rounded-full bounce-emerald" style="animation-delay: 0ms;"></div>
                    <div class="w-2 h-2 bg-amber-300 rounded-full bounce-emerald" style="animation-delay: 150ms;"></div>
                    <div class="w-2 h-2 bg-amber-300 rounded-full bounce-emerald" style="animation-delay: 300ms;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-[100] bg-white/90 backdrop-blur-xl border-b border-white/20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#hero" class="block">
                        @php
                            $siteLogo = \App\Models\WebsiteSetting::get('site_logo');
                            $siteName = \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay');
                        @endphp

                        @if($siteLogo)
                            <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="h-12 w-auto">
                        @else
                            <!-- Custom Default Logo -->
                            <svg width="180" height="50" viewBox="0 0 180 50" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-lg">
                            <!-- Background Circle -->
                            <circle cx="25" cy="25" r="22" fill="url(#navLogoGradient)" stroke="rgba(5, 150, 105, 0.3)" stroke-width="1"/>

                            <!-- Palm Tree -->
                            <g transform="translate(17, 12)">
                                <!-- Trunk -->
                                <path d="M8 22 Q8.5 17 7.5 12 Q8 8 8.5 3" stroke="#8B4513" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                                <!-- Palm Fronds -->
                                <path d="M8.5 4 Q5 1 2.5 2.5 Q4.5 5 8.5 4" fill="#10B981" opacity="0.9"/>
                                <path d="M8.5 4 Q12 1 14.5 2.5 Q12.5 5 8.5 4" fill="#059669" opacity="0.9"/>
                                <path d="M8.5 4 Q6.5 0 4.5 -1 Q7.5 2 8.5 4" fill="#10B981" opacity="0.8"/>
                                <path d="M8.5 4 Q10.5 0 12.5 -1 Q9.5 2 8.5 4" fill="#059669" opacity="0.8"/>
                            </g>

                            <!-- Ocean Waves -->
                            <path d="M3 32 Q8 30 13 32 Q18 34 23 32 Q28 30 33 32 Q38 34 43 32 Q48 30 53 32"
                                  stroke="rgba(16, 185, 129, 0.6)" stroke-width="1" fill="none"/>
                            <path d="M3 35 Q8 33 13 35 Q18 37 23 35 Q28 33 33 35 Q38 37 43 35 Q48 33 53 35"
                                  stroke="rgba(16, 185, 129, 0.4)" stroke-width="1" fill="none"/>

                            <!-- Sun -->
                            <circle cx="37" cy="13" r="4" fill="#FCD34D" opacity="0.9"/>
                            <g transform="translate(37, 13)">
                                <path d="M0 -7 L0 -6" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                                <path d="M5 -5 L4 -4" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                                <path d="M7 0 L6 0" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                                <path d="M5 5 L4 4" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                                <path d="M0 7 L0 6" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                                <path d="M-5 5 L-4 4" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                                <path d="M-7 0 L-6 0" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                                <path d="M-5 -5 L-4 -4" stroke="#FCD34D" stroke-width="0.8" opacity="0.7"/>
                            </g>

                            <!-- Text -->
                            <text x="55" y="20" font-family="serif" font-size="14" font-weight="bold" fill="#065f46">
                                {{ Str::limit($siteName, 12) }}
                            </text>
                            <text x="55" y="32" font-family="serif" font-size="10" font-weight="300" fill="#059669">
                                {{ \App\Models\WebsiteSetting::get('site_tagline', 'Eco Lodge') }}
                            </text>
                            <text x="55" y="42" font-family="sans-serif" font-size="6" font-weight="400" fill="#10B981" letter-spacing="1px">
                                ECO LUXURY LODGE
                            </text>

                            <!-- Gradient Definitions -->
                            <defs>
                                <linearGradient id="navLogoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:rgba(16, 185, 129, 0.2);stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:rgba(5, 150, 105, 0.3);stop-opacity:1" />
                                </linearGradient>
                            </defs>
                        </svg>
                        @endif
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#hero" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Home</a>
                        <a href="#location" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Location</a>
                        <a href="#hosting" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Hosting</a>
                        <a href="#facilities" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Facilities</a>
                        <a href="#commitments" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Commitments</a>
                        <a href="#gallery" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Gallery</a>
                        <a href="#contact" class="bg-amber-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-amber-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">Contact</a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#hero" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Home</a>
                <a href="#location" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Location</a>
                <a href="#hosting" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Hosting</a>
                <a href="#facilities" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Facilities</a>
                <a href="#commitments" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Commitments</a>
                <a href="#gallery" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Gallery</a>
                <a href="#contact" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-amber-600 hover:bg-amber-50 transition-all duration-200">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Logo and Description -->
                <div class="space-y-6">
                    <!-- Footer Logo -->
                    <div class="flex items-center">
                        @php
                            $siteLogo = \App\Models\WebsiteSetting::get('site_logo');
                            $siteName = \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay');
                            $siteTagline = \App\Models\WebsiteSetting::get('site_tagline', 'Luxury Eco-Lodge Tanzania');
                        @endphp

                        @if($siteLogo)
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="h-16 w-auto drop-shadow-2xl">
                            </div>
                        @else
                            <!-- Custom Default Logo -->
                            <svg width="200" height="60" viewBox="0 0 200 60" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-lg">
                                <!-- Background Circle -->
                                <circle cx="30" cy="30" r="26" fill="url(#footerLogoGradient)" stroke="rgba(255,255,255,0.2)" stroke-width="1"/>

                                <!-- Palm Tree -->
                                <g transform="translate(20, 15)">
                                    <!-- Trunk -->
                                    <path d="M10 26 Q10.5 20 9.5 14 Q10 9 10.5 4" stroke="#8B4513" stroke-width="2" fill="none" stroke-linecap="round"/>
                                    <!-- Palm Fronds -->
                                    <path d="M10.5 5 Q6 2 3 3.5 Q5.5 6.5 10.5 5" fill="#10B981" opacity="0.9"/>
                                    <path d="M10.5 5 Q15 2 18 3.5 Q15.5 6.5 10.5 5" fill="#059669" opacity="0.9"/>
                                    <path d="M10.5 5 Q8 0 5.5 -1 Q9 2.5 10.5 5" fill="#10B981" opacity="0.8"/>
                                    <path d="M10.5 5 Q13 0 15.5 -1 Q12 2.5 10.5 5" fill="#059669" opacity="0.8"/>
                                </g>

                                <!-- Ocean Waves -->
                                <path d="M4 38 Q10 36 16 38 Q22 40 28 38 Q34 36 40 38 Q46 40 52 38 Q58 36 64 38"
                                      stroke="rgba(16, 185, 129, 0.6)" stroke-width="1.5" fill="none"/>
                                <path d="M4 42 Q10 40 16 42 Q22 44 28 42 Q34 40 40 42 Q46 44 52 42 Q58 40 64 42"
                                      stroke="rgba(16, 185, 129, 0.4)" stroke-width="1.5" fill="none"/>

                                <!-- Sun -->
                                <circle cx="45" cy="16" r="5" fill="#FCD34D" opacity="0.9"/>
                                <g transform="translate(45, 16)">
                                    <path d="M0 -8 L0 -7" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                    <path d="M6 -6 L5 -5" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                    <path d="M8 0 L7 0" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                    <path d="M6 6 L5 5" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                    <path d="M0 8 L0 7" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                    <path d="M-6 6 L-5 5" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                    <path d="M-8 0 L-7 0" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                    <path d="M-6 -6 L-5 -5" stroke="#FCD34D" stroke-width="1" opacity="0.7"/>
                                </g>

                                <!-- Text -->
                                <text x="70" y="25" font-family="serif" font-size="16" font-weight="bold" fill="white">
                                    {{ Str::limit($siteName, 12) }}
                                </text>
                                <text x="70" y="40" font-family="serif" font-size="12" font-weight="300" fill="rgba(255,255,255,0.9)">
                                    {{ $siteTagline }}
                                </text>
                                <text x="70" y="52" font-family="sans-serif" font-size="8" font-weight="400" fill="rgba(16, 185, 129, 0.8)" letter-spacing="1.5px">
                                    ECO LUXURY LODGE
                                </text>

                                <!-- Gradient Definitions -->
                                <defs>
                                    <linearGradient id="footerLogoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:rgba(16, 185, 129, 0.3);stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:rgba(5, 150, 105, 0.5);stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        @endif
                    </div>
                    <p class="text-gray-300 leading-relaxed">
                        {{ \App\Models\WebsiteSetting::get('site_description', 'Experience luxury eco-tourism at its finest. Where pristine beaches meet untamed wilderness, creating unforgettable memories in the heart of Tanzania.') }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="space-y-6">
                    <h4 class="text-xl font-bold text-white">Quick Links</h4>
                    <div class="flex flex-col space-y-3">
                        <a href="#location" class="text-gray-300 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-amber-500"></i>
                            Location
                        </a>
                        <a href="#hosting" class="text-gray-300 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-home text-amber-500"></i>
                            Hosting
                        </a>
                        <a href="#facilities" class="text-gray-300 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-swimming-pool text-amber-500"></i>
                            Facilities
                        </a>
                        <a href="#commitments" class="text-gray-300 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-leaf text-amber-500"></i>
                            Eco Commitments
                        </a>
                        <a href="#gallery" class="text-gray-300 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-images text-amber-500"></i>
                            Gallery
                        </a>
                    </div>
                </div>

                <!-- Legal and Credits -->
                <div class="space-y-6">
                    <h4 class="text-xl font-bold text-white">Legal & Credits</h4>
                    <div class="space-y-4">
                        <div class="flex flex-col space-y-2">
                            <a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-200">Terms of Use</a>
                            <a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-200">Privacy Policy</a>
                        </div>
                        <div class="text-sm text-gray-400 space-y-2">
                            <p>&copy; {{ date('Y') }} {{ $siteName }}</p>
                            <p>All rights reserved</p>
                            <!-- <p class="pt-2">
                                Website by
                                <a href="https://www.nancomcy.fr/" target="_blank" rel="noopener" class="text-emerald-400 hover:text-emerald-300 transition-colors duration-200 font-semibold">
                                    Agence NANCOMCY
                                </a>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Border -->
            <div class="mt-12 pt-8 border-t border-gray-700">
                <div class="text-center text-gray-400 text-sm">
                    <p>🌿 Committed to sustainable tourism and environmental protection 🌿</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Modern Saadani Kasa Bay Website JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all components
            initLoadingScreen();
            initNavigation();
            initHeroVideo();
            initActivities();
            initAmenities();
            initGallery();
            initScrollAnimations();
        });

        // Loading Screen
        function initLoadingScreen() {
            const loadingScreen = document.getElementById('loading-screen');

            // Hide loading screen after page load
            window.addEventListener('load', () => {
                setTimeout(() => {
                    loadingScreen.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                    }, 500);
                }, 1000);
            });
        }

        // Navigation
        function initNavigation() {
            const navbar = document.getElementById('navbar');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

            // Navbar scroll effect
            window.addEventListener('scroll', () => {
                if (window.scrollY > 100) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            });

            // Mobile menu toggle
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Smooth scrolling for navigation links
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = link.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        const offsetTop = targetElement.offsetTop - 80; // Account for fixed navbar
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }

                    // Close mobile menu if open
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            });
        }

        // Hero Video Functionality
        function initHeroVideo() {
            const video = document.getElementById('hero-video');
            const playBtn = document.getElementById('video-play-btn');
            const muteBtn = document.getElementById('video-mute-btn');
            const videoControls = document.getElementById('video-controls');

            if (!video) return;

            // Ensure video plays automatically
            video.play().catch(e => {
                console.log('Auto-play was prevented:', e);
            });

            // Play button functionality
            if (playBtn) {
                playBtn.addEventListener('click', () => {
                    if (video.paused) {
                        video.play();
                        playBtn.innerHTML = '<i class="fas fa-pause text-2xl group-hover:scale-110 transition-transform duration-300"></i>';
                    } else {
                        video.pause();
                        playBtn.innerHTML = '<i class="fas fa-play text-2xl ml-1 group-hover:scale-110 transition-transform duration-300"></i>';
                    }
                });
            }

            // Mute button functionality
            if (muteBtn) {
                muteBtn.addEventListener('click', () => {
                    video.muted = !video.muted;
                    muteBtn.innerHTML = video.muted
                        ? '<i class="fas fa-volume-mute"></i>'
                        : '<i class="fas fa-volume-up"></i>';
                });
            }

            // Show video controls on hover
            const heroSection = document.getElementById('hero');
            if (heroSection && videoControls) {
                heroSection.addEventListener('mouseenter', () => {
                    videoControls.classList.remove('hidden');
                });

                heroSection.addEventListener('mouseleave', () => {
                    videoControls.classList.add('hidden');
                });
            }

            // Video loading and error handling
            video.addEventListener('loadstart', () => {
                console.log('Video loading started');
            });

            video.addEventListener('canplay', () => {
                console.log('Video can start playing');
                video.play().catch(e => console.log('Play failed:', e));
            });

            video.addEventListener('error', (e) => {
                console.log('Video error:', e);
                // Fallback to image if video fails
                const fallbackImg = video.querySelector('img');
                if (fallbackImg) {
                    video.style.display = 'none';
                    fallbackImg.style.display = 'block';
                }
            });

            // Intersection Observer for performance
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        video.play().catch(e => console.log('Play failed:', e));
                    } else {
                        video.pause();
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(heroSection);
        }

        // Activities Data and Initialization
        function initActivities() {
            // Activities are now rendered server-side via Blade template
            // This function is kept for potential future enhancements
            console.log('Activities initialized - using server-side rendering');
        }

        // Amenities Data and Initialization
        function initAmenities() {
            // Amenities are now rendered server-side via Blade template
            // This function is kept for potential future enhancements
            console.log('Amenities initialized - using server-side rendering');
        }

        // Gallery functionality is now handled by the backend and displayed in the Blade template
        // The gallery images are loaded from the database via the SaadaniController

        // Scroll Animations
        function initScrollAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe elements for scroll animations
            const animatedElements = document.querySelectorAll('.section-header, .location-content, .hosting-intro, .facilities-content, .commitments-content, .contact-content');
            animatedElements.forEach(el => {
                observer.observe(el);
            });
        }

        // Global loading functions
        window.showLoading = function(type = 'global', message = null) {
            const overlay = document.getElementById(type + '-loading');
            if (overlay) {
                if (message) {
                    const messageEl = overlay.querySelector('p');
                    if (messageEl) messageEl.textContent = message;
                }
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        };

        window.hideLoading = function(type = 'global') {
            const overlay = document.getElementById(type + '-loading');
            if (overlay) {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
                document.body.style.overflow = '';
            }
        };
    </script>

    <!-- Global Loading Overlays -->
    <div id="global-loading" class="fixed inset-0 z-50 hidden items-center justify-center loading-overlay">
        <div class="text-center">
            <div class="inline-block w-8 h-8 border-4 border-emerald-200 border-t-emerald-600 rounded-full spinner-emerald"></div>
            <p class="mt-3 text-sm font-medium text-gray-700">Loading...</p>
        </div>
    </div>

    <div id="page-loading" class="fixed inset-0 z-40 hidden items-center justify-center loading-overlay">
        <div class="text-center">
            <div class="inline-block w-12 h-12 border-4 border-emerald-200 border-t-emerald-600 rounded-full spinner-emerald"></div>
            <p class="mt-4 text-base font-medium text-gray-700">Please wait...</p>
        </div>
    </div>

    <div id="form-loading" class="fixed inset-0 z-30 hidden items-center justify-center loading-overlay">
        <div class="text-center">
            <div class="flex space-x-1">
                <div class="w-3 h-3 bg-emerald-600 rounded-full bounce-emerald" style="animation-delay: 0ms;"></div>
                <div class="w-3 h-3 bg-emerald-600 rounded-full bounce-emerald" style="animation-delay: 150ms;"></div>
                <div class="w-3 h-3 bg-emerald-600 rounded-full bounce-emerald" style="animation-delay: 300ms;"></div>
            </div>
            <p class="mt-3 text-sm font-medium text-gray-700">Processing...</p>
        </div>
    </div>
</body>
</html>
