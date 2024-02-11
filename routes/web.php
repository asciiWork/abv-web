<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\web\PagesController;

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
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('web.privacy-policy');
Route::get('/terms-and-conditions', [PagesController::class, 'termsAndConditions'])->name('web.terms-and-conditions');
Route::get('/refund-and-cancellation-policy', [PagesController::class, 'refundAndCancellationPolicy'])->name('web.refund-and-cancellation-policy');
Route::get('/delivery-and-shipping-policy', [PagesController::class, 'deliveryAndShippingPolicy'])->name('web.delivery-and-shipping-policy');
Route::get('/product-category', [PagesController::class, 'productCategory'])->name('web.product-category');
Route::get('/categories', [PagesController::class, 'categories'])->name('web.categories');
Route::get('/product-details/{slug}', [PagesController::class, 'productDetails'])->name('web.product-details');
Route::get('/login', [PagesController::class, 'login'])->name('web.login');
Route::get('/register', [PagesController::class, 'register'])->name('web.register');
Route::get('/cart', [PagesController::class, 'cart'])->name('web.cart');
Route::get('/checkout', [PagesController::class, 'checkout'])->name('web.checkout');
Route::get('/gallery', [PagesController::class, 'gallery'])->name('web.gallery');
Route::get('/my-account', [PagesController::class, 'myAccount'])->name('web.my-account');
Route::get('/my-address', [PagesController::class, 'myAddress'])->name('web.my-address');
