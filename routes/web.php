<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


require('landing.php');



Route::prefix('/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});