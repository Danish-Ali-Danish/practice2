<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $subcategories = Subcategory::with('category')->get();
        return view('admin.products.index', compact('brands', 'subcategories'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            try {
                $products = Product::with(['brand', 'subcategory.category'])
                    ->select('products.*');

                return DataTables::of($products)
                    ->addIndexColumn()
                    ->addColumn('checkbox', fn($product) => '<input type="checkbox" class="rowCheckbox" value="' . $product->id . '">')
                    ->addColumn('brand', fn($product) => $product->brand?->name ?? '-')
                    ->addColumn('category', fn($product) => $product->subcategory?->category?->name ?? '-')
                    ->addColumn('subcategory', fn($product) => $product->subcategory?->name ?? '-')
                    ->addColumn('image', function ($product) {
                        if ($product->main_image) {
                            return '<img src="' . asset('storage/' . $product->main_image) . '" width="50" height="50" style="object-fit:cover">';
                        }
                        return 'No Image';
                    })
                    ->addColumn('is_featured', fn($product) =>
                        '<input type="checkbox" class="featured-checkbox" data-id="' . $product->id . '" '
                        . ($product->is_featured ? 'checked' : '') . '>')
                    ->addColumn('actions', function ($product) {
                        return '<button class="btn btn-sm btn-primary editBtn"
                                    data-id="' . $product->id . '"
                                    data-name="' . e($product->name) . '"
                                    data-slug="' . e($product->slug) . '"
                                    data-brand="' . $product->brand_id . '"
                                    data-sub="' . $product->subcategory_id . '"
                                    data-price="' . $product->price . '"
                                    data-featured="' . $product->is_featured . '"
                                    data-desc="' . e($product->description) . '">
                                    Edit</button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $product->id . '">Delete</button>';
                    })
                    ->rawColumns(['checkbox', 'image', 'is_featured', 'actions'])
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to load data: ' . $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_featured' => $request->has('is_featured'),
            'slug' => \Str::slug($request->name)
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $request->id,
            'slug' => 'required|string|max:255|unique:products,slug,' . $request->id,
            'brand_id' => 'required|exists:brands,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        $product = Product::updateOrCreate(['id' => $request->id], $validated);

        return response()->json([
            'success' => true,
            'message' => 'Product ' . ($request->id ? 'updated' : 'created') . ' successfully'
        ]);
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            $product->delete();

            return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting product: ' . $e->getMessage()], 500);
        }
    }

    public function getProductsBySubcategory($subcategoryId)
    {
        $products = Product::with(['brand', 'subcategory.category'])
            ->where('subcategory_id', $subcategoryId)
            ->get();

        return response()->json([
            'products' => $products,
            'brands' => $products->pluck('brand')->unique()->values()
        ]);
    }

    public function getFeaturedProducts()
    {
        $products = Product::with(['brand', 'subcategory.category'])
            ->where('is_featured', true)
            ->limit(8)
            ->get();

        return response()->json($products);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:products,id',
            'updates.*.field' => 'required|in:is_featured',
            'updates.*.value' => 'required|in:0,1',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->updates as $update) {
                $product = Product::findOrFail($update['id']);
                $product->{$update['field']} = $update['value'];
                $product->save();
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'All changes have been saved']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update statuses: ' . $e->getMessage()], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id'
        ]);

        DB::beginTransaction();

        try {
            $products = Product::whereIn('id', $validated['ids'])->get();
            foreach ($products as $product) {
                if ($product->main_image) {
                    Storage::disk('public')->delete($product->main_image);
                }
                $product->delete();
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Selected products deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error deleting products: ' . $e->getMessage()], 500);
        }
    }

    public function addStock(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $product->increment('stock', $validated['stock']);

        return response()->json(['success' => true, 'message' => 'Stock added successfully']);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['success' => true, 'data' => $product]);
    }

    public function featured()
    {
        // Fetch all featured products
        $featuredProducts = Product::where('is_featured', true)->with(['brand', 'subcategory'])->get();

        return view('admin.products.featured', compact('featuredProducts'));
    }

    public function subcategoryProducts($id)
    {
        $subcategory = Subcategory::with(['products.brand', 'category'])->findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'subcategory' => $subcategory,
                'products' => $subcategory->products,
                'brands' => $subcategory->products->pluck('brand')->unique()
            ]);
        }
    }
}
