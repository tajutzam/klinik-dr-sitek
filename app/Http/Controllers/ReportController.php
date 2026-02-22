<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.reports.revenue');
    }

    public function data(Request $request)
    {
        $start = $request->start_date
            ? Carbon::parse($request->start_date)->startOfDay()
            : now()->startOfMonth();

        $end = $request->end_date
            ? Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfMonth();

        $query = DB::table('visits')
            ->whereBetween('visit_date', [$start, $end])
            ->selectRaw('
                DATE(visit_date) as date,
                COUNT(*) as total_visits,
                SUM(doctor_fee) as total_doctor_fee,
                SUM(additional_fee) as total_additional_fee,
                SUM(total_cost) as total_revenue
            ')
            ->groupBy(DB::raw('DATE(visit_date)'));

        return DataTables::of($query)
            ->editColumn('total_doctor_fee', fn($row) => 'Rp ' . number_format($row->total_doctor_fee, 0, ',', '.'))
            ->editColumn('total_additional_fee', fn($row) => 'Rp ' . number_format($row->total_additional_fee, 0, ',', '.'))
            ->editColumn('total_revenue', fn($row) => 'Rp ' . number_format($row->total_revenue, 0, ',', '.'))
            ->rawColumns(['total_revenue'])
            ->make(true);
    }

    public function print(Request $request)
    {
        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();

        $reports = DB::table('visits')
            ->whereBetween('visit_date', [$start, $end])
            ->selectRaw('
                DATE(visit_date) as date,
                COUNT(*) as total_visits,
                SUM(doctor_fee) as total_doctor_fee,
                SUM(additional_fee) as total_additional_fee,
                SUM(total_cost) as total_revenue
            ')
            ->groupBy(DB::raw('DATE(visit_date)'))
            ->get();

        return view('admin.reports.print-revenue', compact('reports', 'start', 'end'));
    }


    public function summary(Request $request)
    {
        $start = $request->start_date
            ? Carbon::parse($request->start_date)->startOfDay()
            : now()->startOfMonth();

        $end = $request->end_date
            ? Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfMonth();

        $summary = \DB::table('visits')
            ->whereBetween('visit_date', [$start, $end])
            ->selectRaw('
            COUNT(*) as total_visits,
            SUM(doctor_fee) as total_doctor_fee,
            SUM(additional_fee) as total_additional_fee,
            SUM(total_cost) as total_revenue
        ')
            ->first();

        return response()->json($summary);
    }
}