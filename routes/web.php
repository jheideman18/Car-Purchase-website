<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\RatingController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [FrontendController::class, 'index']);
Route::get('category', [FrontendController::class, 'category']);
Route::get('view-category/{slug}', [FrontendController::class, 'viewcategory']);
Route::get('category/{slug}/{car_name}', [FrontendController::class, 'productview']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('delete-cart-item', [CartController::class, 'deleteproduct']);


Route::middleware(['auth'])->group(function(){

Route::get('cart', [CartController::class, 'viewcart']);
Route::get('checkout', [CheckoutController::class, 'index']);
Route::post('place-order', [CheckoutController::class, 'placeorder']);

Route::post('add-rating', [RatingController::class , 'add']);

});
 Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard',[App\Http\Controllers\Admin\FrontendController::class, 'index']);
    Route::get('categories', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'add']);
    Route::post('/insert-category',[App\Http\Controllers\Admin\CategoryController::class, 'insert']);
    Route::get('edit-cate/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-cate/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    Route::get('products',[App\Http\Controllers\Admin\ProductController::class, 'index']);
    Route::get('add-products',[App\Http\Controllers\Admin\ProductController::class, 'add']);
    Route::post('insert-product',[App\Http\Controllers\Admin\ProductController::class, 'insert']);
    Route::get('edit-product/{id}',[App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('update-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
    Route::get('delete-product/{id}',[App\Http\Controllers\Admin\ProductController::class, 'destroy']);
    Route::get('users', [DashboardController::class, 'users']);
    Route::get('view-user/{id}', [DashboardController::class, 'viewuser']);

 });
