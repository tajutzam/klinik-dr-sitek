<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MedicineController extends Controller
{


    public function index()
    {
        $categories = MedicineCategory::all();
        return view('admin.medicines.index', compact('categories'));
    }

    public function datatable(Request $request)
    {
        $query = Medicine::with('category')->latest();

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('category', function ($row) {
                return $row->category?->name ?? '-';
            })

            ->editColumn('price', function ($row) {
                return number_format($row->price, 2);
            })

            ->addColumn('stock_status', function ($row) {
                if ($row->stock <= $row->minimum_stock) {
                    return '<span class="badge badge-light-danger">Low</span>';
                }
                return '<span class="badge badge-light-success">Available</span>';
            })

            ->addColumn('action', function ($row) {

                $editBtn = '
                    <button class="btn btn-sm btn-light-primary editBtn"
                        data-id="' . $row->id . '"
                        data-name="' . $row->medicine_name . '"
                        data-category="' . $row->medicine_category_id . '"
                        data-price="' . $row->price . '"
                        data-unit="' . $row->unit . '"
                        data-stock="' . $row->stock . '"
                        data-min="' . $row->minimum_stock . '">
                        Edit
                    </button>
                ';

                $deleteBtn = '
                    <form action="' . route('medicines.destroy', $row->id) . '"
                        method="POST"
                        class="d-inline deleteForm">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button class="btn btn-sm btn-light-danger">
                            Delete
                        </button>
                    </form>
                ';

                return $editBtn . $deleteBtn;
            })

            ->rawColumns(['stock_status', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_name' => 'required|max:255',
            'medicine_category_id' => 'required|exists:medicine_categories,id',
            'price' => 'required|numeric',
            'unit' => 'required',
            'stock' => 'required|integer',
            'minimum_stock' => 'required|integer',
        ]);

        Medicine::create($request->all());

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine created successfully.');
    }

    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $request->validate([
            'medicine_name' => 'required|max:255',
            'medicine_category_id' => 'required|exists:medicine_categories,id',
            'price' => 'required|numeric',
            'unit' => 'required',
            'stock' => 'required|integer',
            'minimum_stock' => 'required|integer',
        ]);

        $medicine->update($request->all());

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }

    public function destroy($id)
    {
        Medicine::findOrFail($id)->delete();

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine deleted successfully.');
    }
}
