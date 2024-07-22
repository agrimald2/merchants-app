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
    return redirect()->route('merchant.login');
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
        Route::get('/visits/{merchant_id}/{date}', [AdminController::class, 'getVisitsFromMerchant'])->name('admin.visits');
        Route::get('/merchants/all', [AdminController::class, 'getMerchants'])->name('admin.merchants.all');
        Route::get('/pointOfSales/all', [AdminController::class, 'getPointOfSales'])->name('admin.pointOfSales.all');
        
        Route::get('/merchants', [AdminController::class, 'merchantsIndex'])->name('admin.merchants');
        Route::get('/pointOfSales', [AdminController::class, 'pointOfSalesIndex'])->name('admin.pointOfSales');
        Route::get('/visitsAsigned', [AdminController::class, 'visitsAsignedIndex'])->name('admin.visitsAsigned');
        Route::get('/locations', [AdminController::class, 'locationsIndex'])->name('admin.locations');

        
        Route::get('/getAsignedVisits', [AdminController::class, 'getAsignedVisits'])->name('admin.getAsignedVisits');
        
        Route::get('/overview/merchants', [AdminController::class, 'overviewMerchants'])->name('admin.overviewMerchants');
        Route::get('/generalVisitProgress/{date}', [AdminController::class, 'getGeneralVisitProgress'])->name('admin.generalVisitProgress');
        
        Route::post('/merchants/upload', [AdminController::class, 'uploadMerchantsExcel'])->name('admin.upload.merchants');
        Route::post('/pointOfSales/upload', [AdminController::class, 'uploadPointOfSalesExcel'])->name('admin.upload.pointOfSales');
        Route::post('/merchants-pointOfSales/upload', [AdminController::class, 'uploadMerchantsPointOfSalesExcel'])->name('admin.upload.merchants-pointOfSales');
        Route::post('/assignMerchantVisitManual', [AdminController::class, 'asignMerchantVisitManual'])->name('admin.assignMerchantVisitManual');
    });

    Route::prefix('merchant')->group(function () {
        Route::get('/', [MerchantController::class, 'home'])->name('merchant.home');
        Route::get('/pendingVisits', [MerchantController::class, 'getPendingVisits'])->name('merchant.pendingVisits');
        Route::get('/doneVisits', [MerchantController::class, 'getDoneVisits'])->name('merchant.doneVisits');
        Route::post('/startVisit', [MerchantController::class, 'startVisit'])->name('merchant.startVisit');
        Route::post('/endVisit', [MerchantController::class, 'endVisit'])->name('merchant.endVisit');
        Route::post('/isOnVisit', [MerchantController::class, 'isOnVisit'])->name('merchant.isOnVisit');
        Route::get('/visit/{id}', [MerchantController::class, 'viewVisit'])->name('merchant.view.visit');
    });
});

Route::prefix('merchant')->group(function () {
    Route::get('/login', [MerchantController::class, 'login'])->name('merchant.login');
    Route::post('/loginWithDNI', [MerchantController::class, 'loginWithDNI'])->name('merchant.login.dni');
});
