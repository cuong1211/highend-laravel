<?php

use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\BackendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\StatisticalController;
use App\Http\Middleware\CheckAdmin;

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

route::group(["namespace" => "frontend"], function () {
    Route::get('/', function () {
        return view('frontend.pages.home');
    });
});

Route::group(['namespace' => 'backend'], function () {
    route::get('/admin/login', [AuthController::class, 'login'])->name('backend.login');
    route::post('/admin/login', [AuthController::class, 'postLogin'])->name('backend.postLogin');
    route::get('/logout', [AuthController::class, 'getLogout'])->name('logout');
    Route::group(['middleware' => CheckAdmin::class, 'prefix' => 'admin'], function () {
        Route::get('/', [BackendController::class, 'index'])->name('admin');
        Route::resource('category', CategoryController::class);
        route::resource('user', UserController::class);
        route::resource('product', ProductController::class);
        route::resource('order', OrderController::class);
        route::resource('user', UserController::class);
        route::group(['prefix' => 'statistic'], function () {
            route::get('product', [StatisticalController::class, 'Product'])->name('statistic.product');
            route::get('sale', [StatisticalController::class, 'SaleReport'])->name('statistic.report');
        });
    });
});
route::get('/slug', [ProductController::class, 'getSlug'])->name('product.slug');
route::get(
    '/403',
    function () {
        return view('auth.403');
    }
)->name('403');
