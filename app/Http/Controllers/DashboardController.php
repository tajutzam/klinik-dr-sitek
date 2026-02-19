<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalPatients = Patient::count();
        $totalMedicines = Medicine::count();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlyVisits = Visit::whereBetween('visit_date', [$startOfMonth, $endOfMonth])->count();

        $monthlyRevenue = Visit::whereBetween('visit_date', [$startOfMonth, $endOfMonth])
            ->sum('total_cost');

        $recentVisits = Visit::with('patient')
            ->latest('visit_date')
            ->take(5)
            ->get();

        $lowStockList = Medicine::whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        $dailyVisits = Visit::select(
            DB::raw('DATE(visit_date) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('visit_date', [$startOfMonth, $endOfMonth])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $dailyVisits->pluck('date');
        $chartData = $dailyVisits->pluck('total');

        return view('admin.dashboard', compact(
            'totalPatients',
            'totalMedicines',
            'monthlyVisits',
            'monthlyRevenue',
            'recentVisits',
            'lowStockList',
            'chartLabels',
            'chartData'
        ));
    }

}
