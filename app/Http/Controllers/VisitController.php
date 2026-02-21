<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\VisitMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class VisitController extends Controller
{
    //
    public function index()
    {
        return view('admin.visits.index');
    }

    public function print($id)
    {
        $visit = Visit::with(['patient', 'creator', 'medicines.medicine'])->findOrFail($id);

        return view('admin.visits.print', compact('visit'));
    }

    public function create()
    {
        $medicines = Medicine::where('stock', '>', 0)->get();

        return view('admin.visits.create', compact('medicines'));
    }

    public function searchMedicines(Request $request)
    {
        $search = $request->q;

        $medicines = Medicine::where('stock', '>', 0)
            ->when($search, function ($query) use ($search) {
                $query->where('medicine_name', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get();

        return response()->json(
            $medicines->map(function ($medicine) {
                return [
                    'id' => $medicine->id,
                    'text' => $medicine->medicine_name . ' (Sisa: ' . $medicine->stock . ')',
                    'price' => $medicine->price,
                    'name' => $medicine->medicine_name,
                    'stock' => $medicine->stock,
                ];
            }),
        );
    }

    public function searchPatients(Request $request)
    {
        $search = $request->q;

        $patients = Patient::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")->orWhere('phone_number', 'like', "%{$search}%");
            })
            ->limit(5)
            ->get();

        return response()->json(
            $patients->map(function ($patient) {
                return [
                    'id' => $patient->id,
                    'text' => $patient->name . ' — ' . $patient->phone_number,
                ];
            }),
        );
    }

    public function datatable()
    {
        $query = Visit::with(['patient', 'creator'])
            ->when(request('filter_date'), function ($q) {
                $q->whereDate('visit_date', request('filter_date'));
            })
            ->when(request('filter_patient'), function ($q) {
                $q->where('patient_id', request('filter_patient'));
            })
            ->select('visits.*');

        return DataTables::of($query)
            ->addIndexColumn()

            ->editColumn('visit_date', function ($visit) {
                return $visit->visit_date ? \Carbon\Carbon::parse($visit->visit_date)->format('d M Y H:i') : '-';
            })

            ->addColumn('patient_name', function ($visit) {
                return $visit->patient?->name ?? '-';
            })

            ->addColumn('created_by', function ($visit) {
                return $visit->creator?->name ?? '-';
            })

            ->editColumn('doctor_fee', function ($visit) {
                return 'Rp ' . number_format($visit->doctor_fee, 0, ',', '.');
            })

            ->editColumn('additional_fee', function ($visit) {
                return 'Rp ' . number_format($visit->additional_fee, 0, ',', '.');
            })

            ->editColumn('total_cost', function ($visit) {
                return 'Rp ' . number_format($visit->total_cost, 0, ',', '.');
            })

            ->addColumn('action', function ($visit) {
                return '
                <a href="' .
                    route('visits.show', $visit->id) .
                    '" class="btn btn-sm btn-light-primary">Detail</a>
                   <button type="button"
            class="btn btn-sm btn-light-warning editBtn"
            data-id="' .
                    $visit->id .
                    '"
            data-patient="' .
                    $visit->patient_id .
                    '"
            data-doctor="' .
                    $visit->doctor_fee .
                    '"
            data-additional="' .
                    $visit->additional_fee .
                    '">
            Edit
        </button>
            ';
            })

            ->filterColumn('patient_name', function ($query, $keyword) {
                $query->whereHas('patient', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })

            ->filterColumn('created_by', function ($query, $keyword) {
                $query->whereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_fee' => 'nullable|numeric|min:0',
            'additional_fee' => 'nullable|numeric|min:0',
        ]);

        $visit = Visit::findOrFail($id);

        $doctorFee = $request->doctor_fee ?? 0;
        $additionalFee = $request->additional_fee ?? 0;

        $medicineTotal = $visit->medicines()->sum('subtotal');

        $visit->update([
            'patient_id' => $request->patient_id,
            'doctor_fee' => $doctorFee,
            'additional_fee' => $additionalFee,
            'total_cost' => $doctorFee + $additionalFee + $medicineTotal,
        ]);

        return response()->json(['success' => true]);
    }

    public function summary(Request $request)
    {
        $query = Visit::query();

        if ($request->filter_date) {
            $query->whereDate('visit_date', $request->filter_date);
        }

        if ($request->filter_patient) {
            $query->where('patient_id', $request->filter_patient);
        }

        $totalVisits = $query->count();
        $todayVisits = Visit::whereDate('visit_date', now())->count();
        $totalRevenue = $query->sum('total_cost');

        return response()->json([
            'total_visits' => $totalVisits,
            'today_visits' => $todayVisits,
            'total_revenue' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
        ]);
    }

    public function show($id)
    {
        $visit = Visit::with(['patient', 'creator', 'medicines.medicine'])->findOrFail($id);

        return view('admin.visits.show', compact('visit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_fee' => 'nullable|numeric|min:0',
            'additional_fee' => 'nullable|numeric|min:0',
            'complaints' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'medicines' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {
            $doctorFee = $request->doctor_fee ?? 0;
            $additionalFee = $request->additional_fee ?? 0;

            $medicineTotal = 0;

            $visit = Visit::create([
                'patient_id' => $request->patient_id,
                'created_by' => auth()->id(),
                'visit_date' => now(),
                'complaints' => $request->complaints,
                'diagnosis' => $request->diagnosis,
                'treatment' => null,
                'notes' => null,
                'doctor_fee' => $doctorFee,
                'additional_fee' => $additionalFee,
                'total_cost' => 0,
            ]);

            if ($request->has('medicines')) {
                foreach ($request->medicines as $data) {
                    $medicine = Medicine::lockForUpdate()->findOrFail($data['medicine_id']);

                    $qty = (int) $data['quantity'];

                    if ($qty < 1) {
                        throw new \Exception('Jumlah obat tidak valid.');
                    }

                    if ($medicine->stock < $qty) {
                        throw new \Exception("Stok {$medicine->medicine_name} tidak mencukupi.");
                    }

                    $subtotal = $medicine->price * $qty;
                    $medicineTotal += $subtotal;

                    VisitMedicine::create([
                        'visit_id' => $visit->id,
                        'medicine_id' => $medicine->id,
                        'quantity' => $qty,
                        'unit_price' => $medicine->price,
                        'subtotal' => $subtotal,
                        'dosage_instruction' => null,
                    ]);

                    $medicine->decrement('stock', $qty);
                }
            }

            $visit->update([
                'total_cost' => $doctorFee + $additionalFee + $medicineTotal,
            ]);

            DB::commit();

            return redirect()->route('visits.show', $visit->id)->with('success', 'Kunjungan berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
