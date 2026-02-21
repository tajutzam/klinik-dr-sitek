<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    public function index()
    {
        return view('admin.patients.index');
    }

    public function datatable(Request $request)
    {
        $query = Patient::query()->latest();

        return DataTables::of($query)
            ->addIndexColumn()

            ->editColumn('date_of_birth', function ($row) {
                return $row->date_of_birth
                    ? \Carbon\Carbon::parse($row->date_of_birth)->format('d M Y')
                    : '-';
            })

            ->editColumn('gender', function ($row) {
                if (!$row->gender)
                    return '-';

                return $row->gender === 'male'
                    ? '<span class="badge badge-light-primary">Male</span>'
                    : '<span class="badge badge-light-info">Female</span>';
            })

            ->addColumn('action', function ($row) {

                $editBtn = '
                    <button class="btn btn-sm btn-light-primary editBtn"
                        data-id="' . $row->id . '"
                        data-name="' . $row->name . '"
                        data-national="' . $row->national_id . '"
                        data-dob="' . $row->date_of_birth . '"
                        data-gender="' . $row->gender . '"
                        data-address="' . $row->address . '"
                        data-phone="' . $row->phone_number . '">
                        Edit
                    </button>
                ';

                $deleteBtn = '
                    <form action="' . route('patients.destroy', $row->id) . '"
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

            ->rawColumns(['gender', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'national_id' => 'nullable|unique:patients,national_id',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable',
            'phone_number' => 'nullable|max:20'
        ]);

        Patient::create($request->all());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'national_id' => 'nullable|unique:patients,national_id,' . $patient->id,
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable',
            'phone_number' => 'nullable|max:20'
        ]);

        $patient->update($request->all());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }


    public function quickStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|unique:patients,national_id',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string',
        ]);

        $patient = Patient::create($validated);

        return response()->json([
            'id' => $patient->id,
            'text' => $patient->name . ($patient->phone_number ? " ({$patient->phone_number})" : "")
        ]);
    }
}
