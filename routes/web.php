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
Route::get('/', [\App\Http\Controllers\HomeController::class,'index']);

Route::get('/logout', [\App\Http\Controllers\HomeController::class,'logout']);


Route::prefix('admin')->group(function () {
    Route::get('/pdf/{id}', [\App\Http\Controllers\PdfController::class,'index']);
    Route::get('/',[\App\Http\Controllers\Admin\MainController::class,'index']);

    Route::get('/event',[\App\Http\Controllers\Admin\EventFoodController::class,'index']);
    Route::get('/event/food',[\App\Http\Controllers\Admin\EventFoodController::class,'eventFoods']);
    Route::get('/event/view/{id}',[\App\Http\Controllers\Admin\EventFoodController::class,'show']);
    Route::post('/postEvent',[\App\Http\Controllers\Admin\EventFoodController::class,'postEvent'])->name('postEvent');
    Route::prefix('guests')->group(function () {
        Route::get('/',[GuestController::class,'index']);
        Route::get('/remove/{id}',[GuestController::class,'remove']);
        Route::get('stlng',[GuestController::class,'stlng']);
        Route::get('/add/new',[GuestController::class,'showAddGuest']);
        Route::post('/new',[GuestController::class,'postGuest'])->name('postGuest');
        Route::get('/edit/{id}',[GuestController::class,'editShow']);
        Route::post('/editGuest/{id}',[GuestController::class,'postEditGuest'])->name('postEditGuest');
        Route::post('searchGuest',[GuestController::class,'searchGuest'])->name('searchGuest');
    });

    Route::prefix('companies')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\CompanyController::class,'index']);
        Route::get('/edit/{id}',[\App\Http\Controllers\Admin\CompanyController::class,'showEdit']);
        Route::post('new',[\App\Http\Controllers\Admin\CompanyController::class,'postCompany'])->name('postCompany');
        Route::post('editPost/{id}',[\App\Http\Controllers\Admin\CompanyController::class,'postEditCompany'])->name('postEditCompany');
    });

    Route::prefix('archive')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\ArchiveController::class,'index']);

    });

    Route::prefix('report')->group(function () {
        Route::get('/',[\App\Http\Controllers\ReportController::class,'index']);
        Route::post('/reportmonth',[\App\Http\Controllers\ReportController::class,'monthReport'])->name('reportMonth');
        Route::get('/weekly',[\App\Http\Controllers\ReportController::class,'weeklyReport']);
        Route::get('/dailyReport',[\App\Http\Controllers\ReportController::class,'dailyReport']);
        Route::get('/export',[\App\Http\Controllers\ReportController::class,'export']);
        Route::get('/stlng',[\App\Http\Controllers\ReportController::class,'stlngReport']);
        Route::get('/guests',[\App\Http\Controllers\ReportController::class,'guestReport']);
    });
});


Route::prefix('company')->group(function () {

    Route::get('/',[\App\Http\Controllers\Company\GuestController::class,'index']);
    Route::prefix('guests')->group(function () {
        Route::get('/',[\App\Http\Controllers\Company\GuestController::class,'index']);
        Route::get('/add/new',[\App\Http\Controllers\Company\GuestController::class,'showAddGuest']);
        Route::get('stlng',[\App\Http\Controllers\Company\GuestController::class,'stlng']);
        Route::post('/import',[\App\Http\Controllers\Company\GuestController::class,'importGuest'])->name('importGuest');
        Route::post('/new',[\App\Http\Controllers\Company\GuestController::class,'postGuest'])->name('postGuestCompany');
        Route::get('/edit/{id}',[\App\Http\Controllers\Company\GuestController::class,'editShow']);
        Route::post('/editGuest/{id}',[\App\Http\Controllers\Company\GuestController::class,'postEditGuest'])->name('postEditGuestCompany');
    });

    Route::prefix('companies')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\CompanyController::class,'index']);
        Route::post('new',[\App\Http\Controllers\Admin\CompanyController::class,'postCompany'])->name('postCompany');
    });

    Route::prefix('archive')->group(function () {
        Route::get('/',[\App\Http\Controllers\Admin\ArchiveController::class,'index']);

    });
});
