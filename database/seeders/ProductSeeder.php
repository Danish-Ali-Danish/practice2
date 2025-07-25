<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $productsPerSubcategory = 10;  // Create 10 products per subcategory

        $subcategories = Subcategory::with('brands')->get();

        foreach ($subcategories as $subcategory) {
            $brands = Brand::where('subcategory_id', $subcategory->id)->get();

            if ($brands->isEmpty()) {
                continue;  // skip if no brands for this subcategory
            }

            for ($i = 0; $i < $productsPerSubcategory; $i++) {
                $brand = $brands->random();
                $productName = $this->generateProductName($subcategory->name, $brand->name);

                Product::create([
                    'subcategory_id' => $subcategory->id,
                    'brand_id' => $brand->id,
                    'name' => $productName,
                    'slug' => Str::slug($productName) . '-' . Str::random(5),
                    'price' => $faker->numberBetween(500, 100000),
                    'stock' => $faker->numberBetween(0, 500),
                    'short_description' => $faker->sentence(10),
                    'long_description' => $faker->paragraph(4),
                    'rating' => $faker->numberBetween(1, 5),
                    'image' => null,
                    'status' => true,
                ]);
            }
        }
    }

    private function generateProductName($subcategory, $brand)
    {
        $examples = [
            'Mobile Phones' => ['Pro Max', 'Ultra 5G', 'Note 20', 'Mini', 'Edge'],
            'Laptops' => ['Book Pro', 'Air 15', 'X1 Carbon', 'Gaming Beast'],
            'Footwear' => ['Sneakers', 'Running Shoes', 'Loafers'],
            'Skincare' => ['Hydrating Gel', 'Glow Serum', 'Face Wash'],
            'Tools' => ['Power Drill', 'Wrench Kit', 'Socket Set'],
            'Kitchen Appliances' => ['Blender', 'Toaster', 'Coffee Maker'],
        ];

        $suffixes = $examples[$subcategory] ?? ['Premium', 'Elite', 'Advance', 'Classic'];
        return $brand . ' ' . $faker = $suffixes[array_rand($suffixes)];
    }
}
