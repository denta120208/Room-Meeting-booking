<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Conference Room A',
                'description' => 'Large conference room with projector and whiteboard',
                'capacity' => 12,
                'amenities' => ['projector', 'whiteboard', 'video_conference', 'coffee_station'],
                'is_active' => true,
            ],
            [
                'name' => 'Meeting Room B',
                'description' => 'Medium-sized meeting room perfect for team meetings',
                'capacity' => 8,
                'amenities' => ['tv_screen', 'whiteboard', 'phone'],
                'is_active' => true,
            ],
            [
                'name' => 'Boardroom',
                'description' => 'Executive boardroom with premium furnishing',
                'capacity' => 16,
                'amenities' => ['projector', 'video_conference', 'premium_furniture', 'coffee_station'],
                'is_active' => true,
            ],
            [
                'name' => 'Small Meeting Room',
                'description' => 'Intimate space for small group discussions',
                'capacity' => 4,
                'amenities' => ['whiteboard', 'phone'],
                'is_active' => true,
            ],
            [
                'name' => 'Training Room',
                'description' => 'Large training room with multiple screens',
                'capacity' => 20,
                'amenities' => ['multiple_screens', 'projector', 'whiteboard', 'training_setup'],
                'is_active' => true,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}