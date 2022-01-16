<?php

use App\Http\Controllers\Irroba\IrrobaController;
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

Route::get('/integracoes', function () {
    return view('integrations.integrations');
})->middleware(['auth'])->name('integrations');

//Rotas de Configurações
Route::middleware(['auth'])->group(function () {
    Route::post('/salvar-usuario-irroba', [IrrobaController::class, 'store'])->name('irroba.store');
});

require __DIR__.'/auth.php';
