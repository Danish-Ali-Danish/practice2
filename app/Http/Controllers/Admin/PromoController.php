<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Promo::latest()->get();

            return datatables()
                ->of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', fn($row) =>
                    '<input type="checkbox" class="selectPromo" value="' . $row->id . '">')
                ->editColumn('image', fn($row) =>
                    $row->image
                        ? '<img src="' . asset('storage/' . $row->image) . '" width="50" class="img-thumbnail">'
                        : 'No Image')
                ->addColumn('action', fn($row) => '
                    <button class="btn btn-sm btn-info edit-btn" data-id="' . $row->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>
                ')
                ->rawColumns(['checkbox', 'image', 'action'])
                ->make(true);
        }

        return view('admin.promos.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promos', 'public');
        }

        Promo::create($data);
        return response()->json(['message' => 'Promo created successfully']);
    }

    public function show(Promo $promo)
    {
        return response()->json($promo);
    }

    public function update(Request $request, Promo $promo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($promo->image) {
                Storage::disk('public')->delete($promo->image);
            }
            $data['image'] = $request->file('image')->store('promos', 'public');
        }

        $promo->update($data);
        return response()->json(['message' => 'Promo updated successfully']);
    }

    public function destroy(Promo $promo)
    {
        if ($promo->image) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();
        return response()->json(['message' => 'Promo deleted successfully']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        $promos = Promo::whereIn('id', $ids)->get();
        foreach ($promos as $promo) {
            if ($promo->image) {
                Storage::disk('public')->delete($promo->image);
            }
        }

        Promo::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Selected promos deleted.']);
    }
}
