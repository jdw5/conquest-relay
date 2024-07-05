<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Workbench\App\Http\Controllers\IndexController;
use Workbench\App\Http\Controllers\LanguageStoreController;

Route::get('/', IndexController::class)->name('index');
Route::get('/language', LanguageStoreController::class)->name('index');

