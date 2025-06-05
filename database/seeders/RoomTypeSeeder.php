<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            [
                'name' => 'DELUXE ROOM',
                'description' => 'Experience luxury in our Deluxe Room featuring a spacious big tent with premium amenities. Perfect for couples seeking an intimate and comfortable stay with stunning views and modern conveniences.',
                'price' => 800.00,
                'currency' => 'USD',
                'tent_type' => 'Big Tent',
                'tent_quantity' => 1,
                'max_occupancy' => 2,
                'features' => [
                    'Private bathroom with hot water',
                    'Air conditioning',
                    'Ocean view',
                    'King-size bed',
                    'Mini bar',
                    'Private terrace',
                    'WiFi access',
                    'Room service'
                ],
                'sort_order' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'DOUBLE ROOM',
                'description' => 'Our Double Room offers a unique experience with two small tents, ideal for friends or family members who prefer separate sleeping spaces while staying close together.',
                'price' => 500.00,
                'currency' => 'USD',
                'tent_type' => 'Small Tents',
                'tent_quantity' => 2,
                'max_occupancy' => 4,
                'features' => [
                    'Two separate small tents',
                    'Shared bathroom facilities',
                    'Fan cooling',
                    'Twin beds in each tent',
                    'Shared outdoor seating area',
                    'WiFi access',
                    'Daily housekeeping'
                ],
                'sort_order' => 2,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'FAMILY ROOM',
                'description' => 'Perfect for families, our Family Room features a large big tent with ample space for parents and children. Designed with comfort and convenience in mind for memorable family vacations.',
                'price' => 800.00,
                'currency' => 'USD',
                'tent_type' => 'Big Tent',
                'tent_quantity' => 1,
                'max_occupancy' => 4,
                'features' => [
                    'Spacious big tent',
                    'Family bathroom',
                    'Air conditioning',
                    'Multiple bed configurations',
                    'Children-friendly amenities',
                    'Private outdoor area',
                    'WiFi access',
                    'Complimentary breakfast',
                    'Baby cot available'
                ],
                'sort_order' => 3,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'SUITE ROOM',
                'description' => 'Indulge in our luxurious Suite Room with a premium big tent featuring separate living and sleeping areas. The ultimate in comfort and elegance for discerning guests.',
                'price' => 1000.00,
                'currency' => 'USD',
                'tent_type' => 'Big Tent',
                'tent_quantity' => 1,
                'max_occupancy' => 2,
                'features' => [
                    'Separate living area',
                    'Premium bathroom with bathtub',
                    'Climate control',
                    'King-size bed',
                    'Private bar',
                    'Panoramic views',
                    'Butler service',
                    'Premium WiFi',
                    'Complimentary spa access',
                    'Private dining area'
                ],
                'sort_order' => 4,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'TWIN ROOM',
                'description' => 'Our Twin Room offers a sophisticated big tent with twin bed configuration, perfect for business travelers or friends who prefer separate beds while sharing premium accommodations.',
                'price' => 1200.00,
                'currency' => 'USD',
                'tent_type' => 'Big Tent',
                'tent_quantity' => 1,
                'max_occupancy' => 2,
                'features' => [
                    'Twin beds',
                    'Premium bathroom',
                    'Air conditioning',
                    'Work desk',
                    'Mini bar',
                    'Garden view',
                    'High-speed WiFi',
                    'Daily newspaper',
                    'Laundry service',
                    'Room service'
                ],
                'sort_order' => 5,
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($roomTypes as $roomTypeData) {
            RoomType::updateOrCreate(
                ['name' => $roomTypeData['name']],
                $roomTypeData
            );
        }
    }
}
