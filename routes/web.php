<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin','admin-login');

Route::post('admin',[AdminController::class,'login']);

Route::get('admin-dashboard', [AdminController::class, 'dashboard']);