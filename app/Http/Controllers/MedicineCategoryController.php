<?php

namespace App\Http\Controllers;

use App\Models\MedicineCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicineCategoryController extends Controller
{
    //


    public function index()
    {

        return view('admin.medicine_category.index');
    }


    public function datatable(Request $request)
    {
        if ($request->ajax()) {

            $query = MedicineCategory::query()->latest();

            return DataTables::of($query)
                ->addIndexColumn()

                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M Y');
                })

                ->addColumn('action', function ($row) {

                    $editBtn = '
                        <button class="btn btn-sm btn-light-primary editBtn"
                            data-id="' . $row->id . '"
                            data-name="' . $row->name . '"
                            data-description="' . $row->description . '">
                            Edit
                        </button>
                    ';

                    $deleteBtn = '
                        <form action="' . route('medicine-categories.destroy', $row->id) . '"
                            method="POST"
                            class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button class="btn btn-sm btn-light-danger"
                                onclick="return confirm(\'Delete this category?\')">
                                Delete
                            </button>
                        </form>
                    ';

                    return $editBtn . $deleteBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:medicine_categories,name',
            'description' => 'nullable|string'
        ]);

        MedicineCategory::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('medicine-categories.index')
            ->with('success', 'Medicine category created successfully.');
    }

    /**
     * Update category
     */
    public function update(Request $request, $id)
    {
        $category = MedicineCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:medicine_categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('medicine-categories.index')
            ->with('success', 'Medicine category updated successfully.');
    }

    /**
     * Delete category
     */
    public function destroy($id)
    {
        $category = MedicineCategory::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('medicine-categories.index')
            ->with('success', 'Medicine category deleted successfully.');
    }


    public function show(){

    }

}
