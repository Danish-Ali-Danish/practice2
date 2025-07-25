<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subcategory::with('category')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category.name', function ($row) {
                    return $row->category->name ?? '—';
                })
                ->addColumn('image', function ($row) {
                    if ($row->image && Storage::disk('public')->exists($row->image)) {
                        $url = asset('storage/' . $row->image);
                        return '<img src="' . e($url) . '" width="50" height="50" style="object-fit:cover;cursor:pointer" class="file-preview" data-src="' . e($url) . '">';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-info edit-btn" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    ';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        $categories = Category::all();
        return view('admin.subcategories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subcategories,name',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/subcategories', 'public');
        }

        $subcategory = Subcategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'slug' => $this->generateSlug($request->name),
        ]);

        return response()->json(['message' => 'Subcategory added successfully!', 'subcategory' => $subcategory]);
    }

    public function show($id)
    {
        $subcategory = Subcategory::with('category')->findOrFail($id);
        return response()->json($subcategory);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subcategories,name,' . $subcategory->id,
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
                Storage::disk('public')->delete($subcategory->image);
            }

            $subcategory->image = $request->file('image')->store('uploads/subcategories', 'public');
        }

        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->slug = $this->generateSlug($request->name, $subcategory->id);
        $subcategory->save();

        return response()->json(['message' => 'Subcategory updated successfully!', 'subcategory' => $subcategory]);
    }

    public function destroy(Subcategory $subcategory)
    {
        try {
            if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
                Storage::disk('public')->delete($subcategory->image);
            }

            $subcategory->delete();
            return response()->json(['message' => 'Subcategory deleted successfully!']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Cannot delete subcategory. It is associated with other records.'
            ], 409);
        }
    }

    protected function generateSlug($name, $id = null)
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $counter = 1;
        $originalSlug = $slug;

        while (Subcategory::where('slug', $slug)
                ->when($id, function ($query) use ($id) {
                    $query->where('id', '!=', $id);
                })
                ->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}
