<?php

use App\Http\Controllers\Admin\HomeController;

Auth::routes();

Route::prefix('super-user')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});


Route::prefix('generic-pages')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('article-pages')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('images')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});


Route::prefix('accounts')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('faqs')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('quick-links')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});


