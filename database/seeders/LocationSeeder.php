<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::updateOrCreate(
            ['title' => 'Location'],
            [
                'subtitle' => 'A breathtaking setting',
                'description' => '100 km north of Dar es Salaam, facing the island of Zanzibar, discover Saadani Kasa Bay. Nestled between a pristine white sand beach and the infinite blue of the Indian Ocean, this unique lodge offers an idyllic setting where luxury meets untamed nature.',
                'additional_description' => 'On the land side, Saadani National Park reveals a mosaic of fascinating landscapes and exceptional wildlife, perfect for unforgettable safaris. Every moment spent here is a promise of experiences rich in emotion and authenticity, a unique adventure in the heart of Tanzania.',
                'image_1' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=800&fit=crop&crop=center',
                'image_2' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center',
                'image_3' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=300&fit=crop&crop=center',
                'button_text' => 'View Gallery',
                'button_link' => '#gallery',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );
    }
}
