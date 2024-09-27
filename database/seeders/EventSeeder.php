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


        for ($i = 0; $i < 100; $i++) {
            Event::create([
                'company_id'   => $faker->numberBetween(1, 4), // Assuming you have companies seeded already
                'name'         => ucfirst($faker->words(3, true)),
                'description'  => $faker->sentence(10),
                'price'        => $faker->randomFloat(2, 50, 5000), // Random price between 50 and 5000
                'images'       => json_encode([$faker->imageUrl(640, 480, 'event', true)]), // Random event image
                'videos'       => json_encode([$faker->url()]), // Random video URL
                'category'     => $faker->randomElement($categories),
                'status'       => 'accepted',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
