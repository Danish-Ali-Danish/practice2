<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $features = Feature::select(['id', 'title', 'icon', 'description']);

            return DataTables::of($features)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('admin.features.partials.actions', compact('row'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.features.index');
    }

    /**
     * Store a newly created feature (AJAX)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $feature = Feature::create($validated);

        return response()->json([
            'message' => 'Feature added successfully!',
            'data' => $feature
        ]);
    }

    /**
     * Return single feature data for edit modal (AJAX)
     */
    public function show($id)
    {
        $feature = Feature::find($id);

        if (!$feature) {
            return response()->json(['error' => 'Feature not found'], 404);
        }

        return response()->json($feature);
    }

    /**
     * Update the specified feature (AJAX)
     */
    public function update(Request $request, $id)
    {
        $feature = Feature::findOrFail($id);

        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $feature->update($validated);

        return response()->json([
            'message' => 'Feature updated successfully!',
            'data' => $feature
        ]);
    }

    /**
     * Delete a feature (AJAX)
     */
    public function destroy($id)
    {
        $feature = Feature::find($id);

        if (!$feature) {
            return response()->json(['error' => 'Feature not found'], 404);
        }

        $feature->delete();

        return response()->json(['message' => 'Feature deleted successfully!']);
    }

    /**
     * Bulk delete features (AJAX)
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids) && count($ids) > 0) {
            Feature::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Selected features deleted successfully!']);
        }

        return response()->json(['message' => 'No features selected.'], 400);
    }
}
