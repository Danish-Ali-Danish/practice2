<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('admin.brands.index', compact('subcategories'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            try {
                $brands = Brand::with('subcategory')->select('brands.*');

                return DataTables::of($brands)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($brand) {
                        return '<input type="checkbox" class="brand-checkbox" value="' . $brand->id . '">';
                    })
                    ->addColumn('image', function ($brand) {
                        return $brand->image
                            ? '<img src="' . asset('storage/' . $brand->image) . '" width="50" height="50" style="object-fit:cover;">'
                            : 'No Image';
                    })
                    ->addColumn('subcategory', function ($brand) {
                        return $brand->subcategory ? $brand->subcategory->name : '-';
                    })
                    ->addColumn('is_popular', function ($brand) {
                        return '<input type="checkbox" class="popular-checkbox" data-id="' . $brand->id . '" ' . ($brand->is_popular ? 'checked' : '') . '>';
                    })
                    ->addColumn('actions', function ($brand) {
                        return '<button class="btn btn-sm btn-primary edit-btn" data-id="' . $brand->id . '">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="' . $brand->id . '">Delete</button>';
                    })
                    ->rawColumns(['checkbox', 'image', 'is_popular', 'actions'])
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to load data: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_popular' => $request->has('is_popular')
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'subcategory_id' => 'required|exists:subcategories,id',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_popular' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $validated['image'] = $request->file('file')->store('brands', 'public');
        }

        Brand::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Brand created successfully'
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $request->merge([
            'is_popular' => $request->has('is_popular')
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'subcategory_id' => 'required|exists:subcategories,id',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_popular' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }
            $validated['image'] = $request->file('file')->store('brands', 'public');
        }

        $brand->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Brand updated successfully'
        ]);
    }

    public function edit(Brand $brand)
    {
        return response()->json([
            'success' => true,
            'data' => $brand
        ]);
    }

    public function destroy(Brand $brand)
    {
        try {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }

            $brand->delete();

            return response()->json([
                'success' => true,
                'message' => 'Brand deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting brand: ' . $e->getMessage()
            ], 500);
        }
    }

    public function togglePopular(Brand $brand)
    {
        try {
            $brand->update(['is_popular' => !$brand->is_popular]);

            return response()->json([
                'success' => true,
                'is_popular' => $brand->fresh()->is_popular,
                'message' => 'Popular status updated'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating popular status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkActions(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,make_popular,remove_popular',
            'ids' => 'required|array',
            'ids.*' => 'exists:brands,id'
        ]);

        try {
            switch ($validated['action']) {
                case 'delete':
                    $brandsWithImages = Brand::whereIn('id', $validated['ids'])
                        ->whereNotNull('image')
                        ->get();

                    foreach ($brandsWithImages as $brand) {
                        Storage::disk('public')->delete($brand->image);
                    }

                    Brand::whereIn('id', $validated['ids'])->delete();
                    break;

                case 'make_popular':
                    Brand::whereIn('id', $validated['ids'])->update(['is_popular' => true]);
                    break;

                case 'remove_popular':
                    Brand::whereIn('id', $validated['ids'])->update(['is_popular' => false]);
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => 'Bulk action completed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error performing bulk action: ' . $e->getMessage()
            ], 500);
        }
    }
}
