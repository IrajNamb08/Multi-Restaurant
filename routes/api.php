<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommandeAPIController;
use App\Http\Controllers\Api\RestaurantAPIController;

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

Route::get('/{restaurant}/{pointdevente}', [RestaurantAPIController::class, 'show']);
Route::post('/commandes', [CommandeAPIController::class, 'store']);
Route::post('/commandes/etats', [CommandeAPIController::class, 'showMultipleStates']);
// Route::put('/commandes/{id}', [CommandeAPIController::class, 'update']); badge-info, badge-warning, badge-success