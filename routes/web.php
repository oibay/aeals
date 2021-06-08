<?php

use App\Models\Guest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GuestController;

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

Route::get('/logout', [\App\Http\Controllers\HomeController::class,'logout']);





Route::prefix('admin')->group(function () {


    Route::prefix('guests')->group(function () {
        Route::get('/',[GuestController::class,'index']);
        Route::post('/new',[GuestController::class,'postGuest'])->name('postGuest');
        Route::get('/edit/{id}',[GuestController::class,'editShow']);
        Route::post('/editGuest/{id}',[GuestController::class,'postEditGuest'])->name('postEditGuest');
        Route::post('searchGuest',[GuestController::class,'searchGuest'])->name('searchGuest');
    });

    Route::prefix('companies')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\CompanyController::class,'index']);
        Route::post('new',[\App\Http\Controllers\Admin\CompanyController::class,'postCompany'])->name('postCompany');
    });

    Route::prefix('archive')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\ArchiveController::class,'index']);

    });
});


Route::prefix('company')->group(function () {


    Route::prefix('guests')->group(function () {
        Route::get('/',[\App\Http\Controllers\Company\GuestController::class,'index']);
        Route::post('/new',[GuestController::class,'postGuest'])->name('postGuest');
        Route::get('/edit/{id}',[GuestController::class,'editShow']);
        Route::post('/editGuest/{id}',[GuestController::class,'postEditGuest'])->name('postEditGuest');
        Route::post('searchGuest',[GuestController::class,'searchGuest'])->name('searchGuest');
    });

    Route::prefix('companies')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\CompanyController::class,'index']);
        Route::post('new',[\App\Http\Controllers\Admin\CompanyController::class,'postCompany'])->name('postCompany');
    });

    Route::prefix('archive')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\ArchiveController::class,'index']);

    });
});
