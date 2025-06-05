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
        AccommodationSection::create([
            'title' => 'Luxury Accommodations',
            'description' => 'Saadani Kasa Bay offers 12 exceptional rooms, divided between 4 family villas and 8 elegantly appointed double villas. The family villas, each measuring a minimum of 25 m², include a living room, two separate bedrooms and a small office with comfortable armchairs.',
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }
}
