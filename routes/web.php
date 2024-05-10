<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReimburseController;
use App\Models\User;
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

Route::get('login', [AuthController::class,'index'])->name('login');
Route::post('proses_login', [AuthController::class,'proses_login'])->name('proses.login');
Route::post('logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('REIMBURSE', ReimburseController::class);
    Route::group(['middleware' => ['cek_login:DIREKTUR']], function () {
        Route::resource('DIREKTUR', DirekturController::class);
    });
    Route::group(['middleware' => ['cek_login:FINANCE']], function () {
        Route::resource('FINANCE', FinanceController::class);
    });
    Route::group(['middleware' => ['cek_login:STAFF']], function () {
        Route::resource('STAFF', StaffController::class);
    });
});
