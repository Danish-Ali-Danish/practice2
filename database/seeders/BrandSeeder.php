<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brandData = [
            'Android Phones' => ['Samsung', 'OnePlus', 'Xiaomi'],
            'iPhones' => ['Apple'],
            'Gaming Phones' => ['ASUS ROG', 'RedMagic', 'Black Shark'],
            'Refurbished Phones' => ['Gazelle', 'Back Market'],
            'Flagship Phones' => ['Samsung', 'Google', 'Apple'],
            'Gaming Laptops' => ['Alienware', 'MSI', 'ASUS ROG'],
            'Ultrabooks' => ['Dell XPS', 'HP Spectre', 'Lenovo Yoga'],
            'Business Laptops' => ['Lenovo ThinkPad', 'HP EliteBook'],
            '2‑in‑1 Laptops' => ['Microsoft Surface', 'Lenovo Flex'],
            'MacBooks' => ['Apple'],
            'DSLR Cameras' => ['Canon', 'Nikon'],
            'Mirrorless Cameras' => ['Sony', 'Fujifilm', 'Panasonic'],
            'Action Cameras' => ['GoPro', 'DJI'],
            'Instant Cameras' => ['Fujifilm Instax', 'Polaroid'],
            'Security Cameras' => ['Ring', 'Arlo', 'Reolink'],
            'Smart TVs' => ['Samsung', 'LG', 'Sony'],
            'OLED TVs' => ['LG', 'Sony', 'Panasonic'],
            '4K TVs' => ['TCL', 'Hisense', 'Vizio'],
            'Gaming Consoles' => ['Sony PlayStation', 'Microsoft Xbox', 'Nintendo'],
            'Home Theater' => ['Bose', 'Sony', 'Yamaha'],
            'Washing Machines' => ['LG', 'Samsung', 'Whirlpool'],
            'Refrigerators' => ['GE', 'Haier', 'Bosch'],
            'Microwaves' => ['Panasonic', 'Samsung', 'Whirlpool'],
            'Air Conditioners' => ['Daikin', 'Carrier', 'Gree'],
            'Sofas' => ['IKEA', 'Ashley Furniture'],
            'Beds' => ['IKEA', 'Sleepwell'],
            'Dining Tables' => ['Urban Ladder', 'HomeTown'],
            'Office Chairs' => ['Herman Miller', 'Steelcase'],
            'Outdoor Furniture' => ['Home Depot', 'Wayfair'],
            'T‑Shirts' => ['H&M', 'Zara', 'Uniqlo'],
            'Jeans' => ['Levi’s', 'Wrangler', 'Lee'],
            'Jackets' => ['North Face', 'Columbia', 'Patagonia'],
            'Formal Shirts' => ['Arrow', 'Van Heusen'],
            'Shoes' => ['Nike', 'Adidas', 'Puma'],
            'Heels' => ['Steve Madden', 'Aldo'],
            'Flats' => ['Clarks', 'Crocs'],
            'Women Bags' => ['Michael Kors', 'Guess'],
            'Jewelry' => ['Tiffany & Co.', 'Pandora', 'Swarovski'],
            'Baby Essentials' => ['Johnson’s Baby', 'Pampers', 'Chicco'],
            'Toys' => ['LEGO', 'Mattel', 'Hasbro'],
            'School Supplies' => ['Camlin', 'Faber-Castell'],
            'Books' => ['Penguin', 'HarperCollins'],
            'Skincare' => ['Neutrogena', 'The Ordinary'],
            'Shampoos' => ['Head & Shoulders', 'Dove'],
            'Makeup' => ['Maybelline', 'L’Oreal', 'MAC'],
            'Perfumes' => ['Dior', 'Chanel', 'Axe'],
            'Gym Equipment' => ['Decathlon', 'Bowflex'],
            'Cricket' => ['SG', 'MRF', 'Kookaburra'],
            'Football' => ['Nike', 'Adidas', 'Puma'],
            'Cycling' => ['Giant', 'Trek', 'Bianchi'],
            'Motorbikes' => ['Honda', 'Yamaha', 'Suzuki'],
            'Car Accessories' => ['Philips', 'Baseus'],
            'Smart Watches' => ['Apple', 'Garmin', 'Fitbit'],
            'Rings' => ['Tanishq', 'BlueStone'],
            'Watches' => ['Casio', 'Rolex', 'Timex'],
            'Backpacks' => ['Wildcraft', 'Skybags', 'Samsonite'],
            'Camping Gear' => ['Quechua', 'Coleman'],
            'Pet Food' => ['Pedigree', 'Whiskas'],
            'Gardening Tools' => ['Fiskars', 'Tramontina'],
            'Cleaning Products' => ['Mr. Clean', 'Dettol', 'Harpic'],
            'Dishwashing' => ['Finish', 'Pril', 'Scotch-Brite'],
        ];

        foreach ($brandData as $subcatName => $brands) {
            $subcategory = Subcategory::where('name', $subcatName)->first();
            if (!$subcategory)
                continue;

            foreach ($brands as $brandName) {
                Brand::create([
                    'name' => $brandName,
                    'subcategory_id' => $subcategory->id,
                    'image' => null,
                    'is_popular' => false,
                ]);
            }
        }
    }
}
