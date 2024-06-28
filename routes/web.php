<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Home');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/uploadData', [AdminController::class, 'uploadDataIndex'])->name('admin.uploadData');
        Route::get('/visits', [AdminController::class, 'visitList'])->name('admin.visits');
        Route::get('/dailyProgress', [AdminController::class, 'viewDailyProgress'])->name('admin.dailyProgress');
        Route::get('/merchants/all', [AdminController::class, 'getMerchants'])->name('admin.merchants.all');
        
        Route::get('/merchants', [AdminController::class, 'merchantsIndex'])->name('admin.merchants');
    });
});
