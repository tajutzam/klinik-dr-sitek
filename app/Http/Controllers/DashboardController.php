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
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        // Revenue
        $monthlyRevenue = Visit::whereBetween('visit_date', [$startOfMonth, $endOfMonth])->sum('total_cost');
        $lastMonthRevenue = Visit::whereBetween('visit_date', [$startOfLastMonth, $endOfLastMonth])->sum('total_cost');

        $revenueChange = 0;
        if ($lastMonthRevenue > 0) {
            $revenueChange = (($monthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
        } elseif ($monthlyRevenue > 0) {
            $revenueChange = 100;
        }

        // Visits
        $monthlyVisits = Visit::whereBetween('visit_date', [$startOfMonth, $endOfMonth])->count();
        $lastMonthVisits = Visit::whereBetween('visit_date', [$startOfLastMonth, $endOfLastMonth])->count();

        $visitsChange = 0;
        if ($lastMonthVisits > 0) {
            $visitsChange = (($monthlyVisits - $lastMonthVisits) / $lastMonthVisits) * 100;
        } elseif ($monthlyVisits > 0) {
            $visitsChange = 100;
        }

        // Recent & stock
        $recentVisits = Visit::with('patient')->latest('visit_date')->take(5)->get();
        $lowStockList = Medicine::whereColumn('stock', '<=', 'minimum_stock')->orderBy('stock', 'asc')->take(5)->get();
        $lowStockCount = Medicine::whereColumn('stock', '<=', 'minimum_stock')->count();
        $stockHealth = $totalMedicines > 0 ? (($totalMedicines - $lowStockCount) / $totalMedicines) * 100 : 0;

        // Daily visits chart (bulan ini)
        $dailyVisits = Visit::select(
            DB::raw('DATE(visit_date) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('visit_date', [$startOfMonth, $endOfMonth])
            ->groupBy('date')->orderBy('date')->get();

        $chartLabels = $dailyVisits->pluck('date');
        $chartData = $dailyVisits->pluck('total');

        // ── Monthly comparison (6 bulan terakhir) ──────────────────────────────
        $monthlyComparison = collect();

        for ($i = 5; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $start = $month->copy()->startOfMonth();
            $end   = $month->copy()->endOfMonth();

            $monthlyComparison->push([
                'label'   => $month->translatedFormat('M Y'), // "Jan 2025"
                'revenue' => Visit::whereBetween('visit_date', [$start, $end])->sum('total_cost'),
                'visits'  => Visit::whereBetween('visit_date', [$start, $end])->count(),
            ]);
        }

        $comparisonLabels  = $monthlyComparison->pluck('label');
        $comparisonRevenue = $monthlyComparison->pluck('revenue');
        $comparisonVisits  = $monthlyComparison->pluck('visits');
        // ───────────────────────────────────────────────────────────────────────

        return view('admin.dashboard', compact(
            'totalPatients',
            'totalMedicines',
            'monthlyVisits',
            'visitsChange',
            'monthlyRevenue',
            'revenueChange',
            'recentVisits',
            'lowStockList',
            'chartLabels',
            'chartData',
            'stockHealth',
            'lowStockCount',
            'comparisonLabels',
            'comparisonRevenue',
            'comparisonVisits',
        ));
    }
}