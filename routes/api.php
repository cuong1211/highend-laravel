<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ColorController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\ProductTypeController;
use App\Http\Controllers\backend\StatisticalController;
use App\Http\Controllers\backend\TypeController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\frontend\UserController as FrontendUserController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/postman/csrf', function (Request $request) {
	return csrf_token();
});
Route::group(['prefix' => 'admin'], function () {
    route::get('/login', [AuthController::class, 'login'])->name('backend.login');
    route::post('/login', [AuthController::class, 'postLogin'])->name('backend.postLogin');
    route::put('order/status/{id}', [OrderController::class, 'updateStatus'])->name('order.update.status');
    Route::group(['middleware' => CheckAdmin::class], function () {
        Route::get('/', [BackendController::class, 'index'])->name('admin');
        Route::resource('category', CategoryController::class);
        route::resource('type', TypeController::class);
        route::resource('{type}/product', ProductController::class);
        route::resource('{product}/product_type', ProductTypeController::class);
        route::get('{product}/description', [ProductController::class,'getDescription'])->name('product.description');
        route::put('{product}/description', [ProductController::class,'postDescription'])->name('product.description');
        route::get('{product}/review', [ProductController::class,'getReview'])->name('product.review');
        route::put('{product}/review', [ProductController::class,'postReview'])->name('product.review');
        route::resource('order', OrderController::class);
        route::resource('user', UserController::class);
        route::resource('{product}/color', ColorController::class);
        route::group(['prefix' => 'statistic'], function () {
            route::get('product', [StatisticalController::class, 'Product'])->name('statistic.product');
            route::get('sale', [StatisticalController::class, 'SaleReport'])->name('statistic.report');
        });
    });
});