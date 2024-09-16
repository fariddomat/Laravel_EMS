<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'منازل',
                'img' => 'houses.jpg',
                'description' => 'مجموعة واسعة من المنازل المتاحة للبيع والإيجار.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'شقق',
                'img' => 'apartments.jpg',
                'description' => 'شقق بمساحات مختلفة ومواقع متعددة تناسب جميع الاحتياجات.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'فلل',
                'img' => 'villas.jpg',
                'description' => 'فلل فاخرة مع جميع وسائل الراحة والمرافق الحديثة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'مكاتب',
                'img' => 'offices.jpg',
                'description' => 'مكاتب حديثة ومجهزة بالكامل تناسب الأعمال والشركات.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'محلات تجارية',
                'img' => 'shops.jpg',
                'description' => 'محلات تجارية في مواقع استراتيجية لنجاح عملك.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
