@extends('layouts.app')

@section('title', $settings['site_name'] . ' - ' . $settings['site_tagline'])
@section('description', $settings['site_description'])

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16 md:pt-0">
        <!-- Background Video -->
        <div class="absolute inset-0 z-0">
            @if($settings['hero_video'])
                <video
                    id="hero-video"
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover object-center"
                    poster="{{ $settings['hero_image'] ? asset('storage/' . $settings['hero_image']) : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1920&h=1080&fit=crop&crop=center' }}">
                    <source src="{{ $settings['hero_video'] }}" type="video/mp4">
                    <!-- Fallback image if video doesn't load -->
                    <img src="{{ $settings['hero_image'] ? asset('storage/' . $settings['hero_image']) : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1920&h=1080&fit=crop&crop=center' }}"
                         alt="{{ $settings['site_name'] }}"
                         class="w-full h-full object-cover object-center">
                </video>
            @else
                <!-- Fallback to image if no video is set -->
                <img src="{{ $settings['hero_image'] ? asset('storage/' . $settings['hero_image']) : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1920&h=1080&fit=crop&crop=center' }}"
                     alt="{{ $settings['site_name'] }}"
                     class="w-full h-full object-cover object-center">
            @endif
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
                <span class=" text-white drop-shadow-2xl">{{ $firstPart }}</span>
                <span class=" text-amber-300 drop-shadow-2xl">{{ $secondPart }}</span>
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
                <button id="video-play-btn" class="group relative w-24 h-24 rounded-full bg-white/15 backdrop-blur-md border-2 border-white/30 flex items-center justify-center text-white hover:bg-amber-500/80 hover:border-amber-400 hover:scale-110 transition-all duration-500 shadow-2xl">
                    <i class="fas fa-play text-2xl ml-1 group-hover:scale-110 transition-transform duration-300"></i>
                    <div class="absolute inset-0 rounded-full bg-white/20 animate-ping"></div>
                </button>

                <!-- Explore Button -->
                <a href="#location" class="inline-flex items-center gap-3 bg-amber-600/90 hover:bg-amber-500 backdrop-blur-sm border border-amber-400/50 text-white px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <span>Explore Paradise</span>
                    <i class="fas fa-arrow-down animate-bounce"></i>
                </a>
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
    <section id="location" class="py-24 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            @if($locations->count() > 0)
                @foreach($locations as $location)
                    <!-- Section Header -->
                    <div class="text-center mb-20">
                        <div class="inline-block">
                            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">
                                {{ $location->title }}
                            </h2>
                            <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-amber-500 mx-auto mb-6"></div>
                        </div>
                        @if($location->subtitle)
                            <h3 class="font-display text-2xl md:text-3xl bg-gradient-to-r from-emerald-600 to-amber-600 bg-clip-text text-transparent mb-6">
                                {{ $location->subtitle }}
                            </h3>
                        @endif
                    </div>

                    <!-- Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20 items-center mb-20">
                        <!-- Text Content -->
                        <div class="space-y-8">
                            <div class="bg-gradient-to-br from-emerald-50 via-amber-50/30 to-emerald-100/50 rounded-3xl p-8 border border-emerald-200/50 shadow-lg">
                                <h4 class="text-2xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">{{ $location->title }}</h4>
                                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                                    {!! nl2br(e($location->description)) !!}
                                </p>
                                @if($location->additional_description)
                                    <p class="text-lg text-gray-700 leading-relaxed">
                                        {!! nl2br(e($location->additional_description)) !!}
                                    </p>
                                @endif
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ $location->button_link }}" class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-emerald-600 to-amber-600 hover:from-emerald-700 hover:to-amber-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-images"></i>
                                    {{ $location->button_text }}
                                </a>
                                <a href="#activities" class="inline-flex items-center justify-center gap-3 bg-white border-2 border-emerald-600 text-emerald-600 hover:bg-gradient-to-r hover:from-emerald-600 hover:to-amber-600 hover:text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-compass"></i>
                                    Explore Activities
                                </a>
                            </div>
                        </div>

                        <!-- Image Grid -->
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-6">
                                @if($location->image_1_url)
                                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                        <img src="{{ $location->image_1_url }}"
                                             alt="{{ $location->title }}"
                                             class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                @else
                                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                        <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=800&fit=crop&crop=center"
                                             alt="Saadani landscape"
                                             class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                @endif
                            </div>
                            <div class="pt-12 space-y-6">
                                @if($location->image_2_url)
                                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                        <img src="{{ $location->image_2_url }}"
                                             alt="{{ $location->title }}"
                                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                @else
                                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                        <img src="https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center"
                                             alt="Wildlife safari"
                                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                @endif

                                @if($location->image_3_url)
                                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                        <img src="{{ $location->image_3_url }}"
                                             alt="{{ $location->title }}"
                                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                @else
                                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=300&fit=crop&crop=center"
                                             alt="Ocean view"
                                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Default Content -->
                <div class="text-center mb-20">
                    <div class="inline-block">
                        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">
                            Location
                        </h2>
                        <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-amber-500 mx-auto mb-6"></div>
                    </div>
                    <h3 class="font-display text-2xl md:text-3xl bg-gradient-to-r from-emerald-600 to-amber-600 bg-clip-text text-transparent mb-6">
                        A breathtaking setting
                    </h3>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Discover our prime location where pristine beaches meet untamed wilderness
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20 items-center">
                    <!-- Text Content -->
                    <div class="space-y-8">
                        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-3xl p-8 border border-emerald-200/50">
                            <h4 class="text-2xl font-bold text-emerald-800 mb-6">Prime Location</h4>
                            <p class="text-lg text-gray-700 leading-relaxed mb-6">
                                100 km north of Dar es Salaam, facing the island of Zanzibar, discover Saadani Kasa Bay.
                                Nestled between a pristine white sand beach and the infinite blue of the Indian Ocean,
                                this unique lodge offers an idyllic setting where luxury meets untamed nature.
                            </p>
                            <p class="text-lg text-gray-700 leading-relaxed">
                                On the land side, Saadani National Park reveals a mosaic of fascinating landscapes and
                                exceptional wildlife, perfect for unforgettable safaris. Every moment spent here is a
                                promise of experiences rich in emotion and authenticity, a unique adventure in the heart of Tanzania.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#gallery" class="inline-flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <i class="fas fa-images"></i>
                                View Gallery
                            </a>
                            <a href="#activities" class="inline-flex items-center justify-center gap-3 bg-white border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-compass"></i>
                                Explore Activities
                            </a>
                        </div>
                    </div>

                    <!-- Image Grid -->
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=800&fit=crop&crop=center"
                                     alt="Saadani landscape"
                                     class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        <div class="pt-12 space-y-6">
                            <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                <img src="https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center"
                                     alt="Wildlife safari"
                                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-shadow duration-500">
                                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=300&fit=crop&crop=center"
                                     alt="Ocean view"
                                     class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Hosting Section -->
    <section id="hosting" class="py-24 lg:py-32 bg-gradient-to-br from-gray-50 to-emerald-50/20">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            @if($hostingSections->count() > 0)
                @foreach($hostingSections as $hostingSection)
                    <!-- Section Header -->
                    <div class="text-center mb-20">
                        <div class="inline-block">
                            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">
                                {{ $hostingSection->title }}
                            </h2>
                            <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-amber-500 mx-auto mb-6"></div>
                        </div>
                        @if($hostingSection->subtitle)
                            <h3 class="font-display text-2xl md:text-3xl bg-gradient-to-r from-emerald-600 to-amber-600 bg-clip-text text-transparent mb-6">
                                {{ $hostingSection->subtitle }}
                            </h3>
                        @endif
                    </div>

                    <!-- Intro Content -->
                    <div class="text-center max-w-5xl mx-auto mb-20">
                        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-12 shadow-lg border border-white/50"
                             @if($hostingSection->background_image_url)
                                style="background-image: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('{{ $hostingSection->background_image_url }}'); background-size: cover; background-position: center;"
                             @endif>
                            <p class="text-xl text-gray-700 leading-relaxed mb-8">
                                {!! nl2br(e($hostingSection->description)) !!}
                            </p>
                            @if($hostingSection->video_url)
                                <a href="{{ $hostingSection->video_url }}" target="_blank" class="inline-flex items-center gap-3 bg-gradient-to-r from-emerald-600 to-amber-600 hover:from-emerald-700 hover:to-amber-700 text-white px-10 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-play"></i>
                                    {{ $hostingSection->video_button_text }}
                                </a>
                            @else
                                <button onclick="alert('Video will be available soon!')" class="inline-flex items-center gap-3 bg-gradient-to-r from-emerald-600 to-amber-600 hover:from-emerald-700 hover:to-amber-700 text-white px-10 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-play"></i>
                                    {{ $hostingSection->video_button_text }}
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Default Content -->
                <div class="text-center mb-20">
                    <div class="inline-block">
                        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-emerald-800 mb-6">
                            #Hosting 
                        </h2>
                        <div class="w-24 h-1 bg-emerald-600 mx-auto mb-6"></div>
                    </div>
                    <h3 class="font-display text-2xl md:text-3xl text-emerald-600 mb-6">
                        Escape & Serenity
                    </h3>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Experience the perfect blend of luxury and nature in our exclusive retreat
                    </p>
                </div>

                <div class="text-center max-w-5xl mx-auto mb-20">
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-12 shadow-lg border border-white/50">
                        <p class="text-xl text-gray-700 leading-relaxed mb-8">
                            A blend of refined comfort and authenticity, Saadani Kasa Bay invites you to enjoy a unique experience,
                            combining discovery, tranquillity and wonder. A timeless escape to the essential, a view of the ocean
                            from your room as a call to serenity, and a breathtakingly beautiful natural setting to enhance your stay.
                        </p>
                        <button onclick="alert('Video will be available soon!')" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white px-10 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-play"></i>
                            Watch Experience Video
                        </button>
                    </div>
                </div>
            @endif

            <!-- Activities Section -->
            <div id="activities">
                <div class="text-center mb-16">
                    <h4 class="font-display text-3xl md:text-4xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">
                        Activities & Experiences
                    </h4>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Discover unforgettable adventures that await you at Saadani Kasa Bay
                    </p>
                </div>
                
                <!-- Activities Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="activities-grid">

                    
                    @foreach($activities as $activity)
                        <div class="group bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 border border-gray-100">
                            @if($activity->image)
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{ $activity->image_url }}"
                                         alt="{{ $activity->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @if($activity->number)
                                        <div class="absolute top-6 left-6 bg-gradient-to-r from-emerald-600 to-amber-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                            {{ $activity->number }}
                                        </div>
                                    @endif
                                    <!-- Overlay gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @endif
                            <div class="p-8">
                                <h5 class="text-xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-4 group-hover:from-emerald-600 group-hover:to-amber-600 transition-all duration-300">
                                    {{ $activity->title }}
                                </h5>
                                <p class="text-gray-600 leading-relaxed text-sm">
                                    {!! nl2br(e($activity->description)) !!}
                                </p>
                                <!-- Read more indicator -->
                                <div class="mt-6 flex items-center text-emerald-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span>Learn more</span>
                                    <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-24 lg:py-32 bg-gradient-to-br from-gray-50 to-emerald-50/30">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <div class="inline-block">
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">
                        Facilities
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-amber-500 mx-auto mb-6"></div>
                </div>
                <h3 class="font-display text-2xl md:text-3xl bg-gradient-to-r from-emerald-600 to-amber-600 bg-clip-text text-transparent mb-6">
                    A charming retreat in the heart of nature
                </h3>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Experience luxury and comfort in our thoughtfully designed accommodations
                </p>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20 items-center">
                <!-- Text Content -->
                <div class="space-y-8">
                    @if($accommodationSections->count() > 0)
                        @foreach($accommodationSections as $accommodationSection)
                            <div class="bg-gradient-to-br from-emerald-50 via-amber-50/30 to-emerald-100/50 rounded-3xl p-8 shadow-lg border border-emerald-200/50">
                                <h4 class="text-2xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">{{ $accommodationSection->title }}</h4>
                                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                                    {!! nl2br(e($accommodationSection->description)) !!}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <!-- Default Content -->
                        <div class="bg-gradient-to-br from-emerald-50 via-amber-50/30 to-emerald-100/50 rounded-3xl p-8 shadow-lg border border-emerald-200/50">
                            <h4 class="text-2xl font-bold bg-gradient-to-r from-emerald-800 to-amber-700 bg-clip-text text-transparent mb-6">Luxury Accommodations</h4>
                            <p class="text-lg text-gray-700 leading-relaxed mb-6">
                                Saadani Kasa Bay offers 12 exceptional rooms, divided between 4 family villas and 8 elegantly
                                appointed double villas. The family villas, each measuring a minimum of 25 m², include a living room,
                                two separate bedrooms and a small office with comfortable armchairs.
                            </p>
                        </div>
                    @endif

                   

                    <!-- Amenities Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="amenities-grid">
                        @foreach($amenities as $amenity)
                            <div class="group bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <i class="{{ $amenity->icon }} text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-lg">{{ $amenity->title }}</div>
                                        @if($amenity->subtitle)
                                            <div class="text-sm text-gray-600 mt-1">{{ $amenity->subtitle }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Facility Images -->
                <div class="space-y-6">
                    @php
                        $firstAccommodation = $accommodationSections->first();
                        $mainImage = $firstAccommodation?->main_image_url ?? 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop&crop=center';
                        $image1 = $firstAccommodation?->image_1_url ?? 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&h=300&fit=crop&crop=center';
                        $image2 = $firstAccommodation?->image_2_url ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=300&fit=crop&crop=center';
                    @endphp

                    <div class="relative group">
                        <img src="{{ $mainImage }}"
                             alt="Luxury villa interior"
                             class="w-full h-80 object-cover rounded-3xl shadow-2xl group-hover:shadow-3xl transition-shadow duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ $image1 }}"
                             alt="Villa exterior"
                             class="w-full h-32 object-cover rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ $image2 }}"
                             alt="Villa bathroom"
                             class="w-full h-32 object-cover rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Commitments Section -->
    <section id="commitments" class="py-24 lg:py-32 bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-900 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <div class="inline-block">
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                        Our Commitments
                    </h2>
                    <div class="w-24 h-1 bg-emerald-400 mx-auto mb-6"></div>
                </div>
                <h3 class="font-display text-2xl md:text-3xl text-emerald-200 mb-6">
                    For sustainable and respectful tourism
                </h3>
                <p class="text-lg text-emerald-100 max-w-3xl mx-auto leading-relaxed">
                    Pioneering eco-tourism practices that protect our environment while creating unforgettable experiences
                </p>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20 items-center">
                <!-- Text Content -->
                <div class="space-y-8">
                    <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20">
                        <h4 class="text-2xl font-bold text-white mb-6">Eco-Tourism Innovation</h4>
                        <p class="text-lg text-emerald-100 leading-relaxed">
                            From the outset, Saadani Kasa Bay was designed to incorporate the most innovative eco-tourism practices,
                            ensuring our paradise remains pristine for future generations.
                        </p>
                    </div>

                    <!-- Commitments List -->
                    <div class="space-y-4">
                        @foreach($commitments as $commitment)
                            <div class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 hover:-translate-y-1 transition-all duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <i class="{{ $commitment->icon }} text-emerald-900 text-lg font-bold"></i>
                                    </div>
                                    <div class="flex-1">
                                        <span class="text-white font-semibold text-lg leading-relaxed">{{ $commitment->title }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Image with Badge -->
                <div class="relative">
                    <div class="relative group">
                        <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=600&h=800&fit=crop&crop=center"
                             alt="Sustainable tourism"
                             class="w-full h-96 object-cover rounded-3xl shadow-2xl group-hover:shadow-3xl transition-shadow duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/30 to-transparent rounded-3xl"></div>
                    </div>

                    <!-- Certification Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl p-4 shadow-2xl border-4 border-emerald-400">
                        <div class="text-center">
                            <i class="fas fa-leaf text-emerald-600 text-2xl mb-2"></i>
                            <div class="text-emerald-800 font-bold text-sm">ECO</div>
                            <div class="text-emerald-600 font-semibold text-xs">CERTIFIED</div>
                        </div>
                    </div>

                    <!-- Floating Stats -->
                    <div class="absolute top-6 -left-6 bg-emerald-400 text-emerald-900 rounded-2xl p-4 shadow-xl">
                        <div class="text-center">
                            <div class="text-2xl font-bold">100%</div>
                            <div class="text-xs font-semibold">Solar Power</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-24 lg:py-32 bg-gradient-to-br from-gray-50 to-amber-50/20">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <div class="inline-block">
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-amber-800 mb-6">
                        Photo Gallery
                    </h2>
                    <div class="w-24 h-1 bg-amber-600 mx-auto mb-6"></div>
                </div>
                <h3 class="font-display text-2xl md:text-3xl text-amber-600 mb-6">
                    {{ $settings['site_name'] ?? 'Cterra Saadani Luxury' }} in pictures
                </h3>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Discover our photo gallery. Stunning images of {{ $settings['site_name'] ?? 'Saadani Kasa Bay' }}'s beauty, a unique and immersive experience awaits you at {{ $settings['site_name'] ?? 'Saadani Kasa Bay' }}.
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
                @foreach($galleryImages as $image)
                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 bg-white">
                        <img src="{{ $image->thumbnail_url }}"
                             alt="{{ $image->alt_text ?: $image->title }}"
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700 cursor-pointer"
                             onclick="openLightbox('{{ $image->image_url }}', '{{ $image->title }}')">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <div class="text-center text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <i class="fas fa-expand text-2xl mb-2"></i>
                                <p class="text-sm font-semibold">View Full Size</p>
                            </div>
                        </div>
                        <!-- Image title overlay -->
                        @if($image->title)
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-white text-sm font-semibold">{{ $image->title }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($galleryImages->count() === 0)
                <div class="text-center py-20">
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-12 shadow-lg border border-white/50 max-w-md mx-auto">
                        <i class="fas fa-images text-amber-300 text-6xl mb-6"></i>
                        <h4 class="text-xl font-bold text-amber-800 mb-4">Gallery Coming Soon</h4>
                        <p class="text-gray-600">Beautiful images of {{ $settings['site_name'] ?? 'Saadani Kasa Bay' }} will be displayed here once uploaded.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 lg:py-32 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-800 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><path d="M50 50l25-25v50l-25-25zm0 0l-25 25h50l-25-25z"/></g></svg>');"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <div class="inline-block">
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                        Contact Us
                    </h2>
                    <div class="w-24 h-1 bg-amber-400 mx-auto mb-6"></div>
                </div>
                <h3 class="font-display text-2xl md:text-3xl text-amber-200 mb-6">
                    Plan your perfect getaway
                </h3>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Ready to experience paradise? Get in touch with us to plan your unforgettable stay at {{ $settings['site_name'] ?? 'Saadani Kasa Bay' }}.
                </p>
            </div>

            <!-- Contact Content -->
            <div class="max-w-4xl mx-auto">
                <!-- Logo -->
                <div class="text-center mb-16">
                    <div class="inline-block bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20">
                        @if(isset($settings['site_logo']) && $settings['site_logo'])
                            <div class="flex items-center justify-center">
                                <img src="{{ asset('storage/' . $settings['site_logo']) }}"
                                     alt="{{ $settings['site_name'] ?? 'Logo' }}"
                                     class="h-24 w-auto drop-shadow-2xl">
                            </div>
                        @else
                            <!-- Custom Default Logo -->
                            <div class="flex items-center justify-center">
                                <svg width="280" height="100" viewBox="0 0 280 100" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-2xl">
                                <!-- Background Circle -->
                                <circle cx="50" cy="50" r="45" fill="url(#logoGradient)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>

                                <!-- Palm Tree -->
                                <g transform="translate(35, 25)">
                                    <!-- Trunk -->
                                    <path d="M15 45 Q16 35 14 25 Q15 15 16 5" stroke="#8B4513" stroke-width="3" fill="none" stroke-linecap="round"/>
                                    <!-- Palm Fronds -->
                                    <path d="M16 8 Q10 2 5 5 Q8 10 16 8" fill="#10B981" opacity="0.9"/>
                                    <path d="M16 8 Q22 2 27 5 Q24 10 16 8" fill="#059669" opacity="0.9"/>
                                    <path d="M16 8 Q12 0 8 -2 Q14 4 16 8" fill="#10B981" opacity="0.8"/>
                                    <path d="M16 8 Q20 0 24 -2 Q18 4 16 8" fill="#059669" opacity="0.8"/>
                                </g>

                                <!-- Ocean Waves -->
                                <path d="M5 65 Q15 60 25 65 Q35 70 45 65 Q55 60 65 65 Q75 70 85 65 Q95 60 105 65"
                                      stroke="rgba(16, 185, 129, 0.6)" stroke-width="2" fill="none"/>
                                <path d="M5 70 Q15 65 25 70 Q35 75 45 70 Q55 65 65 70 Q75 75 85 70 Q95 65 105 70"
                                      stroke="rgba(16, 185, 129, 0.4)" stroke-width="2" fill="none"/>

                                <!-- Sun -->
                                <circle cx="75" cy="25" r="8" fill="#FCD34D" opacity="0.9"/>
                                <g transform="translate(75, 25)">
                                    <path d="M0 -15 L0 -12" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                    <path d="M10.6 -10.6 L8.5 -8.5" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                    <path d="M15 0 L12 0" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                    <path d="M10.6 10.6 L8.5 8.5" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                    <path d="M0 15 L0 12" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                    <path d="M-10.6 10.6 L-8.5 8.5" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                    <path d="M-15 0 L-12 0" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                    <path d="M-10.6 -10.6 L-8.5 -8.5" stroke="#FCD34D" stroke-width="1.5" opacity="0.7"/>
                                </g>

                                <!-- Text -->
                                <text x="110" y="35" font-family="serif" font-size="24" font-weight="bold" fill="white" class="drop-shadow-lg">
                                    {{ strtoupper($settings['site_name'] ?? 'SAADANI') }}
                                </text>
                                <text x="110" y="55" font-family="serif" font-size="16" font-weight="300" fill="rgba(255,255,255,0.9)">
                                    {{ strtoupper(isset($settings['site_tagline']) ? $settings['site_tagline'] : 'KASA BAY') }}
                                </text>
                                <text x="110" y="75" font-family="sans-serif" font-size="10" font-weight="400" fill="rgba(16, 185, 129, 0.8)" letter-spacing="2px">
                                    ECO LUXURY LODGE
                                </text>

                                <!-- Gradient Definitions -->
                                <defs>
                                    <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:rgba(16, 185, 129, 0.3);stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:rgba(5, 150, 105, 0.5);stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Email -->
                    <div class="group bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20 hover:bg-white/20 hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-envelope text-amber-900 text-xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Email Us</h4>
                        <p class="text-amber-200 text-sm mb-4">Information & reservations</p>
                        <a href="mailto:{{ $settings['contact_email'] }}" class="text-amber-300 hover:text-amber-100 transition-colors duration-200 text-lg font-semibold break-all">
                            {{ $settings['contact_email'] }}
                        </a>
                    </div>

                    <!-- Phone -->
                    <div class="group bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20 hover:bg-white/20 hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-phone text-amber-900 text-xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Call Us</h4>
                        <p class="text-amber-200 text-sm mb-4">Direct telephone line</p>
                        <a href="tel:{{ str_replace(' ', '', $settings['contact_phone']) }}" class="text-amber-300 hover:text-amber-100 transition-colors duration-200 text-lg font-semibold">
                            {{ $settings['contact_phone'] }}
                        </a>
                    </div>

                    <!-- Location -->
                    @if($settings['contact_address'])
                        <div class="group bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20 hover:bg-white/20 hover:-translate-y-2 transition-all duration-300 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-map-marker-alt text-amber-900 text-xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-white mb-3">Visit Us</h4>
                            <p class="text-amber-200 text-sm mb-4">Our location</p>
                            <p class="text-amber-300 text-lg font-semibold">{{ $settings['contact_address'] }}</p>
                        </div>
                    @endif
                </div>

                <!-- CTA Section -->
                <div class="text-center mt-16">
                    <div class="bg-amber-600/20 backdrop-blur-sm rounded-3xl p-8 border border-amber-400/30">
                        <h4 class="text-2xl font-bold text-white mb-4">Ready to Book Your Stay?</h4>
                        <p class="text-amber-100 mb-6">Contact us today to reserve your piece of paradise</p>
                        <a href="mailto:{{ $settings['contact_email'] }}" class="inline-flex items-center gap-3 bg-amber-500 hover:bg-amber-400 text-amber-900 px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-xl">
                            <i class="fas fa-paper-plane"></i>
                            Send Inquiry
                        </a>
                    </div>
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
