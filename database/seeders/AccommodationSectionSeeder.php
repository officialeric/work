<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccommodationSection;

class AccommodationSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccommodationSection::updateOrCreate(
            ['title' => 'Luxury Accommodations'],
            [
                'description' => 'We offers 12 exceptional rooms, divided between 4 family villas and 8 elegantly appointed double villas. The family villas, each measuring a minimum of 25 m², include a living room, two separate bedrooms and a small office with comfortable armchairs.',
                'main_image' => null, // Admin can upload new images
                'image_1' => null,
                'image_2' => null,
                'sort_order' => 1,
                'is_active' => true,
            ]
        );
    }
}
