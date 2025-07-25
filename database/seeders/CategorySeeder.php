<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics & Gadgets', 'image' => ''],
            ['name' => 'Fashion & Apparel', 'image' => ''],
            ['name' => 'Home & Living', 'image' => ''],
            ['name' => 'Health & Personal Care', 'image' => ''],
            ['name' => 'Grocery & Essentials', 'image' => ''],
            ['name' => 'Books, Media & Stationery', 'image' => ''],
            ['name' => 'Toys, Kids & Baby', 'image' => ''],
            ['name' => 'Automotive & Tools', 'image' => ''],
            ['name' => 'Sports & Outdoor', 'image' => ''],
            ['name' => 'Furniture & Décor', 'image' => ''],
        ];

        foreach ($categories as $category) {
            Category::updateOrInsert(
                ['name' => $category['name']],  // unique condition
                ['file_path' => $category['image']]  // fields to update or insert
            );
        }
    }
}
