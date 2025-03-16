<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AuthController;

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
Route::get('/?page=mylist', [ListController::class, 'myList'])->name('myList');
Route::get('/item/:{item_id}', [ExhibitionController::class, 'index'])->name('item');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/mypage/profile', [ProfileController::class, 'update']);
    Route::get('/sell', [ExhibitionController::class, 'sell'])->name('sell');
    Route::post('/favorite', [ExhibitionController::class, 'favorite']);
    Route::post('/comment', [ExhibitionController::class, 'comment']);
    Route::get('/purchase/:{item_id}', [PurchaseController::class, 'index'])->name('purchase');
    Route::get('/purchase/address/:{item_id}', [PurchaseController::class, 'address'])->name('address');
});

Route::middleware('web')->group(function () {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/mypage/profile');
    })->middleware(['auth', 'signed'])->name('verification.verify');
});

Route::post('/login', [AuthController::class, 'store'])->name('login');