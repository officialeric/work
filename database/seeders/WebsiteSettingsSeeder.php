<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebsiteSetting;

class WebsiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'Saadani Kasa Bay',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of your website',
                'sort_order' => 1,
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Luxury Eco-Lodge Tanzania',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Tagline',
                'description' => 'A short description of your website',
                'sort_order' => 2,
            ],
            [
                'key' => 'site_description',
                'value' => 'Discover Saadani Kasa Bay, a luxury eco-lodge facing the Indian Ocean in Tanzania. Experience pristine beaches, wildlife safaris, and sustainable tourism.',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'A longer description for SEO purposes',
                'sort_order' => 3,
            ],
            [
                'key' => 'site_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'general',
                'label' => 'Site Logo',
                'description' => 'Upload your website logo',
                'sort_order' => 4,
            ],
            [
                'key' => 'favicon',
                'value' => '',
                'type' => 'image',
                'group' => 'general',
                'label' => 'Favicon',
                'description' => 'Upload your website favicon (16x16 or 32x32 pixels)',
                'sort_order' => 5,
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'contact@saadani-kasa-bay.com',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Main contact email address',
                'sort_order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+255 787 620 611',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Main contact phone number',
                'sort_order' => 2,
            ],
            [
                'key' => 'contact_address',
                'value' => 'Tanzania East • 5°52\'46″S / 38°49\'03″E',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Contact Address',
                'description' => 'Physical address or location',
                'sort_order' => 3,
            ],

            // Hero Section
            [
                'key' => 'hero_title',
                'value' => 'Saadani Kasa Bay',
                'type' => 'text',
                'group' => 'hero',
                'label' => 'Hero Title',
                'description' => 'Main title in the hero section',
                'sort_order' => 1,
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Facing the Indian Ocean',
                'type' => 'text',
                'group' => 'hero',
                'label' => 'Hero Subtitle',
                'description' => 'Subtitle in the hero section',
                'sort_order' => 2,
            ],
            [
                'key' => 'hero_description',
                'value' => 'Where luxury meets untamed nature in Tanzania\'s most exclusive eco-lodge',
                'type' => 'textarea',
                'group' => 'hero',
                'label' => 'Hero Description',
                'description' => 'Description text in the hero section',
                'sort_order' => 3,
            ],
            [
                'key' => 'hero_video',
                'value' => '',
                'type' => 'text',
                'group' => 'hero',
                'label' => 'Hero Video URL',
                'description' => 'URL for the hero background video',
                'sort_order' => 4,
            ],
            [
                'key' => 'hero_image',
                'value' => '',
                'type' => 'image',
                'group' => 'hero',
                'label' => 'Hero Background Image',
                'description' => 'Fallback image if video is not available',
                'sort_order' => 5,
            ],

            // SEO Settings
            [
                'key' => 'meta_keywords',
                'value' => 'luxury eco-lodge, Tanzania, safari, Indian Ocean, sustainable tourism, Saadani National Park',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Meta Keywords',
                'description' => 'SEO keywords separated by commas',
                'sort_order' => 1,
            ],
            [
                'key' => 'google_analytics',
                'value' => '',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Google Analytics Code',
                'description' => 'Google Analytics tracking code',
                'sort_order' => 2,
            ],

            // Social Media
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL',
                'sort_order' => 1,
            ],
            [
                'key' => 'instagram_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Instagram profile URL',
                'sort_order' => 2,
            ],
            [
                'key' => 'twitter_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Twitter profile URL',
                'sort_order' => 3,
            ],
        ];

        foreach ($settings as $setting) {
            WebsiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
