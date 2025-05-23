<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DealingController;

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

Route::get('/', [ItemController::class, 'index'])->name('home');
Route::get('/item/:{item_id}', [ItemController::class, 'productView'])->name('item');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/mypage/profile', [ProfileController::class, 'update']);
    Route::get('/sell', [ItemController::class, 'sell'])->name('sell');
    Route::post('/sell/exhibition', [ItemController::class, 'store']);
    Route::post('/favorite', [ItemController::class, 'favorite']);
    Route::post('/comment', [ItemController::class, 'comment']);
    Route::get('/purchase/:{item_id}', [PurchaseController::class, 'index'])->name('purchase');
    Route::get('/purchase/address/:{item_id}', [PurchaseController::class, 'address'])->name('address');
    Route::get('/purchase/address/update', [PurchaseController::class, 'update'])->name('address.update');
    Route::post('/purchase/checkout', [PurchaseController::class, 'checkout']);
    Route::get('/chat', [DealingController::class, 'index'])->name('chat');
    Route::post('/chat/store', [DealingController::class, 'store']);
    Route::get('/chat/edit', [DealingController::class, 'edit']);
    Route::get('/chat/delete', [DealingController::class, 'delete']);
    Route::post('/chat/review', [DealingController::class, 'review']);
});

Route::middleware('web')->group(function () {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/mypage/profile');
    })->middleware(['auth', 'signed'])->name('verification.verify');
});

Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});