<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function allProducts(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $popularBrands = Brand::all();
        $products = Product::paginate(12);  // Or whatever per-page you want

        $brandMessage = null;  // Or logic to set this

        return view('user.allproducts', compact('categories', 'brands', 'popularBrands', 'products', 'brandMessage'));
    }

    public function productDetails($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        $categories = Subcategory::withCount('products')->get();
        $Products = Product::latest()->take(5)->get();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        return view('user.product-details', compact(
            'product',
            'categories',
            'Products',
            'relatedProducts'
        ));
    }

    public function cart()
    {
        return view('user.cart');
    }

    public function checkout()
    {
        return view('user.checkout');
    }

    public function orders()
    {
        return view('user.orders');
    }

    public function wishlist()
    {
        return view('user.wishlist');
    }
}
