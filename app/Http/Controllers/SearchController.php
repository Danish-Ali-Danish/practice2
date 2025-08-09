<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function categories()
    {
        return response()->json(Category::select('id', 'name')->get());
    }

    public function suggestions(Request $request)
    {
        $query = $request->q;

        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->limit(5)
            ->get()
            ->map(function ($p) {
                return [
                    'type' => 'Product',
                    'name' => $p->name,
                    'description' => \Str::limit($p->description, 60),
                    'image' => $p->main_image ? asset('storage/' . $p->main_image) : asset('images/no-image.png'),
                    'url' => route('product.show', $p->id),  // adjust if you use slug
                ];
            });

        $categories = Category::where('name', 'like', "%$query%")
            ->limit(3)
            ->get()
            ->map(fn($c) => [
                'type' => 'Category',
                'name' => $c->name,
                'url' => route('category.products', $c->id),
            ]);

        $subcategories = Subcategory::where('name', 'like', "%$query%")
            ->limit(3)
            ->get()
            ->map(fn($s) => [
                'type' => 'Subcategory',
                'name' => $s->name,
                'url' => route('subcategory.products', $s->id),
            ]);

        $brands = Brand::where('name', 'like', "%$query%")
            ->limit(3)
            ->get()
            ->map(fn($b) => [
                'type' => 'Brand',
                'name' => $b->name,
                'url' => route('brand.products', $b->id),
            ]);

        return response()->json(
            $products->merge($categories)->merge($subcategories)->merge($brands)->values()
        );
    }
}
