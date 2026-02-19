<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function index()
    {
        return view('admin.visits.index');
    }

    public function create()
    {
        $medicines = Medicine::where('stock', '>', 0)->get();

        return view('admin.visits.create', compact('medicines'));
    }

    public function searchPatients(Request $request)
    {
        $search = $request->q;

        $patients = Patient::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            })
            ->limit(5)
            ->get();

        return response()->json(
            $patients->map(function ($patient) {
                return [
                    'id' => $patient->id,
                    'text' => $patient->name . ' — ' . $patient->phone_number
                ];
            })
        );
    }


}
