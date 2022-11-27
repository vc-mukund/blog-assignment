<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
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
// for verify user route
Route::get('/verify/{token}', [RegisterController::class, 'VerifyUser'])->name('verify');

//all admin and user route
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // User management route
    Route::prefix('/user')->as('user.')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('index');
        Route::get('/search', [UserController::class, 'index'])->name('search');

        // Only Admin can access thie route
        Route::middleware('role:admin')->group(function () {
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::post('/update', [UserController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [UserController::class, 'delete'])->name('delete');
        });
    });
});
