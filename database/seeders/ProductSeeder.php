<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Define some real products with actual names and attributes
        $products = [
            [
                'name' => 'Mobile Phone',
                'slug' => 'mobile-phone',
                'brand' => 'IKEA',
                'subcategory' => 'Electronics & Gadgets',
                'price' => 199.99,
                'description' => 'A feature-packed mobile phone with excellent camera quality.',
                'is_featured' => true,
                'is_trending' => false,
            ],
            [
                'name' => 'Laptop',
                'slug' => 'laptop',
                'brand' => 'Ashley Furniture',
                'subcategory' => 'Electronics & Gadgets',
                'price' => 999.99,
                'description' => 'High-performance laptop with a sleek design.',
                'is_featured' => false,
                'is_trending' => true,
            ],
            [
                'name' => 'Headphones',
                'slug' => 'headphones',
                'brand' => 'LEGO',
                'subcategory' => 'Electronics & Gadgets',
                'price' => 59.99,
                'description' => 'Wireless headphones with noise-cancellation feature.',
                'is_featured' => false,
                'is_trending' => false,
            ],
            [
                'name' => "Men's Shirt",
                'slug' => 'mens-shirt',
                'brand' => 'Mattel',
                'subcategory' => 'Fashion & Apparel',
                'price' => 49.99,
                'description' => 'Comfortable cotton shirt for men, perfect for casual wear.',
                'is_featured' => true,
                'is_trending' => false,
            ],
            [
                'name' => "Women's Dress",
                'slug' => 'womens-dress',
                'brand' => 'Hasbro',
                'subcategory' => 'Fashion & Apparel',
                'price' => 79.99,
                'description' => 'Elegant dress for women, ideal for formal occasions.',
                'is_featured' => false,
                'is_trending' => true,
            ],
            [
                'name' => 'Kitchen Blender',
                'slug' => 'kitchen-blender',
                'brand' => 'Penguin',
                'subcategory' => 'Home & Living',
                'price' => 49.99,
                'description' => 'A high-performance kitchen blender with multiple speed settings.',
                'is_featured' => true,
                'is_trending' => false,
            ],
            [
                'name' => 'Bedding Set',
                'slug' => 'bedding-set',
                'brand' => 'HarperCollins',
                'subcategory' => 'Home & Living',
                'price' => 79.99,
                'description' => 'Premium bedding set made from soft cotton.',
                'is_featured' => false,
                'is_trending' => false,
            ],
            [
                'name' => 'Skincare Set',
                'slug' => 'skincare-set',
                'brand' => 'Neutrogena',
                'subcategory' => 'Health & Personal Care',
                'price' => 129.99,
                'description' => 'Complete skincare set for glowing skin.',
                'is_featured' => true,
                'is_trending' => false,
            ],
            [
                'name' => 'Car Seat Cover',
                'slug' => 'car-seat-cover',
                'brand' => 'Philips',
                'subcategory' => 'Automotive & Tools',
                'price' => 59.99,
                'description' => 'Protect your car seats with this durable and stylish cover.',
                'is_featured' => false,
                'is_trending' => false,
            ],
            [
                'name' => 'Camping Tent',
                'slug' => 'camping-tent',
                'brand' => 'Quechua',
                'subcategory' => 'Sports & Outdoor',
                'price' => 199.99,
                'description' => 'Durable camping tent that provides excellent shelter in the outdoors.',
                'is_featured' => false,
                'is_trending' => true,
            ],
        ];

        foreach ($products as $product) {
            // Fetch the corresponding brand and subcategory using the names
            $brand = Brand::where('name', $product['brand'])->first();
            $subcategory = Subcategory::where('name', $product['subcategory'])->first();

            // Create the product
            Product::create([
                'name' => $product['name'],
                'slug' => $product['slug'],
                'brand_id' => $brand->id ?? null,  // Avoid errors if brand is not found
                'subcategory_id' => $subcategory->id ?? null,  // Avoid errors if subcategory is not found
                'price' => $product['price'],
                'main_image' => null,  // No image specified
                'description' => $product['description'],
                'is_featured' => $product['is_featured'],
                'is_trending' => $product['is_trending'],
            ]);
        }
    }
}
