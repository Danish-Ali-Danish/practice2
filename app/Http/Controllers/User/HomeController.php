<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\HeroSlide;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Subcategory;
use App\Models\Testimonial;
use App\Models\TimeDeal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = HeroSlide::where('status', 1)->orderBy('sort_order')->take(20)->get();

        $categories = Category::with('subcategories')->latest()->take(20)->get();
        $brands = Brand::with('subcategory')->latest()->take(20)->get();
        $featuredProducts = Product::where('is_featured', true)->latest()->take(8)->get();

        // $featured = Product::where('is_featured', true)->get();
        $products = Product::where('is_featured', false)->latest()->take(12)->get();
        $features = Feature::latest()->take(4)->get();  // Home Features
        $promos = Promo::latest()->take(4)->get();  // Promotional banners
        $testimonials = Testimonial::latest()->take(4)->get();  // Client reviews
        $blogPosts = BlogPost::latest()->take(3)->get();
        $categoriesWithProducts = Subcategory::with(['products' => function ($q) {
            $q->take(8);
        }])->inRandomOrder()->take(4)->get();  // sirf 4 subcategories

        return view('user.home', compact(
            'categories',
            'brands',
            'products',
            'features',
            'featuredProducts',
            'promos',
            'testimonials',
            'blogPosts',
            'categoriesWithProducts',
            'heroSlides'
        ));
    }
}
