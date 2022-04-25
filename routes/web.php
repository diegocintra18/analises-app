<?php

use App\Http\Controllers\Bling\BlingController;
use App\Http\Controllers\Irroba\IrrobaController;
use App\Http\Controllers\Integrations\IntegrationsController;
use App\Http\Controllers\Products\ProductsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function(){
    Route::get('/integracoes', [IntegrationsController::class, 'index'])->name('integrations.index');
    //Route::get('/integracoes', function(){ return view('integrations.integrations');  });
});


Route::middleware(['auth'])->group(function () {
    Route::post('/salvar-usuario-irroba', [IrrobaController::class, 'store'])->name('irroba.store');
    Route::post('/salvar-usuario-bling', [BlingController::class, 'store'])->name('bling.store');
    Route::get('/importar-produtos-bling', [BlingController::class, 'syncProducts'])->name('bling.syncProducts');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/produtos', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/produto/{sku}', [ProductsController::class, 'show'])->name('products.details');
});

require __DIR__.'/auth.php';
