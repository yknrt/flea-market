<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ExhibitionController;

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

Route::get('/', [ListController::class, 'index'])->name('home');
Route::get('/?page=mylist', [ListController::class, 'mylist'])->name('mylist');

Route::get('/item/:{item_id}', [ExhibitionController::class, 'index'])->name('item');
Route::get('/sell', [ExhibitionController::class, 'sell'])->name('sell');