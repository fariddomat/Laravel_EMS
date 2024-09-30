<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Event categories
        $categories = Category::pluck('name')->toArray();

        // Define companies and their related events
        $companyEvents = [
            1 => [ // Kenan Samman (Photography, Video, Promo)
                'eventNames' => ['Wedding Photography', 'Corporate Video Shoot', 'Promo Shoot'],
                'descriptions' => ['Professional wedding photography services.', 'High-quality corporate video production.', 'Creative promo shoot services for businesses.'],
                'categories' => ['photography', 'photography', 'photography'],
            ],
            2 => [ // MAZAHER (Restaurant, Parties)
                'eventNames' => ['Gala Dinner', 'Birthday Party', 'Catering Service'],
                'descriptions' => ['A premium gala dinner event.', 'Fun-filled birthday party service.', 'Professional catering services for events.'],
                'categories' => ['restaurant', 'restaurant', 'restaurant'],
            ],
            3 => [ // Decoration (Lighting, Decorations)
                'eventNames' => ['Wedding Decoration', 'Corporate Event Lighting', 'Stage Setup'],
                'descriptions' => ['Elegant wedding decoration service.', 'Professional lighting for corporate events.', 'Complete stage setup for special events.'],
                'categories' => ['accessories', 'accessories', 'accessories'],
            ],
            4 => [ // Salon (Makeup, Man Care, Women Care)
                'eventNames' => ['Bridal Makeup', 'Men Grooming Package', 'Women Skin Care Treatment'],
                'descriptions' => ['Bridal makeup for the special day.', 'Complete grooming package for men.', 'Advanced skin care treatment for women.'],
                'categories' => ['salon', 'makeup', 'skin care'],
            ]
        ];

        // Seed events for each company
        foreach ($companyEvents as $companyId => $events) {
            for ($i = 0; $i < count($events['eventNames']); $i++) {
                Event::create([
                    'company_id'   => $companyId,
                    'name'         => $events['eventNames'][$i],
                    'description'  => $events['descriptions'][$i],
                    'price'        => $faker->randomFloat(2, 50, 5000), // Random price between 50 and 5000
                    'images'       => json_encode([$faker->imageUrl(640, 480, 'event', true)]), // Random event image
                    'videos'       => json_encode([$faker->url()]), // Random video URL
                    'category'     => $events['categories'][$i],
                    'status'       => 'accepted',
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}
