<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class HeroSlideController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HeroSlide::orderBy('sort_order')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset('storage/' . $row->image) . '" width="80" class="img-thumbnail file-preview" data-src="' . asset('storage/' . $row->image) . '">';
                })
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input toggle-status" data-id="' . $row->id . '" ' . $checked . '>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-info edit-btn" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '" data-title="' . $row->title . '"><i class="fas fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.hero_slides.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('hero_slides', 'public');

        HeroSlide::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $path,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return response()->json(['message' => 'Hero slide created successfully']);
    }

    public function show(HeroSlide $hero_slide)
    {
        return response()->json($hero_slide);
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'subtitle', 'button_text', 'button_link', 'sort_order', 'status']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($hero_slide->image);
            $data['image'] = $request->file('image')->store('hero_slides', 'public');
        }

        $hero_slide->update($data);

        return response()->json(['message' => 'Hero slide updated successfully']);
    }

    public function destroy(HeroSlide $hero_slide)
    {
        Storage::disk('public')->delete($hero_slide->image);
        $hero_slide->delete();
        return response()->json(['message' => 'Hero slide deleted successfully']);
    }

    public function toggleStatus(HeroSlide $hero_slide)
    {
        $hero_slide->status = !$hero_slide->status;
        $hero_slide->save();

        return response()->json(['message' => 'Status updated']);
    }
}
