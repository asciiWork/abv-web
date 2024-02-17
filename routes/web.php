<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\web\PagesController;
use  App\Http\Controllers\web\LoginController;
use  App\Http\Controllers\web\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [PagesController::class, 'index'])->name('web.index');
Route::get('/about', [PagesController::class, 'about'])->name('web.about');
Route::get('/products', [PagesController::class, 'products'])->name('web.products');
Route::get('/contact', [PagesController::class, 'contact'])->name('web.contact');
Route::post('/check-contact', [PagesController::class, 'checkContactForm'])->name('web.check-contact');
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('web.privacy-policy');
Route::get('/terms-and-conditions', [PagesController::class, 'termsAndConditions'])->name('web.terms-and-conditions');
Route::get('/refund-and-cancellation-policy', [PagesController::class, 'refundAndCancellationPolicy'])->name('web.refund-and-cancellation-policy');
Route::get('/delivery-and-shipping-policy', [PagesController::class, 'deliveryAndShippingPolicy'])->name('web.delivery-and-shipping-policy');
Route::get('/product-category', [PagesController::class, 'productCategory'])->name('web.product-category');
Route::get('/categories', [PagesController::class, 'categories'])->name('web.categories');
Route::get('/product-details/{slug}', [PagesController::class, 'productDetails'])->name('web.product-details');
Route::get('/cart', [PagesController::class, 'cart'])->name('web.cart');
Route::get('/gallery', [PagesController::class, 'gallery'])->name('web.gallery');
Route::get('/my-account', [PagesController::class, 'myAccount'])->name('web.my-account');
Route::get('/my-address', [PagesController::class, 'myAddress'])->name('web.my-address');

Route::get('/login', [LoginController::class, 'login'])->name('web.login');
Route::post('/check-login', [LoginController::class, 'checkLogin'])->name('web.check-login');
Route::get('/register', [LoginController::class, 'register'])->name('web.register');
Route::post('/check-register', [LoginController::class, 'checkRegister'])->name('web.check-register');
/*cart*/
Route::post('/add-to-cart', [ProductsController::class,'addToCart'])->name('web.add-to-cart');
Route::get('/remove-cart', [ProductsController::class,'removeCart'])->name('remove-cart');
Route::post('/inc-dec-cart', [ProductsController::class,'incDecCart'])->name('inc-dec-cart');
Route::get('/checkout', [ProductsController::class, 'checkout'])->name('web.checkout');

