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
    public function index()
    {
        $totalPatients = Patient::count();
        $totalMedicines = Medicine::count();

        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $monthlyRevenue = Visit::whereBetween('visit_date', [$startOfMonth, $endOfMonth])->sum('total_cost');

        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();
        $lastMonthRevenue = Visit::whereBetween('visit_date', [$startOfLastMonth, $endOfLastMonth])->sum('total_cost');

        $revenueChange = 0;
        if ($lastMonthRevenue > 0) {
            $revenueChange = (($monthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
        } elseif ($monthlyRevenue > 0) {
            $revenueChange = 100;
        }

        $monthlyVisits = Visit::whereBetween('visit_date', [$startOfMonth, $endOfMonth])->count();

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
        $lowStockCount = Medicine::whereColumn('stock', '<=', 'minimum_stock')->count();
        $stockHealth = $totalMedicines > 0 ? (($totalMedicines - $lowStockCount) / $totalMedicines) * 100 : 0;

        return view('admin.dashboard', compact(
            'totalPatients',
            'totalMedicines',
            'monthlyVisits',
            'monthlyRevenue',
            'revenueChange',
            'recentVisits',
            'lowStockList',
            'chartLabels',
            'chartData',
            'stockHealth',
            'lowStockCount'
        ));
    }
}