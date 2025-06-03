<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Saadani Kasa Bay - Luxury Eco-Lodge Tanzania')</title>
    <meta name="description" content="@yield('description', 'Discover Saadani Kasa Bay, a luxury eco-lodge facing the Indian Ocean in Tanzania. Experience pristine beaches, wildlife safaris, and sustainable tourism.')">

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
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900 overflow-x-hidden">
    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 bg-white z-[9999] flex items-center justify-center transition-opacity duration-500">
        <div class="text-center">
            <div class="w-12 h-12 border-3 border-gray-200 border-t-emerald-600 rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-gray-600 italic">Loading dream landscapes...</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-[100] bg-white/90 backdrop-blur-xl border-b border-white/20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#hero" class="block">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=200&h=80&fit=crop&crop=center" 
                             alt="Saadani Kasa Bay Logo" 
                             class="h-12 w-auto rounded-lg">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#hero" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Home</a>
                        <a href="#location" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Location</a>
                        <a href="#hosting" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Hosting</a>
                        <a href="#facilities" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Facilities</a>
                        <a href="#commitments" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Commitments</a>
                        <a href="#gallery" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Gallery</a>
                        <a href="#contact" class="bg-emerald-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">Contact</a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">
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
                <a href="#hero" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Home</a>
                <a href="#location" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Location</a>
                <a href="#hosting" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Hosting</a>
                <a href="#facilities" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Facilities</a>
                <a href="#commitments" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Commitments</a>
                <a href="#gallery" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Gallery</a>
                <a href="#contact" class="mobile-nav-link block px-3 py-2 rounded-lg text-base font-medium text-gray-900 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-xl font-semibold mb-4">Saadani Kasa Bay</h4>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Terms of use</a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Privacy policy</a>
                </div>
                <div class="text-sm text-gray-400">
                    <p>&copy; COPYRIGHT SAADANI KASA BAY</p>
                    <p>Realization <a href="https://www.nancomcy.fr/" target="_blank" rel="noopener" class="text-emerald-400 hover:text-emerald-300 transition-colors duration-200">Agence NANCOMCY</a></p>
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
            const activities = [
                {
                    number: "1/7",
                    title: "Madete Beach",
                    description: "Enjoy **Madete Beach**, an exceptional protected sanctuary. Both a national park and a marine park, accessible only to authorized visitors, this stretch of white sand stretches for 5 km around the lodge, offering bathing at any time, with very little tidal variation.",
                    image: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&h=400&fit=crop&crop=center"
                },
                {
                    number: "2/7",
                    title: "Safari in Saadani National Park",
                    description: "Go on **safari in Saadani National Park**, where remarkable wildlife awaits you: a dozen species of antelope, monkeys, warthogs, majestic elephants, elegant giraffes, imposing buffalo, and even lions on the loose.",
                    image: "https://images.unsplash.com/photo-1516426122078-c23e76319801?w=600&h=400&fit=crop&crop=center"
                },
                {
                    number: "3/7",
                    title: "Wami River Boat Trip",
                    description: "Take a boat trip **up the Wami River** to observe crocodiles, hippos and a rich diversity of birds. A magical moment on the water, in the heart of the wilderness.",
                    image: "https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=600&h=400&fit=crop&crop=center"
                },
                {
                    number: "4/7",
                    title: "Fishing Villages",
                    description: "Discover local life by visiting **fishing villages**. Live an authentic experience by embarking with them for a traditional fishing session in the waters of the Indian Ocean.",
                    image: "https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&h=400&fit=crop&crop=center"
                },
                {
                    number: "5/7",
                    title: "Mafui Sandbank",
                    description: "**Sail to Mafui Sandbank**, a secluded sandbar just 5 km from the beach. This idyllic spot is a small paradise for divers and snorkelers, surrounded by crystal-clear waters.",
                    image: "https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=400&fit=crop&crop=center"
                },
                {
                    number: "6/7",
                    title: "Sunset Cruise",
                    description: "Enjoy a **sunset cruise**, a sea excursion to admire the golden hues of the sunset.",
                    image: "https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop&crop=center"
                },
                {
                    number: "7/7",
                    title: "Explore the Mangroves",
                    description: "**Explore the mangroves** on foot along the beach or by gallawas, the traditional boats of the Tanzanian coast.",
                    image: "https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center"
                }
            ];

            const activitiesGrid = document.getElementById('activities-grid');
            if (activitiesGrid) {
                activitiesGrid.innerHTML = activities.map((activity, index) => `
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift animate-fade-in-up animate-delay-${(index % 3 + 1) * 100}">
                        <div class="relative h-48">
                            <img src="${activity.image}" alt="${activity.title}" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                ${activity.number}
                            </div>
                        </div>
                        <div class="p-6">
                            <h5 class="font-display text-xl font-semibold text-emerald-800 mb-3">${activity.title}</h5>
                            <p class="text-gray-700 leading-relaxed">${activity.description.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')}</p>
                        </div>
                    </div>
                `).join('');
            }
        }

        // Amenities Data and Initialization
        function initAmenities() {
            const amenities = [
                { icon: "fas fa-bed", text: "12 luxury rooms", subtitle: "Bathroom, toilet, terrace" },
                { icon: "fas fa-users", text: "Sleeps up to 4", subtitle: "" },
                { icon: "fas fa-utensils", text: "Restaurant", subtitle: "" },
                { icon: "fas fa-cocktail", text: "Bar", subtitle: "" },
                { icon: "fas fa-swimming-pool", text: "Pool", subtitle: "" },
                { icon: "fas fa-shield-alt", text: "Security agents", subtitle: "" },
                { icon: "fas fa-bolt", text: "Electricity 24/24", subtitle: "" },
                { icon: "fas fa-wifi", text: "Wifi", subtitle: "" }
            ];

            const amenitiesGrid = document.getElementById('amenities-grid');
            if (amenitiesGrid) {
                amenitiesGrid.innerHTML = amenities.map((amenity, index) => `
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg animate-fade-in-left animate-delay-${(index % 4 + 1) * 100}">
                        <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="${amenity.icon} text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">${amenity.text}</p>
                            ${amenity.subtitle ? `<p class="text-sm text-gray-600">${amenity.subtitle}</p>` : ''}
                        </div>
                    </div>
                `).join('');
            }
        }

        // Gallery Data and Initialization
        function initGallery() {
            const galleryImages = [
                "https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=600&h=800&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1516426122078-c23e76319801?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1518837695005-2083093ee35b?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1551632811-561732d1e306?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1520637836862-4d197d17c93a?w=600&h=400&fit=crop&crop=center",
                "https://images.unsplash.com/photo-1549880338-65ddcdfd017b?w=600&h=400&fit=crop&crop=center"
            ];

            const galleryGrid = document.getElementById('gallery-grid');
            if (galleryGrid) {
                galleryGrid.innerHTML = galleryImages.map((image, index) => `
                    <div class="gallery-item animate-fade-in-up animate-delay-${(index % 4 + 1) * 100}">
                        <img src="${image}" alt="Saadani Kasa Bay Gallery Image ${index + 1}" class="w-full h-64 object-cover">
                    </div>
                `).join('');
            }
        }

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
    </script>
</body>
</html>
