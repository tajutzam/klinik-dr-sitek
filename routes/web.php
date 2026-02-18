<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineCategoryController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockMovementController;

require('landing.php');

Route::prefix('admin')
    ->group(function () {


        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');


        Route::get('patients/datatable', [PatientController::class, 'datatable'])
            ->name('patients.datatable');
        Route::resource('patients', PatientController::class);
        Route::get('medicines/datatable', [MedicineController::class, 'datatable'])
            ->name('medicines.datatable');
        Route::resource('medicines', MedicineController::class);


        Route::resource('medicine-categories', MedicineCategoryController::class);
        Route::get(
            'medicine-categories/data/datatable',
            [MedicineCategoryController::class, 'datatable']
        )
            ->name('medicine-categories.datatable');

        Route::resource('visits', VisitController::class);


        Route::resource('stock-movements', StockMovementController::class)
            ->only(['index', 'store', 'destroy']);


        Route::get('reports', [ReportController::class, 'index'])
            ->name('reports.index');

        Route::get('reports/visits', [ReportController::class, 'visits'])
            ->name('reports.visits');

        Route::get('reports/medicines', [ReportController::class, 'medicines'])
            ->name('reports.medicines');


        /*
        |--------------------------------------------------------------------------
        | User Management
        |--------------------------------------------------------------------------
        */
        Route::resource('users', UserController::class);
    });
