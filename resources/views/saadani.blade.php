@extends('layouts.app')

@section('title', $settings['site_name'] . ' - ' . $settings['site_tagline'])
@section('description', $settings['site_description'])

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Video -->
        <div class="absolute inset-0 z-0">
            <video
                id="hero-video"
                autoplay
                muted
                loop
                playsinline
                class="w-full h-full object-cover object-center"
                poster="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1920&h=1080&fit=crop&crop=center">
                <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">
                <source src="https://www.learningcontainer.com/wp-content/uploads/2020/05/sample-mp4-file.mp4" type="video/mp4">
                <!-- Fallback image if video doesn't load -->
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1920&h=1080&fit=crop&crop=center"
                     alt="Saadani Beach"
                     class="w-full h-full object-cover object-center">
            </video>
            <!-- Enhanced overlay with gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/60"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white max-w-5xl mx-auto px-4">
          

            <!-- Main Title with Enhanced Typography -->
            <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
                @php
                    $titleParts = explode(' ', $settings['hero_title']);
                    $firstPart = $titleParts[0] ?? 'Saadani';
                    $secondPart = isset($titleParts[1]) ? implode(' ', array_slice($titleParts, 1)) : 'Kasa Bay';
                @endphp
                <span class="block text-white drop-shadow-2xl">{{ $firstPart }}</span>
                <span class="block text-emerald-300 drop-shadow-2xl">{{ $secondPart }}</span>
            </h1>

            <!-- Subtitle with Better Styling -->
            <p class="text-xl md:text-3xl lg:text-4xl font-light mb-4 text-white/95 drop-shadow-lg">
                {{ $settings['hero_subtitle'] }}
            </p>

            <!-- Description -->
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-12 text-white/80 leading-relaxed">
                {{ $settings['hero_description'] }}
            </p>

            <!-- Enhanced Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-16">
                <!-- Video Play Button -->
                <button id="video-play-btn" class="group relative w-24 h-24 rounded-full bg-white/15 backdrop-blur-md border-2 border-white/30 flex items-center justify-center text-white hover:bg-emerald-500/80 hover:border-emerald-400 hover:scale-110 transition-all duration-500 shadow-2xl">
                    <i class="fas fa-play text-2xl ml-1 group-hover:scale-110 transition-transform duration-300"></i>
                    <div class="absolute inset-0 rounded-full bg-white/20 animate-ping"></div>
                </button>

                <!-- Explore Button -->
                <a href="#location" class="inline-flex items-center gap-3 bg-emerald-600/90 hover:bg-emerald-500 backdrop-blur-sm border border-emerald-400/50 text-white px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <span>Explore Paradise</span>
                    <i class="fas fa-arrow-down animate-bounce"></i>
                </a>
            </div>

            <!-- Stats or Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-emerald-300 mb-2">12</div>
                    <div class="text-white/80 text-sm uppercase tracking-wider">Luxury Villas</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-emerald-300 mb-2">5km</div>
                    <div class="text-white/80 text-sm uppercase tracking-wider">Private Beach</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-emerald-300 mb-2">100%</div>
                    <div class="text-white/80 text-sm uppercase tracking-wider">Eco-Friendly</div>
                </div>
            </div>
        </div>

        <!-- Enhanced Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <a href="#location" class="flex flex-col items-center text-white/80 hover:text-white transition-colors duration-300">
                <span class="text-xs uppercase tracking-wider mb-2 font-medium">Discover More</span>
                <div class="w-6 h-10 border-2 border-white/40 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/60 rounded-full mt-2 animate-bounce"></div>
                </div>
            </a>
        </div>

        <!-- Video Controls (Hidden by default) -->
        <div id="video-controls" class="absolute bottom-20 right-8 z-10 hidden">
            <button id="video-mute-btn" class="bg-black/50 backdrop-blur-sm text-white p-3 rounded-full hover:bg-black/70 transition-all duration-300">
                <i class="fas fa-volume-mute"></i>
            </button>
        </div>
    </section>

    <!-- Location Section -->
    <section id="location" class="py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold text-emerald-800 mb-4">
                    Location
                </h2>
                <h3 class="font-display text-2xl md:text-3xl text-emerald-600 mb-8">
                    A breathtaking setting
                </h3>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Text Content -->
                <div class="space-y-6">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        100 km north of Dar es Salaam, facing the island of Zanzibar, discover Saadani Kasa Bay. 
                        Nestled between a pristine white sand beach and the infinite blue of the Indian Ocean, 
                        this unique lodge offers an idyllic setting where luxury meets untamed nature.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        On the land side, Saadani National Park reveals a mosaic of fascinating landscapes and 
                        exceptional wildlife, perfect for unforgettable safaris. Every moment spent here is a 
                        promise of experiences rich in emotion and authenticity, a unique adventure in the heart of Tanzania.
                    </p>
                    <div class="pt-4">
                        <a href="#gallery" class="inline-block bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-emerald-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            View Gallery
                        </a>
                    </div>
                </div>

                <!-- Image Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=800&fit=crop&crop=center" 
                             alt="Saadani landscape" 
                             class="w-full h-80 object-cover rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    </div>
                    <div class="pt-8">
                        <img src="https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center" 
                             alt="Wildlife safari" 
                             class="w-full h-64 object-cover rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hosting Section -->
    <section id="hosting" class="py-20 lg:py-32 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold text-emerald-800 mb-4">
                    Hosting
                </h2>
                <h3 class="font-display text-2xl md:text-3xl text-emerald-600 mb-8">
                    Escape & Serenity
                </h3>
            </div>

            <!-- Intro Content -->
            <div class="text-center max-w-4xl mx-auto mb-16">
                <p class="text-lg text-gray-700 leading-relaxed mb-8">
                    A blend of refined comfort and authenticity, Saadani Kasa Bay invites you to enjoy a unique experience, 
                    combining discovery, tranquillity and wonder. A timeless escape to the essential, a view of the ocean 
                    from your room as a call to serenity, and a breathtakingly beautiful natural setting to enhance your stay.
                </p>
                <button class="inline-flex items-center gap-3 bg-transparent border-2 border-emerald-600 text-emerald-600 px-8 py-3 rounded-lg font-semibold hover:bg-emerald-600 hover:text-white transition-all duration-300">
                    <i class="fas fa-play"></i>
                    Watch Video
                </button>
            </div>

            <!-- Activities Section -->
            <div>
                <h4 class="font-display text-2xl md:text-3xl font-semibold text-center text-emerald-800 mb-12">
                    Activities
                </h4>
                
                <!-- Activities Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="activities-grid">
                    @foreach($activities as $activity)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            @if($activity->image)
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $activity->image_url }}"
                                         alt="{{ $activity->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    @if($activity->number)
                                        <div class="absolute top-4 left-4 bg-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $activity->number }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div class="p-6">
                                <h5 class="text-xl font-semibold text-emerald-800 mb-3">{{ $activity->title }}</h5>
                                <p class="text-gray-600 leading-relaxed">
                                    {!! nl2br(e($activity->description)) !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold text-emerald-800 mb-4">
                    Facilities
                </h2>
                <h3 class="font-display text-2xl md:text-3xl text-emerald-600 mb-8">
                    A charming retreat in the heart of nature
                </h3>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Text Content -->
                <div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-8">
                        Saadani Kasa Bay offers 12 exceptional rooms, divided between 4 family villas and 8 elegantly 
                        appointed double villas. The family villas, each measuring a minimum of 25 m², include a living room, 
                        two separate bedrooms and a small office with comfortable armchairs.
                    </p>
                    
                    <!-- Amenities Grid -->
                    <div class="grid grid-cols-2 gap-4" id="amenities-grid">
                        @foreach($amenities as $amenity)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <i class="{{ $amenity->icon }} text-emerald-600"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $amenity->title }}</div>
                                    @if($amenity->subtitle)
                                        <div class="text-sm text-gray-600">{{ $amenity->subtitle }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Facility Image -->
                <div>
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop&crop=center" 
                         alt="Luxury villa interior" 
                         class="w-full h-96 object-cover rounded-2xl shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Commitments Section -->
    <section id="commitments" class="py-20 lg:py-32 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold text-emerald-800 mb-4">
                    Our Commitments
                </h2>
                <h3 class="font-display text-2xl md:text-3xl text-emerald-600 mb-8">
                    For sustainable and respectful tourism
                </h3>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Text Content -->
                <div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-8">
                        From the outset, Saadani Kasa Bay was designed to incorporate the most innovative eco-tourism practices.
                    </p>

                    <!-- Commitments List -->
                    <div class="space-y-4">
                        @foreach($commitments as $commitment)
                            <div class="flex items-start gap-4 p-4 bg-white rounded-lg shadow-sm">
                                <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <i class="{{ $commitment->icon }} text-emerald-600"></i>
                                </div>
                                <span class="text-gray-700">{{ $commitment->title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Image with Badge -->
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=600&h=800&fit=crop&crop=center"
                         alt="Sustainable tourism"
                         class="w-full h-96 object-cover rounded-2xl shadow-lg">
                    <div class="absolute bottom-4 right-4 bg-white p-3 rounded-lg shadow-lg">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=120&h=60&fit=crop&crop=center"
                             alt="Go Green Certification"
                             class="h-8 w-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold text-emerald-800 mb-4">
                    Photo Gallery
                </h2>
                <h3 class="font-display text-2xl md:text-3xl text-emerald-600 mb-8">
                    Saadani Kasa Bay in pictures
                </h3>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                    Discover our photo gallery. Stunning images of Saadani's beauty, a unique and immersive experience awaits you at Saadani Kasa Bay.
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="gallery-grid">
                @foreach($galleryImages as $image)
                    <div class="relative group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ $image->thumbnail_url }}"
                             alt="{{ $image->alt_text ?: $image->title }}"
                             class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 cursor-pointer"
                             onclick="openLightbox('{{ $image->image_url }}', '{{ $image->title }}')">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-expand text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($galleryImages->count() === 0)
                <div class="text-center py-12">
                    <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg">Gallery images will be displayed here once uploaded.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 lg:py-32 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold mb-4">
                    Contact
                </h2>
                <h3 class="font-display text-2xl md:text-3xl text-gray-300 mb-8">
                    Contact us
                </h3>
            </div>

            <!-- Contact Content -->
            <div class="max-w-2xl mx-auto text-center">
                <!-- Logo -->
                <div class="mb-8">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=200&h=80&fit=crop&crop=center"
                         alt="Saadani Kasa Bay Logo"
                         class="h-16 w-auto mx-auto rounded-lg">
                </div>

                <!-- Contact Details -->
                <div class="space-y-6">
                    <div class="flex items-center justify-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-gray-300 text-sm">Information & reservations:</p>
                            <a href="mailto:{{ $settings['contact_email'] }}" class="text-white hover:text-emerald-400 transition-colors duration-200 text-lg">
                                {{ $settings['contact_email'] }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-phone text-white"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-gray-300 text-sm">Telephone:</p>
                            <a href="tel:{{ str_replace(' ', '', $settings['contact_phone']) }}" class="text-white hover:text-emerald-400 transition-colors duration-200 text-lg">
                                {{ $settings['contact_phone'] }}
                            </a>
                        </div>
                    </div>

                    @if($settings['contact_address'])
                        <div class="flex items-center justify-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-300 text-sm">Location:</p>
                                <p class="text-white text-lg">{{ $settings['contact_address'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center z-50">
        <div class="relative max-w-4xl max-h-[90vh] mx-4">
            <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain">
            <button onclick="closeLightbox()"
                    class="absolute top-4 right-4 w-10 h-10 bg-black bg-opacity-50 text-white rounded-full flex items-center justify-center hover:bg-opacity-75 transition-all duration-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-center">
            <h3 id="lightbox-title" class="text-white text-lg font-medium"></h3>
        </div>
    </div>

    <script>
        function openLightbox(imageUrl, title) {
            document.getElementById('lightbox-image').src = imageUrl;
            document.getElementById('lightbox-title').textContent = title || '';
            document.getElementById('lightbox').classList.remove('hidden');
            document.getElementById('lightbox').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.getElementById('lightbox').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close lightbox on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });

        // Close lightbox on background click
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });
    </script>
@endsection
