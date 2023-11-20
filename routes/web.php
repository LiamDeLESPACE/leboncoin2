<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\TypeLogementController;
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

Route::get('/', [VilleController::class, "getVilles"]);

Route::post('/annonces', [AnnonceController::class, "showAnnonces"]);
Route::get('/annonces/{id}', [TypeLogementController::class, "getTypesLogement"]);