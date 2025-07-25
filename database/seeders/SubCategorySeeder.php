<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        // Optional: clear existing subcategories before seeding (useful for development)
        // DB::table('subcategories')->truncate();

        $data = [
            'Electronics & Gadgets' => ['Mobile Phones', 'Laptops', 'Headphones'],
            'Fashion & Apparel' => ['Men Clothing', 'Women Clothing', 'Footwear'],
            'Home & Living' => ['Kitchen Appliances', 'Home Decor', 'Bedding'],
            'Health & Personal Care' => ['Skincare', 'Haircare', 'Medical Devices'],
            'Grocery & Essentials' => ['Fruits & Vegetables', 'Beverages', 'Snacks'],
            'Books, Media & Stationery' => ['Books', 'Office Supplies', 'Magazines'],
            'Toys, Kids & Baby' => ['Baby Clothing', 'Toys', 'School Bags'],
            'Automotive & Tools' => ['Car Accessories', 'Bike Accessories', 'Tools'],
            'Sports & Outdoor' => ['Fitness Equipment', 'Sportswear', 'Camping Gear'],
            'Furniture & Décor' => ['Sofas', 'Tables', 'Wall Art'],
        ];

        foreach ($data as $categoryName => $subcategories) {
            $category = Category::where('name', $categoryName)->first();

            if ($category) {
                foreach ($subcategories as $subName) {
                    $slug = Str::slug($subName);
                    Subcategory::updateOrInsert(
                        ['slug' => $slug],
                        [
                            'category_id' => $category->id,
                            'name' => $subName,
                            'image' => 'https://via.placeholder.com/100x100?text=' . urlencode($subName),
                            'status' => true,
                            'updated_at' => now(),
                            'created_at' => now(),
                        ]
                    );
                }
            }
        }
    }
}
