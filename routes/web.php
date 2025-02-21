<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\TransaksiController;

// LOGIN - LOGOUT
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// USER
Route::get('user', [UserController::class, 'index'])->name('user');
Route::post('user.store', [UserController::class, 'store'])->name('user.store');
Route::put('user/update/{id}', [UserController::class, 'updateUser'])->name('user.update');
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.delete');

// WALLET
Route::get('wallet', [PayController::class, 'index'])->name('wallet');
Route::get('/get-recipient-name/{id}', [PayController::class, 'getRecipientName']);

// Aksi
Route::post('wallet/topup', [PayController::class, 'topUp'])->name('wallet.topup');
Route::post('wallet/transfer', [PayController::class, 'transfer'])->name('wallet.transfer');
Route::post('wallet/withdraw', [PayController::class, 'withdraw'])->name('wallet.withdraw');

// Aksi (Bank Mini User)
Route::get('wallet/approvals', [PayController::class, 'approvals'])->name('wallet.approvals');
Route::post('wallet/approve/{id}', [PayController::class, 'approve'])->name('wallet.approve');
Route::post('wallet/reject/{id}', [PayController::class, 'reject'])->name('wallet.reject');
Route::post('wallet/bank-mini-topup', [PayController::class, 'bankMiniTopUp'])->name('wallet.bankMiniTopUp');
Route::post('wallet/bank-mini-withdraw', [PayController::class, 'bankMiniWithdraw'])->name('wallet.bankMiniWithdraw');
Route::get('/get-user-name/{id}', function ($id) {
    $user = \App\Models\User::find($id);
    if ($user) {
        if (in_array($user->role_id, [1, 2])) {
            return response()->json(['name' => 'Tidak ada User']);
        }
        return response()->json(['name' => $user->name]);
    }
    return response()->json(['name' => null]);
});


// Transaksi
Route::get('transaction', [TransaksiController::class, 'index'])->name('transaction');

Route::get('/', [IndexController::class, 'index'])->name('index');
