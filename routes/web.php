<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//administrator
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('index', [ProfileController::class, 'index'])->name('profile_index');
        Route::post('update', [ProfileController::class, 'update'])->name('profile_update');
        Route::post('UpdateImg', [ProfileController::class, 'UpdateImg'])->name('profile_UpdateImg');
        Route::post('UpdatePass', [ProfileController::class, 'UpdatePass'])->name('profile_UpdatePass');
        Route::post('destroy', [ProfileController::class, 'destroy'])->name('user_destroy');
    });


    //users
    Route::group(['prefix' => 'users'], function () {
        Route::get('index', [UserController::class, 'index'])->name('users_index');
    });



    //cars
    Route::group(['prefix' => 'cars'], function () {
        Route::get('index', [CarController::class, 'index'])->name('cars-index');
        Route::get('create', [CarController::class, 'create'])->name('cars-create');
        Route::get('edit/{id}', [CarController::class, 'edit'])->name('cars-edit');
        Route::get('destroy/{id}', [CarController::class, 'destroy'])->name('cars-destroy');

        Route::post('store', [CarController::class, 'store'])->name('cars-store');
        Route::post('update', [CarController::class, 'update'])->name('cars-update');
    });


    
});
