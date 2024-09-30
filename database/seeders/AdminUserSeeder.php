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
                'name' => 'Kenan Samaan',
                'description' => 'Expert photographer',
                'images' => json_encode(['']),
                'videos' => json_encode(['promo1.mp4']),
            ],
            [
                'user_id' => $user5->id,
                'type' => 'person',
                'roles' => 'owner',
                'name' => 'MAZAHER',
                'description' => 'Resturant',
                'images' => json_encode(['restaurant1.jpg', 'restaurant2.jpg']),
                'videos' => json_encode(['restaurant_promo.mp4']),
            ],
            [
                'user_id' => $user6->id,
                'type' => 'website',
                'roles' => 'owner',
                'name' => 'Decoration',
                'description' => 'A trendy fashion descoration service.',
                'images' => json_encode(['boutique1.jpg', 'boutique2.jpg']),
                'videos' => json_encode(['fashion_show.mp4']),
            ],
            [
                'user_id' => $user7->id,
                'type' => 'website',
                'roles' => 'owner',
                'name' => 'Beauty Care',
                'description' => 'Professional care treatments for all  types.',
                'images' => json_encode(['clinic1.jpg', 'clinic2.jpg']),
                'videos' => json_encode(['clinic_promo.mp4']),
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }

    }
}
