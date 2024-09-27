<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@event.com',
            'password' => bcrypt('password'), // Replace with a secure password
            // ... other user attributes ...
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'moderator',
            'email' => 'moderator@event.com',
            'password' => bcrypt('password'), // Replace with a secure password
            // ... other user attributes ...
        ]);
        $user->assignRole('moderator');


        $user = User::create([
            'name' => 'user',
            'email' => 'user@event.com',
            'password' => bcrypt('password'), // Replace with a secure password
            // ... other user attributes ...
        ]);
        $user->assignRole('user');

        $user4 = User::create([
            'name' => 'company',
            'email' => 'company@event.com',
            'password' => bcrypt('password'), // Replace with a secure password
            // ... other user attributes ...
        ]);
        $user4->assignRole('company');


        $user5 = User::create([
            'name' => 'company2',
            'email' => 'company2@event.com',
            'password' => bcrypt('password'), // Replace with a secure password
            // ... other user attributes ...
        ]);
        $user5->assignRole('company');

        $user6 = User::create([
            'name' => 'company3',
            'email' => 'company3@event.com',
            'password' => bcrypt('password'), // Replace with a secure password
            // ... other user attributes ...
        ]);
        $user6->assignRole('company');

        $user7 = User::create([
            'name' => 'company4',
            'email' => 'company4@event.com',
            'password' => bcrypt('password'), // Replace with a secure password
            // ... other user attributes ...
        ]);
        $user7->assignRole('company');

        $companies = [
            [
                'user_id' => $user4->id,
                'type' => 'person',
                'roles' => 'owner',
                'name' => 'Elegant Hair Salon',
                'description' => 'A luxury hair salon offering haircuts, coloring, and treatments.',
                'images' => json_encode(['hair_salon1.jpg', 'hair_salon2.jpg']),
                'videos' => json_encode(['promo1.mp4']),
            ],
            [
                'user_id' => $user5->id,
                'type' => 'website',
                'roles' => 'admin',
                'name' => 'Fine Dining Restaurant',
                'description' => 'A premium dining experience with international cuisine.',
                'images' => json_encode(['restaurant1.jpg', 'restaurant2.jpg']),
                'videos' => json_encode(['restaurant_promo.mp4']),
            ],
            [
                'user_id' => $user6->id,
                'type' => 'person',
                'roles' => 'owner',
                'name' => 'Fashion Boutique',
                'description' => 'A trendy fashion boutique with the latest clothing styles.',
                'images' => json_encode(['boutique1.jpg', 'boutique2.jpg']),
                'videos' => json_encode(['fashion_show.mp4']),
            ],
            [
                'user_id' => $user7->id,
                'type' => 'website',
                'roles' => 'admin',
                'name' => 'Skin Care Clinic',
                'description' => 'Professional skin care treatments for all skin types.',
                'images' => json_encode(['clinic1.jpg', 'clinic2.jpg']),
                'videos' => json_encode(['clinic_promo.mp4']),
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }

    }
}
