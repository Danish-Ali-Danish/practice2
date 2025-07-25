<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Testimonial;
use App\Models\TimeDeal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->latest()->take(6)->get();
        $brands = Brand::with('subcategory')->latest()->take(20)->get();
        $featured = Product::where('is_featured', true)->latest()->take(6)->get();
        $products = Product::where('is_featured', false)->latest()->take(12)->get();
        $features = Feature::latest()->take(4)->get();  // Home Features
        $promos = Promo::latest()->take(3)->get();  // Promotional banners
        $testimonials = Testimonial::latest()->take(4)->get();  // Client reviews
        $blogPosts = BlogPost::latest()->take(3)->get();
        $deal = TimeDeal::with('product')
            ->where(function ($q) {
                $q
                    ->where('start_time', '<=', now())
                    ->where('end_time', '>=', now());
            })
            ->orWhere('start_time', '>', now())
            ->orderBy('start_time')
            ->first();
        $timeBlocks = [];
        if ($deal) {
            $timeBlocks[] = [
                'time' => $deal->end_time->format('Y-m-d H:i:s'),
            ];
        }

        return view('user.home', compact(
            'categories',
            'brands',
            'products',
            'features',
            'featured',
            'promos',
            'testimonials',
            'blogPosts',
            'deal',
            'timeBlocks'
        ));
    }
}
