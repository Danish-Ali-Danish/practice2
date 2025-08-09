<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            FeatureSeeder::class,
            // CategorySeeder::class,
            // SubCategorySeeder::class,
            // BrandSeeder::class,
            // ProductSeeder::class,
        ]);
        // $this->call(TimeDealSeeder::class);
    }
}
