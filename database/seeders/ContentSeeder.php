<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Commitment;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Activities
        $activities = [
            [
                'title' => 'Madete Beach',
                'description' => 'Enjoy **Madete Beach**, an exceptional protected sanctuary. Both a national park and a marine park, accessible only to authorized visitors, this stretch of white sand stretches for 5 km around the lodge, offering bathing at any time, with very little tidal variation.',
                'number' => '1/7',
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&h=400&fit=crop&crop=center',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Safari in Saadani National Park',
                'description' => 'Go on **safari in Saadani National Park**, where remarkable wildlife awaits you: a dozen species of antelope, monkeys, warthogs, majestic elephants, elegant giraffes, imposing buffalo, and even lions on the loose.',
                'number' => '2/7',
                'image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=600&h=400&fit=crop&crop=center',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Wami River Boat Trip',
                'description' => 'Take a boat trip **up the Wami River** to observe crocodiles, hippos and a rich diversity of birds. A magical moment on the water, in the heart of the wilderness.',
                'number' => '3/7',
                'image' => 'https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=600&h=400&fit=crop&crop=center',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Fishing Villages',
                'description' => 'Discover local life by visiting **fishing villages**. Live an authentic experience by embarking with them for a traditional fishing session in the waters of the Indian Ocean.',
                'number' => '4/7',
                'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&h=400&fit=crop&crop=center',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Mafui Sandbank',
                'description' => '**Sail to Mafui Sandbank**, a secluded sandbar just 5 km from the beach. This idyllic spot is a small paradise for divers and snorkelers, surrounded by crystal-clear waters.',
                'number' => '5/7',
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=400&fit=crop&crop=center',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Sunset Cruise',
                'description' => 'Enjoy a **sunset cruise**, a sea excursion to admire the golden hues of the sunset.',
                'number' => '6/7',
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop&crop=center',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Explore the Mangroves',
                'description' => '**Explore the mangroves** on foot along the beach or by gallawas, the traditional boats of the Tanzanian coast.',
                'number' => '7/7',
                'image' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=600&h=400&fit=crop&crop=center',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($activities as $activity) {
            Activity::updateOrCreate(
                ['title' => $activity['title']],
                $activity
            );
        }

        // Seed Amenities
        $amenities = [
            ['title' => '12 luxury rooms', 'subtitle' => 'Bathroom, toilet, terrace', 'icon' => 'fas fa-bed', 'sort_order' => 1],
            ['title' => 'Sleeps up to 4', 'subtitle' => '', 'icon' => 'fas fa-users', 'sort_order' => 2],
            ['title' => 'Restaurant', 'subtitle' => '', 'icon' => 'fas fa-utensils', 'sort_order' => 3],
            ['title' => 'Bar', 'subtitle' => '', 'icon' => 'fas fa-cocktail', 'sort_order' => 4],
            ['title' => 'Pool', 'subtitle' => '', 'icon' => 'fas fa-swimming-pool', 'sort_order' => 5],
            ['title' => 'Security agents', 'subtitle' => '', 'icon' => 'fas fa-shield-alt', 'sort_order' => 6],
            ['title' => 'Electricity 24/24', 'subtitle' => '', 'icon' => 'fas fa-bolt', 'sort_order' => 7],
            ['title' => 'Wifi', 'subtitle' => '', 'icon' => 'fas fa-wifi', 'sort_order' => 8],
        ];

        foreach ($amenities as $amenity) {
            Amenity::updateOrCreate(
                ['title' => $amenity['title']],
                $amenity
            );
        }

        // Seed Commitments
        $commitments = [
            ['title' => 'Solar-powered electricity', 'icon' => 'fas fa-solar-panel', 'sort_order' => 1],
            ['title' => 'Rainwater harvesting to cover most of the lodge\'s needs', 'icon' => 'fas fa-tint', 'sort_order' => 2],
            ['title' => 'A zero-plastic approach', 'icon' => 'fas fa-leaf', 'sort_order' => 3],
            ['title' => 'Construction and furnishings made from local materials', 'icon' => 'fas fa-hammer', 'sort_order' => 4],
            ['title' => 'Safaris in electric vehicles (100% retrofitted, 100% electric, 100% solar)', 'icon' => 'fas fa-car-battery', 'sort_order' => 5],
            ['title' => 'Filtered drinking water', 'icon' => 'fas fa-filter', 'sort_order' => 6],
        ];

        foreach ($commitments as $commitment) {
            Commitment::updateOrCreate(
                ['title' => $commitment['title']],
                $commitment
            );
        }
    }
}
