<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the related categories
        $relatedCategories = [
            'salon' => ['makeup', 'hair care', 'nail art', 'skin care', 'spa services'],
            'restaurant' => ['food delivery', 'catering', 'event planning', 'dining experiences'],
            'skin care' => ['makeup', 'spa', 'wellness', 'facials', 'beauty treatments'],
            'makeup' => ['skin care', 'beauty products', 'cosmetics', 'makeup classes', 'bridal makeup'],
            'clothes' => ['accessories', 'shoes', 'fashion', 'styling services', 'personal shopping'],
            'photography' => ['videography', 'photo booth', 'event coverage', 'family portraits', 'wedding photography'],
            'fitness' => ['yoga', 'nutrition', 'personal training', 'fitness classes', 'wellness retreats'],
            'wellness' => ['spa', 'meditation', 'aromatherapy', 'holistic therapies', 'nutrition coaching'],
            'accessories' => ['jewelry', 'bags', 'hats', 'fashion accessories', 'footwear'],
            'catering' => ['event planning', 'restaurant', 'bakery', 'food tasting', 'cooking classes'],
            'entertainment' => ['catering', 'venues', 'decor', 'party supplies'],
            'baking' => ['cooking classes', 'catering', 'dessert bars', 'baking supplies', 'cake decorating'],
            'music' => ['concerts', 'live performances', 'music lessons', 'DJ services', 'karaoke nights'],
            'art' => ['exhibitions', 'workshops', 'craft fairs', 'art supplies', 'art classes'],
            'floral' => ['event decor', 'wedding planning', 'gifts', 'floral arrangements', 'bouquets'],
            'travel' => ['tours', 'hotel bookings', 'travel packages', 'local experiences', 'adventure trips'],
            'technology' => ['IT services', 'software development', 'tech workshops', 'digital marketing', 'gadgets'],
            'education' => ['tutoring', 'online courses', 'workshops', 'educational materials', 'study groups'],
            'home services' => ['cleaning', 'landscaping', 'renovation', 'interior design', 'handyman services'],
        ];

        // Extract main categories and related categories
        $categories = array_keys($relatedCategories);
        $relatedValues = [];

        foreach ($relatedCategories as $main => $related) {
            foreach ($related as $item) {
                $relatedValues[] = $item; // Collect related categories
            }
        }

        // Combine unique categories and sort them alphabetically
        $allCategories = array_unique(array_merge($categories, $relatedValues));
        sort($allCategories);

        // Insert categories into the database
        foreach ($allCategories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
