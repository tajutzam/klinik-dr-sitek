<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {




        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');


        Route::get('patients/datatable', [PatientController::class, 'datatable'])
            ->name('patients.datatable');
        Route::resource('patients', PatientController::class);
        Route::post('/ajax/patients-quick-store', [PatientController::class, 'quickStore'])->name('ajax.patients.store');
        Route::get('medicines/datatable', [MedicineController::class, 'datatable'])
            ->name('medicines.datatable');
        Route::resource('medicines', MedicineController::class);


        Route::resource('medicine-categories', MedicineCategoryController::class);
        Route::get(
            'medicine-categories/data/datatable',
            [MedicineCategoryController::class, 'datatable']
        )
            ->name('medicine-categories.datatable');



        Route::get('visits/datatable', [VisitController::class, 'datatable'])
            ->name('visits.datatable');
        Route::get('visits/summary', [VisitController::class, 'summary'])->name('visits.summary');

        Route::resource('visits', VisitController::class);


        Route::resource('stock-movements', StockMovementController::class)
            ->only(['index', 'store', 'destroy']);


        Route::get('reports', [ReportController::class, 'index'])
            ->name('reports.index');


        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/data', [ReportController::class, 'data'])->name('reports.data');
        Route::get('reports/print', [ReportController::class, 'print'])->name('reports.print');
        Route::get('reports/summary', [ReportController::class, 'summary'])
            ->name('reports.summary');



        Route::get('/ajax/patients', [VisitController::class, 'searchPatients'])
            ->name('ajax.patients');

        Route::get('/ajax/medicines', [VisitController::class, 'searchMedicines'])
            ->name('ajax.medicines');


        /*
        |--------------------------------------------------------------------------
        | User Management
        |--------------------------------------------------------------------------
        */
        Route::resource('users', UserController::class);
        Route::get('users-data', [UserController::class, 'data'])->name('users.data');
    });
