<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\web\PagesController;
use  App\Http\Controllers\web\LoginController;
use  App\Http\Controllers\web\ProductsController;
use  App\Http\Controllers\web\DashboardController;
use  App\Http\Controllers\admin\AdminController;
use  App\Http\Controllers\admin\UsersController;
use  App\Http\Controllers\admin\OrdersController;
use  App\Http\Controllers\admin\CategoriesController;
use  App\Http\Controllers\admin\AdminProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
/* ADMIN ROUTE */
Route::group(['prefix'=>'abv-admin','middleware' => ['auth','admin']], function(){
	Route::get('/', [AdminController::class,'index'])->name('admin-dashboard');
	Route::resource('admin-users', UsersController::class);
	Route::resource('admin-orders', OrdersController::class);
	Route::get('admin-orders/invoice/{id}', [OrdersController::class,'orderInvoice'])->name('admin-orders.invoice');
	Route::resource('admin-category', CategoriesController::class);
	Route::resource('admin-products', AdminProductsController::class);
	Route::get('/contact', [AdminController::class,'contact'])->name('admin-contacts');
});
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
Route::get('/product-category/{slug}', [PagesController::class, 'categoryDetails'])->name('web.categories-detail');
Route::get('/product-details/{slug}', [PagesController::class, 'productDetails'])->name('web.product-details');
Route::get('/cart', [PagesController::class, 'cart'])->name('web.cart');
Route::get('/gallery', [PagesController::class, 'gallery'])->name('web.gallery');
Route::post('/add-review', [PagesController::class, 'addReviewForm'])->name('web.add-review');

Route::group(['middleware' => ['auth']], function(){
	Route::get('/logout', [LoginController::class, 'getLogout'])->name("logout");
	Route::get('/my-account', [DashboardController::class, 'myAccount'])->name('web.my-account');
	Route::get('/my-orders', [DashboardController::class, 'myOrders'])->name('web.my-orders');
	Route::get('/view-order/{id}', [DashboardController::class, 'viewOrder'])->name("view-order");
	Route::get('/my-address', [DashboardController::class, 'myAddress'])->name('web.my-address');
	Route::post('update-address', [DashboardController::class, 'UpdateAddress'])->name("update-address");
	Route::get('/edit-account', [DashboardController::class, 'editAccount'])->name('web.edit-account');
	Route::post('update-account', [DashboardController::class, 'UpdateAccount'])->name("update-account");
	Route::get('/downloads', [DashboardController::class, 'downloads'])->name('web.downloads');
});
Route::get('/order-received/{id}/{key}', [pagesController::class, 'viewReceivedOrder'])->name("order-received");

Route::group(['middleware' => ['guest']], function(){
	Route::get('/login', [LoginController::class, 'login'])->name('web.login');
	Route::post('/check-login', [LoginController::class, 'checkLogin'])->name('web.check-login');
	Route::get('/register', [LoginController::class, 'register'])->name('web.register');
	Route::post('/check-register', [LoginController::class, 'checkRegister'])->name('web.check-register');
});
Route::get('/forgot-password', [PagesController::class,'forgotPassword'])->name('web.forgot-password');
Route::post('/forgot-password/post', [PagesController::class,'forgotPasswordPost'])->name('web.forgot-password.post');
Route::get('/reset-password/verify/{email}/{activation_key}', [PagesController::class,'resetPasswordLink'])->name('reset-password-link');
Route::post('/reset-password', [PagesController::class,'resetPassword'])->name('web.reset-password');
/*cart*/
Route::post('/add-to-cart', [ProductsController::class,'addToCart'])->name('web.add-to-cart');
Route::get('/remove-cart', [ProductsController::class,'removeCart'])->name('remove-cart');
Route::post('/inc-dec-cart', [ProductsController::class,'incDecCart'])->name('inc-dec-cart');
Route::get('/checkout', [ProductsController::class, 'checkout'])->name('web.checkout');
Route::post('/shipping-post', [ProductsController::class,'shoppingPost'])->name('web.shipping-post');
Route::get('/open-quick-view', [ProductsController::class,'openQuickView'])->name('open-quick-view');
Route::get('/catalog', [PagesController::class, 'catalog'])->name('web.catalog');

