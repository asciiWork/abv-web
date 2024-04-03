<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\web\PageController;
use  App\Http\Controllers\web\LoginController;
use  App\Http\Controllers\web\ProductsController;
use  App\Http\Controllers\web\DashboardController;
use  App\Http\Controllers\web\RazorpayPaymentController;
use  App\Http\Controllers\admin\AdminController;
use  App\Http\Controllers\admin\UsersController;
use  App\Http\Controllers\admin\OrdersController;
use  App\Http\Controllers\admin\CategoriesController;
use  App\Http\Controllers\admin\AdminProductsController;
use  App\Http\Controllers\admin\QuotationsController;
use  App\Http\Controllers\admin\AdminLoginController;
use  App\Http\Controllers\admin\ClientsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
/* ADMIN ROUTE */
Route::prefix('/admin')->controller(AdminLoginController::class)->group(function () {
        Route::get('/', 'getLogin')->name("admin_login");
        Route::get('/login', 'getLogin')->name("admin_login");
        Route::post('/login', 'loginPost')->name("admin_login_post");
        Route::get('/logout', 'getLogout')->name("admin_logout");
    });
Route::group(['prefix'=>'admin','middleware' => ['admin']], function(){
	Route::get('/dashboard', [AdminController::class,'index'])->name('admin-dashboard');
	Route::get('admin-users/data', [UsersController::class,'data'])->name('admin-users.data');
	Route::resource('admin-users', UsersController::class);

	Route::get('admin-clients/print-address', [ClientsController::class, 'printAddress'])->name('admin-clients.print-address');
	Route::get('admin-clients/data', [ClientsController::class,'data'])->name('admin-clients.data');
	Route::resource('admin-clients', ClientsController::class);

	Route::get('admin-quotations/last-prices', [QuotationsController::class, 'lastPrices'])->name('admin-quotations.lastPrices');
	Route::get('admin-quotations/make-invoice/{id}', [QuotationsController::class, 'makeInvoice'])->name('admin-quotations.make-invoice');
	Route::get('admin-quotations/data', [QuotationsController::class,'data'])->name('admin-quotations.data');
	Route::resource('admin-quotations', QuotationsController::class);


	Route::get('admin-orders/data', [OrdersController::class,'data'])->name('admin-orders.data');
	Route::resource('admin-orders', OrdersController::class);
	Route::get('admin-orders/invoice/{id}', [OrdersController::class,'orderInvoice'])->name('admin-orders.invoice');
	Route::get('admin-category/data', [CategoriesController::class,'data'])->name('admin-category.data');
	Route::resource('admin-category', CategoriesController::class);
	Route::get('admin-products/data', [AdminProductsController::class,'data'])->name('admin-products.data');
	Route::resource('admin-products', AdminProductsController::class);
	Route::resource('quatations', QuatationsController::class);
	Route::get('/contact', [AdminController::class,'contact'])->name('admin-contacts');
	Route::get('/contact-quick-view', [AdminProductsController::class,'contactQuickView'])->name('contact-quick-view');
});
Route::get('/', [PageController::class, 'index'])->name('web.index');
Route::get('/about', [PageController::class, 'about'])->name('web.about');
Route::get('/search-product', [PageController::class, 'searchProduct'])->name('web.search-product');
Route::get('/products', [PageController::class, 'products'])->name('web.products');
Route::get('/contact', [PageController::class, 'contact'])->name('web.contact');
Route::post('/check-contact', [PageController::class, 'checkContactForm'])->name('web.check-contact');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('web.privacy-policy');
Route::get('/terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('web.terms-and-conditions');
Route::get('/refund-and-cancellation-policy', [PageController::class, 'refundAndCancellationPolicy'])->name('web.refund-and-cancellation-policy');
Route::get('/delivery-and-shipping-policy', [PageController::class, 'deliveryAndShippingPolicy'])->name('web.delivery-and-shipping-policy');
Route::get('/product-category', [PageController::class, 'productCategory'])->name('web.product-category');
Route::get('/categories', [PageController::class, 'categories'])->name('web.categories');
Route::get('/product-category/{slug}', [PageController::class, 'categoryDetails'])->name('web.categories-detail');
Route::get('/product-details/{slug}', [PageController::class, 'productDetails'])->name('web.product-details');
Route::get('/cart', [PageController::class, 'cart'])->name('web.cart');
Route::get('/gallery', [PageController::class, 'gallery'])->name('web.gallery');
Route::post('/add-review', [PageController::class, 'addReviewForm'])->name('web.add-review');

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
Route::get('/order-pay/{id}/{key}', [PageController::class, 'viewOrderPay'])->name("order-pay");
Route::get('/order-received/{id}/{key}', [PageController::class, 'viewReceivedOrder'])->name("order-received");

Route::group(['middleware' => ['guest']], function(){
	Route::get('/login', [LoginController::class, 'login'])->name('web.login');
	Route::post('/check-login', [LoginController::class, 'checkLogin'])->name('web.check-login');
	Route::get('/register', [LoginController::class, 'register'])->name('web.register');
	Route::post('/check-register', [LoginController::class, 'checkRegister'])->name('web.check-register');
});
Route::get('/forgot-password', [PageController::class,'forgotPassword'])->name('web.forgot-password');
Route::post('/forgot-password/post', [PageController::class,'forgotPasswordPost'])->name('web.forgot-password.post');
Route::get('/reset-password/verify/{email}/{activation_key}', [PageController::class,'resetPasswordLink'])->name('reset-password-link');
Route::post('/reset-password', [PageController::class,'resetPassword'])->name('web.reset-password');
/*cart*/
Route::post('/add-to-cart', [ProductsController::class,'addToCart'])->name('web.add-to-cart');
Route::get('/remove-cart', [ProductsController::class,'removeCart'])->name('remove-cart');
Route::post('/inc-dec-cart', [ProductsController::class,'incDecCart'])->name('inc-dec-cart');
Route::get('/checkout', [ProductsController::class, 'checkout'])->name('web.checkout');
Route::post('/shipping-post', [ProductsController::class,'shoppingPost'])->name('web.shipping-post');
Route::get('/open-quick-view', [ProductsController::class,'openQuickView'])->name('open-quick-view');
Route::get('/catalog', [PageController::class, 'catalog'])->name('web.catalog');

Route::post('/razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');