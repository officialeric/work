<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay') }}</title>

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
                            500: '#C8973F',
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

    <!-- Custom Admin Styles -->
    <style>
        .sidebar-link.active {
            background: linear-gradient(135deg, #B78B3E, #9A7235);
            color: white;
        }

        .sidebar-link:hover {
            background: rgba(183, 139, 62, 0.1);
            color: #B78B3E;
        }

        .sidebar-link.active:hover {
            background: linear-gradient(135deg, #9A7235, #7D5F2C);
        }

        .notification {
            animation: slideInRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Mobile menu overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-20 lg:hidden hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-4">
                    @php
                        $siteName = \App\Models\WebsiteSetting::get('site_name', 'Saadani Kasa Bay');
                        $siteLogo = \App\Models\WebsiteSetting::get('site_logo');
                    @endphp

                    <div class="flex items-center">
                        @if($siteLogo)
                            <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="h-8 w-auto mr-2">
                            <h1 class="text-gray-900 text-lg font-bold">Admin</h1>
                        @else
                            <h1 class="text-gray-900 text-xl font-bold">Admin</h1>
                        @endif
                    </div>

                    <!-- Mobile close button -->
                    <button id="close-sidebar" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.settings.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        Website Settings
                    </a>

                    <a href="{{ route('admin.bookings.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check w-5 h-5 mr-3"></i>
                        Bookings
                        @php
                            $pendingCount = \App\Models\Booking::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $pendingCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.activities.index') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
                        <i class="fas fa-hiking w-5 h-5 mr-3"></i>
                        Activities
                    </a>

                    <a href="{{ route('admin.amenities.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.amenities.*') ? 'active' : '' }}">
                        <i class="fas fa-concierge-bell w-5 h-5 mr-3"></i>
                        Amenities
                    </a>

                    <a href="{{ route('admin.accommodation-sections.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.accommodation-sections.*') ? 'active' : '' }}">
                        <i class="fas fa-bed w-5 h-5 mr-3"></i>
                        Accommodations
                    </a>

                    <a href="{{ route('admin.room-types.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.room-types.*') ? 'active' : '' }}">
                        <i class="fas fa-door-open w-5 h-5 mr-3"></i>
                        Room Types
                    </a>

                    <a href="{{ route('admin.commitments.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.commitments.*') ? 'active' : '' }}">
                        <i class="fas fa-leaf w-5 h-5 mr-3"></i>
                        Commitments
                    </a>

                    <a href="{{ route('admin.gallery.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                        <i class="fas fa-images w-5 h-5 mr-3"></i>
                        Gallery
                    </a>

                    <a href="{{ route('admin.locations.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt w-5 h-5 mr-3"></i>
                        Locations
                    </a>

                    <a href="{{ route('admin.hosting-sections.index') }}"
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.hosting-sections.*') ? 'active' : '' }}">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        Hosting Sections
                    </a>
                </nav>

                <!-- User Menu -->
                <div class="px-4 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.profile.show') }}" class="flex items-center hover:bg-gray-50 rounded-lg p-2 transition-colors duration-200 flex-1">
                            <div class="w-8 h-8 bg-golden-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-700">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ ucfirst(str_replace('_', ' ', Auth::guard('admin')->user()->role)) }}</p>
                            </div>
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors duration-200 p-2">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4">
                    <div class="flex items-center">
                        <!-- Mobile menu button -->
                        <button id="mobile-menu-button" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 mr-3">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <div>
                            <h2 class="text-lg sm:text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                            @hasSection('breadcrumbs')
                                <nav class="text-sm text-gray-600 mt-1 hidden sm:block">
                                    @yield('breadcrumbs')
                                </nav>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <a href="{{ route('saadani.index') }}"
                           target="_blank"
                           class="inline-flex items-center px-3 sm:px-4 py-2 bg-golden-600 text-white text-sm font-medium rounded-lg hover:bg-golden-700 transition-colors duration-200">
                            <i class="fas fa-external-link-alt mr-1 sm:mr-2"></i>
                            <span class="hidden sm:inline">View Website</span>
                            <span class="sm:hidden">View</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                @if(session('success'))
                    <div class="notification bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="notification bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="notification bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Please fix the following errors:</strong>
                        </div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="fade-in">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Auto-hide notifications after 5 seconds
        setTimeout(() => {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                notification.style.transition = 'opacity 0.3s ease-out';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            });
        }, 5000);

        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const closeSidebarButton = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-menu-overlay');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', openSidebar);
            }

            if (closeSidebarButton) {
                closeSidebarButton.addEventListener('click', closeSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Close sidebar on window resize if screen becomes large
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
            });
        });

        // CSRF token for AJAX requests
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };

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
    <div id="global-loading" class="fixed inset-0 z-50 hidden items-center justify-center" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(4px);">
        <div class="text-center">
            <div class="inline-block w-8 h-8 border-4 border-golden-200 border-t-golden-600 rounded-full animate-spin"></div>
            <p class="mt-3 text-sm font-medium text-gray-700">Loading...</p>
        </div>
    </div>

    <div id="form-loading" class="fixed inset-0 z-30 hidden items-center justify-center" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(4px);">
        <div class="text-center">
            <div class="flex space-x-1">
                <div class="w-3 h-3 bg-golden-600 rounded-full animate-bounce" style="animation-delay: 0ms;"></div>
                <div class="w-3 h-3 bg-golden-600 rounded-full animate-bounce" style="animation-delay: 150ms;"></div>
                <div class="w-3 h-3 bg-golden-600 rounded-full animate-bounce" style="animation-delay: 300ms;"></div>
            </div>
            <p class="mt-3 text-sm font-medium text-gray-700">Processing...</p>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
