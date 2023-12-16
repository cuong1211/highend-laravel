<?php

use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\BackendController;
use Illuminate\Support\Facades\Route;
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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::group(["namespace" => "frontend"], function () {
    route::get('/login', [FrontendController::class, 'login'])->name('login');
    route::get('/register', [FrontendController::class, 'register'])->name('register');
    route::post('/register', [AuthController::class, 'postRegister'])->name('register');
    route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot.password');
    route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('postForgotPassword');
    route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('reset.password');
    route::post('/reset-password', [AuthController::class, 'postResetPassword'])->name('postResetPassword');
    route::get('/checkout-success', [FrontendController::class, 'getCheckoutSuccess'])->name('checkout.success');
    route::get('/search', [FrontendController::class, 'getSearch'])->name('search');
    Route::get('/', [FrontendController::class, 'getHome'])->name('home');
    route::get('/shop/{category:slug}', [FrontendController::class, 'getCategory'])->name('category');
    route::get('/product/{product_type:slug}', [FrontendController::class, 'getProductDetail'])->name('product.detail');
    Route::group(['middleware' => CheckLogin::class], function () {
        route::get('/profile/{user}', [FrontendUserController::class, 'getProfile'])->name('profile');
        route::put('/profile/{user}', [FrontendUserController::class, 'editProfile'])->name('editProfile');
        route::get('/cart/{user}', [FrontendController::class, 'getCart'])->name('cart');
        route::post('/cart/{user}/{product}/{color}', [FrontendController::class, 'postCart'])->name('postCart');
        route::put('/cart/plus/{id}', [FrontendController::class, 'plusCart'])->name('frontend.cart.plus');
        route::put('/cart/minus/{id}', [FrontendController::class, 'minusCart'])->name('frontend.cart.minus');
        route::put('/cart/update/{id}', [FrontendController::class, 'updateCart'])->name('frontend.cart.update');
        route::delete('/cart/delete/{id}', [FrontendController::class, 'deleteCart'])->name('frontend.cart.delete');
        route::post('/checkout', [FrontendController::class, 'postCheckout'])->name('postCheckout');
        route::get('/checkout/{order}/complete', [FrontendController::class, 'getCheckoutComplete'])->name('frontend.order_complete');
        route::get('/order-manager/{user}', [FrontendOrderController::class, 'getOrderManager'])->name('frontend.ordermanager');
        route::put('/order-manager/{user}/{order}', [FrontendOrderController::class, 'updateOrder'])->name('frontend.ordermanager.update');
        route::get('/logout', [AuthController::class, 'getLogout'])->name('logout');
    });
});
route::get('/loginsucces', function () {
    return view('auth.login_success');
})->name('loginsuccess');

Route::group(['prefix' => 'admin'], function () {
    route::get('/login', [AuthController::class, 'login'])->name('backend.login');
    route::post('/login', [AuthController::class, 'postLogin'])->name('backend.postLogin');
    route::put('order/status/{id}', [OrderController::class, 'updateStatus'])->name('order.update.status');
    Route::group(['middleware' => CheckAdmin::class], function () {
        Route::get('/', [BackendController::class, 'index'])->name('admin');
        Route::resource('category', CategoryController::class);
        route::resource('type', TypeController::class);
        route::resource('product', ProductController::class);
        route::resource('{product:slug}/product_type', ProductTypeController::class);
        route::resource('order', OrderController::class);
        route::resource('user', UserController::class);
        route::resource('{product:slug}/color', ColorController::class);;
        route::group(['prefix' => 'statistic'], function () {
            route::get('product', [StatisticalController::class, 'Product'])->name('statistic.product');
            route::get('sale', [StatisticalController::class, 'SaleReport'])->name('statistic.report');
        });
    });
});
route::get('/slug', [BackendController::class, 'getSlug'])->name('slug');
Route::get('image/{image:image}', [BackendController::class, 'getImage'])->name('image');
route::get(
    '/403',
    function () {
        return view('auth.403');
    }
)->name('403');
