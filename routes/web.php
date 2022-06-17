<?php

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

require __DIR__ . '/frontend.php';

require __DIR__ . '/backend.php';

Route::post('/currency_load',[\App\Http\Controllers\CurrencyController::class,'currencyLoad'])->name('currency.load');

//Terms
Route::get('/condition',[\App\Http\Controllers\Frontend\ConditionController::class,'condition'])->name('condition');

//return
Route::get('/return',[\App\Http\Controllers\Frontend\ReturnController::class,'return'])->name('return');

//return
Route::get('/prive',[\App\Http\Controllers\Frontend\PriveController::class,'prive'])->name('prive');


Auth::routes(['register'=>false]);
