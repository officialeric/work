import './bootstrap';

// Modern Saadani Kasa Bay Website JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initLoadingScreen();
    initNavigation();
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

// Utility function for smooth scrolling
function smoothScrollTo(targetId) {
    const targetElement = document.querySelector(targetId);
    if (targetElement) {
        const offsetTop = targetElement.offsetTop - 80;
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    }
}
