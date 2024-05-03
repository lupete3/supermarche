<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDepenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CreanceController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\VenteController;
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

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}/update', [ClientController::class, 'update'])->name('clients.update');
    Route::post('/clients/{client}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/categories-depenses', [CategoryDepenseController::class, 'index'])->name('categories-depenses.index');
    Route::post('/categories-depenses/store', [CategoryDepenseController::class, 'store'])->name('categories-depenses.store');
    Route::get('/categories-depenses/create', [CategoryDepenseController::class, 'create'])->name('categories-depenses.create');
    Route::get('/categories-depenses/{categoryDepense}/edit', [CategoryDepenseController::class, 'edit'])->name('categories-depenses.edit');
    Route::put('/categories-depenses/{categoryDepense}/update', [CategoryDepenseController::class, 'update'])->name('categories-depenses.update');
    Route::post('/categories-depenses/{categoryDepense}/destroy', [CategoryDepenseController::class, 'destroy'])->name('categories-depenses.destroy');

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}/update', [ArticleController::class, 'update'])->name('articles.update');
    Route::post('/articles/{article}/destroy', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::post('/articles/import', [ArticleController::class, 'importArticles'])->name('articles.import');

    Route::get('/approvisionnements', [ApprovisionnementController::class, 'index'])->name('approvisionnements.index');
    Route::post('/approvisionnements/store', [ApprovisionnementController::class, 'store'])->name('approvisionnements.store');
    Route::get('/approvisionnements/create', [ApprovisionnementController::class, 'create'])->name('approvisionnements.create');
    Route::get('/approvisionnements/{approvisionnement}/edit', [ApprovisionnementController::class, 'edit'])->name('approvisionnements.edit');
    Route::put('/approvisionnements/{approvisionnement}/update', [ApprovisionnementController::class, 'update'])->name('approvisionnements.update');
    Route::post('/approvisionnements/{approvisionnement}/destroy', [ApprovisionnementController::class, 'destroy'])->name('approvisionnements.destroy');

    Route::get('/ventes', [VenteController::class, 'index'])->name('ventes.index');
    Route::get('/ventes/create', [VenteController::class, 'create'])->name('ventes.create');
    Route::get('/ventes/{vente}/edit', [VenteController::class, 'edit'])->name('ventes.edit');
    Route::put('/ventes/{vente}/update', [VenteController::class, 'update'])->name('ventes.update');
    Route::post('/ventes/{vente}/destroy', [VenteController::class, 'destroy'])->name('ventes.destroy');
    Route::POST('/ventes-print', [VenteController::class, 'print'])->name('ventes.print');
    Route::get('/ventes/{client}/paiement', [VenteController::class, 'store'])->name('ventes.paiements');
    Route::post('/add-to-cart', [VenteController::class, 'addToCart'])->name('ventes.addToCart');
    Route::post('/clear-cart', [VenteController::class, 'clearCart'])->name('ventes.clearCart');
    Route::post('/remove-from-cart', [VenteController::class, 'removeFromCart'])->name('ventes.removeFromCart');

    Route::get('/depenses', [DepenseController::class, 'index'])->name('depenses.index');
    Route::get('/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
    Route::post('/depenses/store', [DepenseController::class, 'store'])->name('depenses.store');
    Route::get('/depenses/{depense}/edit', [DepenseController::class, 'edit'])->name('depenses.edit');
    Route::put('/depenses/{depense}/update', [DepenseController::class, 'update'])->name('depenses.update');
    Route::post('/depenses/{depense}/destroy', [DepenseController::class, 'destroy'])->name('depenses.destroy');
    Route::post('/depenses-print', [DepenseController::class, 'print'])->name('depenses.print');

    Route::get('/creances', [CreanceController::class, 'index'])->name('creances.index');
    Route::get('/creances/create', [CreanceController::class, 'create'])->name('creances.create');
    Route::get('/paiements', [CreanceController::class, 'indexPaiement'])->name('paiements.index');
    Route::post('/paiements/{creance}/store', [CreanceController::class, 'store'])->name('paiements.store');
    Route::get('/paiements/{creance}/create', [CreanceController::class, 'show'])->name('creances.show');
    Route::get('/paiement/{paiement}/edit', [CreanceController::class, 'edit'])->name('paiements.edit');
    Route::put('/paiement/{paiement}/update', [CreanceController::class, 'update'])->name('paiements.update');
    Route::post('/paiement/{paiement}/destroy', [CreanceController::class, 'destroy'])->name('paiements.destroy');

    Route::get('/rapport-clients', [DashboardController::class, 'rapportClients'])->name('dashboard.clients');
    Route::get('/rapport-produits', [DashboardController::class, 'rapportProduits'])->name('dashboard.produits');
    Route::get('/statistiques-produits', [DashboardController::class, 'rapportProduitsStat'])->name('dashboard.produits-stat');
    Route::get('/rapport-achats', [DashboardController::class, 'rapportAchats'])->name('dashboard.achats');
    Route::get('/rapport-ventes', [DashboardController::class, 'rapportVentes'])->name('dashboard.ventes');
    Route::get('/rapport-depenses', [DashboardController::class, 'rapportDepenses'])->name('dashboard.depenses');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/utilisateurs', [DashboardController::class, 'usersIndex'])->name('dashboard.usersIndex');
    Route::get('/utilisateurs/create', [DashboardController::class, 'usersCreate'])->name('dashboard.usersCreate');
    Route::post('/utilisateurs/store', [DashboardController::class, 'usersStore'])->name('dashboard.usersStore');
    Route::get('/utilisateurs/{user}/edit', [DashboardController::class, 'usersEdit'])->name('dashboard.usersEdit');
    Route::post('/utilisateurs/{user}/update', [DashboardController::class, 'usersUpdate'])->name('dashboard.usersUpdate');
    Route::post('/utilisateurs/{user}/supprimer', [DashboardController::class, 'usersDelete'])->name('dashboard.usersDelete');

});

//Route to 404 page not found
Route::fallback(function(){
    $vieData['title'] = 'Erreur 404';
    return view('404')->with('viewData',$vieData);
});

require __DIR__.'/auth.php';
