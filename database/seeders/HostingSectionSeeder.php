<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HostingSection;

class HostingSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostingSection::updateOrCreate(
            ['title' => 'Hosting'],
            [
                'subtitle' => 'Escape & Serenity',
                'description' => 'A blend of refined comfort and authenticity, Saadani Kasa Bay invites you to enjoy a unique experience, combining discovery, tranquillity and wonder. A timeless escape to the essential, a view of the ocean from your room as a call to serenity, and a breathtakingly beautiful natural setting to enhance your stay.',
                'video_button_text' => 'Watch Experience Video',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Placeholder URL
                'background_image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1200&h=800&fit=crop&crop=center',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );
    }
}
