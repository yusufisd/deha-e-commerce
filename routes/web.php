<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('front.home');
Route::get('/urun-detay/{slug?}',[ProductController::class,'detail'])->name('front.product.detail');
