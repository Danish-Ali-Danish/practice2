<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function categories()
    {
        return response()->json(Category::select('name', 'slug')->get());
    }

    public function suggestions(Request $request)
    {
        $query = $request->q;
        $cat = $request->category ?? 'all';

        $categories = Category::where('name', 'LIKE', "$query%")->limit(3)->get();
        $brands = Brand::where('name', 'LIKE', "$query%")->limit(3)->get();
        $results = [];

        $products = Product::where('name', 'LIKE', "$query%")
            ->orWhere('name', 'LIKE', "% $query%")
            ->orWhere('short_description', 'LIKE', "%$query%")
            ->limit(5)
            ->get();

        foreach ($products as $product) {
            $results[] = [
                'name' => $product->name,
                'description' => \Str::limit($product->short_description, 50),
                'image' => asset('uploads/products/' . $product->image),
                'url' => url('/product/' . $product->id),
                'type' => 'Product',
            ];
        }

        foreach ($categories as $item) {
            $results[] = [
                'name' => $item->name,
                'url' => url('/cate/' . $item->slug),
                'type' => 'Category'
            ];
        }

        foreach ($brands as $item) {
            $results[] = [
                'name' => $item->name,
                'url' => url('/all-brands/' . $item->slug),
                'type' => 'Brand'
            ];
        }

        return response()->json($results);
    }
}
