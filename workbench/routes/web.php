<?php

use Illuminate\Support\Facades\Route;
use Workbench\App\Http\Controllers\IndexController;
use Workbench\App\Http\Controllers\LanguageStoreController;

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

Route::middleware('web')->group(function () {
    Route::get('/index', IndexController::class)->name('index');
    Route::post('/language', LanguageStoreController::class)->name('index');
});
