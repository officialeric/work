<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Commitment;
use App\Models\GalleryImage;
use App\Models\Location;
use App\Models\HostingSection;
use App\Models\AccommodationSection;
use App\Models\RoomType;

class SaadaniController extends Controller
{
    /**
     * Display the Saadani Kasa Bay homepage.
     */
    public function index()
    {
        // Get website settings
        $settings = [
            'site_name' => WebsiteSetting::get('site_name', 'Saadani Kasa Bay'),
            'site_tagline' => WebsiteSetting::get('site_tagline', 'Luxury Eco-Lodge Tanzania'),
            'site_description' => WebsiteSetting::get('site_description', 'Discover Saadani Kasa Bay, a luxury eco-lodge facing the Indian Ocean in Tanzania. Experience pristine beaches, wildlife safaris, and sustainable tourism.'),
            'site_logo' => WebsiteSetting::get('site_logo', ''),
            'site_favicon' => WebsiteSetting::get('site_favicon', ''),
            'hero_title' => WebsiteSetting::get('hero_title', 'Saadani Kasa Bay'),
            'hero_subtitle' => WebsiteSetting::get('hero_subtitle', 'Facing the Indian Ocean'),
            'hero_description' => WebsiteSetting::get('hero_description', 'Where luxury meets untamed nature in Tanzania\'s most exclusive eco-lodge'),
            'hero_video' => WebsiteSetting::get('hero_video', ''),
            'hero_image' => WebsiteSetting::get('hero_image', ''),
            'contact_email' => WebsiteSetting::get('contact_email', 'contact@saadani-kasa-bay.com'),
            'contact_phone' => WebsiteSetting::get('contact_phone', '+255 787 620 611'),
            'contact_address' => WebsiteSetting::get('contact_address', 'Tanzania East • 5°52\'46″S / 38°49\'03″E'),
            'facebook_url' => WebsiteSetting::get('facebook_url', ''),
            'instagram_url' => WebsiteSetting::get('instagram_url', ''),
            'twitter_url' => WebsiteSetting::get('twitter_url', ''),
        ];

        // Get content from database
        $activities = Activity::active()->ordered()->get();
        $amenities = Amenity::active()->ordered()->get();
        $commitments = Commitment::active()->ordered()->get();
        $galleryImages = GalleryImage::active()->ordered()->take(12)->get();
        $locations = Location::active()->ordered()->get();
        $hostingSections = HostingSection::active()->ordered()->get();
        $accommodationSections = AccommodationSection::active()->ordered()->get();
        $roomTypes = RoomType::active()->ordered()->get();

        return view('saadani', compact('settings', 'activities', 'amenities', 'commitments', 'galleryImages', 'locations', 'hostingSections', 'accommodationSections', 'roomTypes'));
    }
}
