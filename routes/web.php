<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('pages.home.home');
})->name('home');
Route::get('/contact', function () {
    return view('pages.contact.contact');
})->name('contact');
Route::get('/about', function () {
    return view('pages.about.about');
})->name('about');

Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/donors', [ProfileController::class, 'edit'])->name('donors');
    Route::get('/compaigns', [ProfileController::class, 'edit'])->name('compaigns');
    
});

require __DIR__.'/auth.php';
