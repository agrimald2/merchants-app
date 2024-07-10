<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MerchantController;

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
        Route::get('/merchants/all', [AdminController::class, 'getMerchants'])->name('admin.merchants.all');
        Route::get('/pointOfSales/all', [AdminController::class, 'getPointOfSales'])->name('admin.pointOfSales.all');
        
        Route::get('/merchants', [AdminController::class, 'merchantsIndex'])->name('admin.merchants');
        Route::get('/pointOfSales', [AdminController::class, 'pointOfSalesIndex'])->name('admin.pointOfSales');
        
        Route::get('/overview/merchants', [AdminController::class, 'overviewMerchants'])->name('admin.overviewMerchants');
    });

    Route::prefix('merchant')->group(function () {
        Route::get('/', [MerchantController::class, 'home'])->name('merchant.home');
        Route::get('/pendingVisits', [MerchantController::class, 'getPendingVisits'])->name('merchant.pendingVisits');
        Route::post('/startVisit', [MerchantController::class, 'startVisit'])->name('merchant.startVisit');
        Route::post('/isOnVisit', [MerchantController::class, 'isOnVisit'])->name('merchant.isOnVisit');
    });
});

Route::prefix('merchant')->group(function () {
    Route::get('/login', [MerchantController::class, 'login'])->name('merchant.login');
    Route::post('/loginWithDNI', [MerchantController::class, 'loginWithDNI'])->name('merchant.login.dni');
});

