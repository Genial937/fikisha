<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VehiclesController;
use Illuminate\Support\Facades\Artisan;
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

Artisan::call('migrate');
Route::resource('login', SigninController::class);
Route::resource('register', SignupController::class);
Route::resource('products', ProductsController::class);
Route::resource('cart', CartController::class);
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/count-cart', [CartController::class, 'count_cart'])->name('cart.count');
Route::get('/fetch/cart', [CartController::class, 'fetch_cart'])->name('cart.fetch');
Route::resource('checkout', CheckoutController::class);
Route::get('/fetch/products', [ProductsController::class, 'fetch'])->name('products.fetch');
Route::resource('users', UsersController::class);
Route::get('/fetch/users', [UsersController::class, 'fetch'])->name('users.fetch');
Route::resource('roles', RolesController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('/', DashboardController::class);
    Route::get('/statistics', [DashboardController::class, 'statistics'])->name('fetch.stats');

    Route::resource('orders', OrdersController::class);
    Route::resource('customers', CustomersController::class);
    Route::get('fetch/customers', [CustomersController::class, 'fetch_customers'])->name('customers.fetch');
    Route::resource('orders', OrdersController::class);
    Route::get('/fetch/orders', [OrdersController::class, 'fetch_orders'])->name('orders.fetch');
    Route::get('/fetch/order/details/{id}', [OrdersController::class, 'fetch_order_details'])->name('order.details');
    Route::resource('vehicles', VehiclesController::class);
    Route::get('/fetch/vehicles', [VehiclesController::class, 'fetch'])->name('vehicles.fetch');

    Route::get('/fetch/roles', [RolesController::class, 'fetch_roles'])->name('roles.fetch');
    Route::resource('documentation', DocumentationController::class);
    Route::resource('logout', LogoutController::class);
});