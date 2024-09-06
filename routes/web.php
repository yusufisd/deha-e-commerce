<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('front.index');
Route::get('/user',[UserController::class,'profile'])->name('front.user.detail');


// kullanıcı işlemleri
Route::controller(AuthController::class)->name('auth.')->group(function(){
    Route::get('/kayit-ol','register')->name('register');
    Route::post('/kayit-ol','registerSubmit')->name('registerSubmit');
    Route::get('/giris-yap','login')->name('login');
    Route::post('/giris-yap','loginSubmit')->name('loginSubmit');
    Route::post('/cikis-yap','logout')->name('logout');
});

// kategori işlemleri
Route::controller(CategoryController::class)->name('front.category.')->prefix('kategori')->group(function(){
    Route::get('/urunler/{slug?}','index')->name('detail');
});

// ürün işlemleri
Route::controller(ProductController::class)->name('front.product.')->prefix('urun')->group(function(){
    Route::get('/detay/{slug?}','detail')->name('detail');
});

// sepet işlemleri
Route::controller(CartController::class)->name('cart.')->prefix('sepet')->group(function(){
    Route::get('/','index')->name('index');
    Route::post('/sepete-ekle','addCart')->name('add');
    Route::post('/sepeti-bosalt','dropCart')->name('drop');
    Route::post('/urunu-cikar','extractionProduct')->name('extraction');
    Route::post('/urun-artir','incrementProduct')->name('increment');
    Route::post('/urun-azalt','decrementProduct')->name('decrement');
});

// arama işlemleri
Route::controller(SearchController::class)->name('search.')->prefix('ara')->group(function(){
    Route::post('/','index')->name('index');
});
