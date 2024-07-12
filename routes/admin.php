<?php

use App\Http\Controllers\Admin\HomeController;

Auth::routes();

Route::prefix('super-user')->group(function() {


    Route::get('{vue?}', [HomeController:: class, 'index'])->where('vue', '[\/\w\.-]*');
});
