<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Front\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index'])->name('front.index');
Route::get('/livesearch', [WelcomeController::class, 'livesearch'])->name('front.livesearch');
Route::post('/search', [WelcomeController::class, 'search'])->name('front.search');


// Route::get('/', function () {
//     return view('front.welcome');
// });

// Route::get('/dashboard', function () {
//     return view('welcome');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

/*
|--------------------------------------------------------------------------
| Super Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/import-cities', [SuperAdminController::class, 'importCities'])->name('superadmin.importcities');
Route::get('/import-jours-feries', [SuperAdminController::class, 'importJoursFeries'])->name('superadmin.importjourferies');
Route::post('/attribut/new', [SuperAdminController::class, 'newAttribut'])->name('superadmin.attribut.new');
Route::get('/categories', [SuperAdminController::class, 'categories'])->name('superadmin.categories');
Route::get('/categorie/{id}', [SuperAdminController::class, 'categorie'])->name('superadmin.categorie');
Route::post('/attribut/selection', [SuperAdminController::class, 'selectionAttribut'])->name('superadmin.attribut.selection');

require __DIR__.'/auth.php';

Route::get('/{categorie_link_rewrite}', [CategorieController::class, 'afficheCategorie'])->name('front.afficheCategorie');

