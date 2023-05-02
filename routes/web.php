<?php

use App\Http\Controllers\AghermeController;
use App\Http\Controllers\DetailOperationController;
use App\Http\Controllers\LieuController;
use App\Http\Controllers\OperationDonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiersController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth','role:admin' ])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('pages.dashboard.dashboard');
    })->name('dashboard');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //donors
    Route::get('/donors', [TiersController::class, 'index'])->name('donors');
    Route::post('/donors/store', [TiersController::class, 'store'])->name('donors.store');
    Route::patch('/donors/{id}', [TiersController::class, 'update'])->name('donors.update');
    Route::get('/donors/{id}', [TiersController::class, 'getDonorById'])->name('donors.id');
    Route::delete('/donors/{id}/delete', [TiersController::class, 'destroy'])->name('donors.destroy');

    //agherme
    Route::get('/aghermes', [AghermeController::class, 'index'])->name('aghermes');
    Route::post('/aghermes/store', [AghermeController::class, 'store'])->name('aghermes.store');
    Route::patch('/aghermes/{id}', [AghermeController::class, 'update'])->name('aghermes.update');
    Route::get('/aghermes/{id}', [AghermeController::class, 'getAghermeById'])->name('aghermes.id');
    Route::delete('/aghermes/{id}/delete', [AghermeController::class, 'destroy'])->name('aghermes.destroy');

    //location
    Route::get('/locations', [LieuController::class, 'index'])->name('locations');
    Route::post('/locations/store', [LieuController::class, 'store'])->name('locations.store');
    Route::patch('/locations/{id}', [LieuController::class, 'update'])->name('locations.update');
    Route::get('/locations/{id}', [LieuController::class, 'getLocationById'])->name('locations.id');
    Route::delete('/locations/{id}/delete', [LieuController::class, 'destroy'])->name('locations.destroy');

    //compaign
    Route::get('/compaigns', [OperationDonController::class, 'index'])->name('compaigns');
    Route::post('/compaigns/store', [OperationDonController::class, 'store'])->name('compaigns.store');
    Route::patch('/compaigns/{id}', [OperationDonController::class, 'update'])->name('compaigns.update');
    Route::get('/compaigns/{id}/get', [OperationDonController::class, 'getCompaignById'])->name('compaigns.id');
    Route::delete('/compaigns/{id}/delete', [OperationDonController::class, 'destroy'])->name('compaigns.destroy');


    //compaign-details
    Route::get('/compaigns/{id}', [OperationDonController::class, 'show'])->name('compaign-details');
    Route::post('/compaign-details/store', [DetailOperationController::class, 'store'])->name('compaign-details.store');
    Route::patch('/compaign-details/{id}', [DetailOperationController::class, 'update'])->name('compaign-details.update');
    Route::get('/compaign-details/{id}/get', [DetailOperationController::class, 'getCompaignDetailsById'])->name('compaign-details.id');
    Route::delete('/compaign-details/{id}/delete', [DetailOperationController::class, 'destroy'])->name('compaign-details.destroy');

});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('pages.home.home');
    })->name('home');
    Route::get('/contact', function () {
        return view('pages.contact.contact');
    })->name('contact');
    Route::get('/about', function () {
        return view('pages.about.about');
    })->name('about');
});

require __DIR__ . '/auth.php';