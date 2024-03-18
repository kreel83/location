<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\ProduitsController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TarifsController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\MescollectionController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




    Route::get('/coucou2', [DashboardController::class,'coucou2'])->name('coucou');




// require __DIR__.'/auth.php';

