<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PointdeVenteController;
use App\Http\Controllers\TableRestaurantController;

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
    Route::prefix('pointdevente')->controller(PointdeVenteController::class)->group(function(){
        Route::get('/index','index')->name('ptvente.index');
        Route::get('/create','create')->name('ptvente.create');
        Route::post('/create','store')->name('ptvente.store');
        Route::get('/show/{id}','show')->name('ptvente.show');
        Route::put('/update/{id}','update')->name('ptvente.update');
        Route::delete('/delete/{id}','destroy')->name('ptvente.delete');
    });
    Route::prefix('menu')->controller(MenuController::class)->group(function(){
        Route::get('/index','index')->name('menu.index');
        Route::get('/create','create')->name('menu.create');
        Route::post('/create','store')->name('menu.store');
        Route::get('/show/{id}','show')->name('menu.show');
        Route::put('/update/{id}','update')->name('menu.update');
        Route::delete('/delete/{id}','destroy')->name('menu.delete');
    });
});
Route::middleware(['auth', 'user-access:manager'])->group(function (){
    Route::get('/manager', [HomeController::class, 'manager'])->name('manager');
    Route::prefix('table')->controller(TableRestaurantController::class)->group(function(){
        Route::get('/index','index')->name('table.index');
        Route::get('/create','create')->name('table.create');
        Route::post('/create','store')->name('table.store');
        Route::get('/show/{id}','show')->name('table.show');
        Route::put('/update/{id}','update')->name('table.update');
        Route::delete('/delete/{id}','destroy')->name('table.delete');
    });
});
Route::middleware(['auth', 'user-access:cuisinier'])->group(function (){
    Route::get('/cuisinier', [HomeController::class, 'cuisinier'])->name('cuisinier');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
Route::get('/scan/{restaurant}/{pointdevente}/{table}', [ScanController::class, 'scanTable'])->name('scan.table');

