<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [GuestController::class, 'index']);
Route::get('/select-criteria-page', [GuestController::class, 'selectCriteria']);
Route::get('/weight', [GuestController::class, 'weightCriteria']);
Route::post('/rekomendasi', [GuestController::class, 'rekomendasi']);

