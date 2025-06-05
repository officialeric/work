<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GalleryImage;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Note: Gallery images from SQL file reference non-existent files
        // Admin should upload new gallery images through the admin panel
        $galleryImages = [
            [
                'title' => 'Sample Gallery Image 1',
                'alt_text' => 'Beautiful lodge view',
                'image_path' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop&crop=center',
                'thumbnail_path' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=300&h=200&fit=crop&crop=center',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sample Gallery Image 2',
                'alt_text' => 'Ocean view from lodge',
                'image_path' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&h=600&fit=crop&crop=center',
                'thumbnail_path' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300&h=200&fit=crop&crop=center',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Sample Gallery Image 3',
                'alt_text' => 'Safari wildlife experience',
                'image_path' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&h=600&fit=crop&crop=center',
                'thumbnail_path' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=300&h=200&fit=crop&crop=center',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Sample Gallery Image 4',
                'alt_text' => 'Luxury accommodation interior',
                'image_path' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=600&fit=crop&crop=center',
                'thumbnail_path' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=300&h=200&fit=crop&crop=center',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Sample Gallery Image 5',
                'alt_text' => 'Sunset over the ocean',
                'image_path' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                'thumbnail_path' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=300&h=200&fit=crop&crop=center',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Sample Gallery Image 6',
                'alt_text' => 'Beach and mangroves',
                'image_path' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=800&h=600&fit=crop&crop=center',
                'thumbnail_path' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=300&h=200&fit=crop&crop=center',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($galleryImages as $imageData) {
            GalleryImage::create($imageData);
        }
    }
}
