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



    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    // Route::get('/produits', [ProduitsController::class,'produits'])->name('produits');
    // Route::get('/collections', [MescollectionController::class,'collections'])->name('collections');
    // Route::get('/catalogue', [CatalogueController::class,'catalogue'])->name('catalogue');
    // Route::get('/catalogue/create/{catalogue_id}', [CatalogueController::class,'new'])->name('catalogue.new');
    // Route::post('/catalogue/create', [CatalogueController::class,'save'])->name('catalogue.create.post');
    // Route::get('/catalogue/choixAttribut', [CatalogueController::class,'choixAttribut'])->name('choixAttribut');
    
    // Route::get('/collections', [ProduitsController::class,'liste'])->name('collections.liste');
    // Route::get('/collections/add/{catalogue_id}', [ProduitsController::class,'add'])->name('collections.add');
    // Route::get('/collections/show/{collection_id}', [ProduitsController::class,'show'])->name('collections.show');
    
    
    Route::get('/produits/liste_produits', [ProduitsController::class,'liste_produits'])->name('produits.liste_produits');
    Route::get('/produits/create/{produit_id}', [ProduitsController::class,'new'])->name('produits.new');
    Route::post('/produits/photos', [ProduitsController::class,'photos_save'])->name('produits.photos_save');
    Route::get('/produits/photos/{produit_id}', [ProduitsController::class,'photos'])->name('produits.photos');
    Route::post('/produits/create', [ProduitsController::class,'create'])->name('produits.create');
    
    
    Route::get('/produits/duplicate/{id}', [ProduitsController::class,'duplicate'])->name('produits.duplicate');
    Route::get('/produits/categorieChoice', [ProduitsController::class,'categorieChoice'])->name('categorieChoice');
    Route::get('/categories', [CategoriesController::class,'index'])->name('categories');
    Route::get('/familles', [FamilleController::class,'index'])->name('familles');
    Route::get('/tarifs/{id}', [TarifsController::class,'index'])->name('tarifs');
    Route::get('/produits/addTarif', [TarifsController::class,'addTarif'])->name('addTarif');
    Route::get('/produits/deleteTarif', [TarifsController::class,'deleteTarif'])->name('deleteTarif');
    Route::post('/produits/add_produits', [ProduitsController::class,'add_produits'])->name('produits.add_produits');
    Route::get('/produits/add_caracteristique', [ProduitsController::class,'add_caracteristique'])->name('produits.add_caracteristique');

    Route::get('/profil', [ProfilController::class,'index'])->name('profil');
    Route::post('/profil', [ProfilController::class,'save'])->name('profil.save');
    Route::post('/addCategorie', [CategoriesController::class,'addCategorie'])->name('addCategorie');

    Route::get('/subscription', [SubscriptionController::class,'index'])->name('subscribe.index');
    // Route::get('/subscribe-checkout', [SubscriptionController::class, 'subscribeWithStripeCheckout'])->name('subscribe.checkout');
    Route::post('/subscribe-checkout', [SubscriptionController::class, 'subscribeWithStripeCheckout'])->name('subscribe.checkout');
    Route::get('/subscribe', [SubscriptionController::class, 'cardform'])->name('subscribe.cardform');
    Route::post('subscribe/create', [SubscriptionController::class, 'subscribe'])->name("subscribe.create");
    Route::get('/subscribe/result', [SubscriptionController::class, 'stripeRedirect'])->name('stripe.redirect');
    Route::get('subscribe/waiting', [SubscriptionController::class, 'stripeAttenteFinalisation'])->name("subscribe.waiting");
    Route::get('subscribe/success', [SubscriptionController::class, 'success'])->name("subscribe.success");
    Route::get('subscribe/cancel', [SubscriptionController::class, 'cancel'])->name("subscribe.cancel");
    Route::get('subscribe/cancel/end', [SubscriptionController::class, 'cancelsubscription'])->name("subscribe.cancelsubscription");
    Route::get('subscribe/resume', [SubscriptionController::class, 'resume'])->name("subscribe.resume");
    Route::post('subscribe/resume', [SubscriptionController::class, 'resumeSubscription'])->name("subscribe.resumesubscription");
    Route::get('subscribe/invoice/{invoice}', [SubscriptionController::class, 'invoice'])->name("subscribe.invoice");

    // Route::get('/store/edit/{store_id}', [StoreController::class,'edit'])->name('store.edit');
    // Route::post('/store/save', [StoreController::class,'save'])->name('store.save');

    Route::get('/store/edit/coordonnees/{store_id}', [StoreController::class,'editCoordonnees'])->name('store.edit.coordonnees');
    Route::post('/store/save/coordonnees', [StoreController::class,'saveCoordonnees'])->name('store.save.coordonnees');
    Route::post('/store/save/juridique', [StoreController::class,'saveJuridique'])->name('store.save.juridique');

    Route::get('/store/edit/conges/{store_id}', [StoreController::class,'editConges'])->name('store.edit.conges');
    Route::post('/store/store-zone', [StoreController::class,'storeZone'])->name('store.zone');
    Route::post('/store/conges', [StoreController::class,'storeConges'])->name('store.save.conges');

    Route::get('/store/edit/infos/{store_id}', [StoreController::class, 'editInfos'])->name('store.edit.infos');
    Route::post('/store/edit/infos', [StoreController::class, 'storeInfos'])->name('store.save.infos');

    Route::get('/store/edit/logo/{store_id}', [StoreController::class, 'editLogo'])->name('store.edit.logo');
    Route::post('/store/logo', [StoreController::class, 'logo'])->name('store.logo');
    Route::get('/store/logo/remove/{store_id}', [StoreController::class, 'removeLogo'])->name('store.logo.remove');

    Route::get('/store/edit/horaires/{store_id}', [StoreController::class, 'editHoraires'])->name('store.edit.horaires');
    Route::post('/store/edit/horaires', [StoreController::class, 'storeHoraires'])->name('store.save.horaires');

    Route::get('/store/edit/photos/{store_id}', [StoreController::class, 'editPhotos'])->name('store.edit.photos');

    Route::get('/store/edit/social/{store_id}', [StoreController::class, 'editSocial'])->name('store.edit.social');
    Route::post('/store/edit/social', [StoreController::class, 'storeSocial'])->name('store.save.social');

    Route::get('/contact', [ContactController::class,'index'])->name('contact');
    Route::post('/contact', [ContactController::class,'store'])->name('contact.store');




// require __DIR__.'/auth.php';

