<?php

use App\Http\Controllers\Backend\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Backend\Admin\User\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\Admin\Blog\BlogController;
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
Route::get('/verify/{token}', [RegisterController::class, 'VerifyUser'])
    ->name('verify');

//all admin and user route
Route::prefix('admin')->as('admin.')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    // User management route
    Route::prefix('/user')->as('user.')->group(function () {
        Route::get('/index', [UserController::class, 'index'])
            ->name('index');
        Route::get('/search', [UserController::class, 'index'])
            ->name('search');

        // Only Admin can access thie route for crud feature
        Route::middleware('role:admin')->group(function () {
            Route::get('/create', [UserController::class, 'create'])
                ->name('create');
            Route::post('/store', [UserController::class, 'store'])
                ->name('store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])
                ->name('edit');
            Route::post('/update', [UserController::class, 'update'])
                ->name('update');
            Route::get('/{id}/delete', [UserController::class, 'delete'])
                ->name('delete');
        });
    });

    //For blog listing route
    Route::prefix('/blog')->as('blog.')->group(function () {
        Route::get('/index', [BlogController::class, 'index'])
            ->name('index');
        Route::get('/search', [BlogController::class, 'index'])
            ->name('search');

        //Crud feature route
        Route::get('/create', [BlogController::class, 'create'])
            ->name('create');
        Route::post('/store', [BlogController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])
            ->name('edit');
        Route::post('/update', [BlogController::class, 'update'])
            ->name('update');
        Route::get('/{id}/delete', [BlogController::class, 'delete'])
            ->name('delete');

        //for admin
        Route::get('index/admin', [BlogController::class, 'indexAdmin'])
            ->name('index.admin')->middleware('role:admin');
        Route::post('/changeStatus', [BlogController::class, 'changeStatus']);
    });
});
