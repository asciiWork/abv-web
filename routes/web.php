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
