<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'user-access:admin'])->group(function (){
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
    Route::prefix('restaurant')->controller(RestaurantController::class)->group(function(){
        Route::get('/index','index')->name('resto.index');
        Route::get('/create','create')->name('resto.create');
        Route::post('/create','store')->name('resto.store');
        Route::get('/show/{id}','show')->name('resto.show');
        Route::put('/update/{id}','update')->name('resto.update');
        Route::delete('/delete/{id}','destroy')->name('resto.delete');
    });
});
Route::middleware(['auth', 'user-access:restoAdmin'])->group(function (){
    Route::get('/restoAdmin', [HomeController::class, 'restoAdmin'])->name('restoAdmin');
});
Route::middleware(['auth', 'user-access:manager'])->group(function (){
    Route::get('/manager', [HomeController::class, 'manager'])->name('manager');
});
Route::middleware(['auth', 'user-access:cuisinier'])->group(function (){
    Route::get('/cuisinier', [HomeController::class, 'cuisinier'])->name('cuisinier');
});


