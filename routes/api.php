<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SubRegionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PointOfSaleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/regions', [RegionController::class, 'index']);
Route::get('/subregions', [SubRegionController::class, 'index']);
Route::get('/locations', [LocationController::class, 'index']);

Route::get('/merchants', [MerchantController::class, 'index']);
Route::get('/pointOfSales', [PointOfSaleController::class, 'index']);