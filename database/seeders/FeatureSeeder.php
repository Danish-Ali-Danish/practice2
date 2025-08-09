<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('features')->insert([
            [
                'icon' => 'fa-solid fa-truck-fast',
                'title' => 'Free Shipping',
                'description' => 'Enjoy free delivery on all orders over $50, with fast and secure shipping options.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'fa-solid fa-headset',
                'title' => '24/7 Customer Support',
                'description' => 'Our friendly support team is available around the clock to assist you with any issues or questions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'fa-solid fa-lock',
                'title' => 'Secure Payment',
                'description' => 'All payments are processed with advanced encryption and fraud protection for your safety.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'fa-solid fa-rotate-left',
                'title' => 'Easy Returns',
                'description' => 'Not satisfied? Return products easily within 14 days with our no-hassle return policy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon' => 'fa-solid fa-tags',
                'title' => 'Best Deals',
                'description' => 'Find the best offers and exclusive discounts on your favorite brands every day.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
