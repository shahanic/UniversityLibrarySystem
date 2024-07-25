<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\GenericPageController;
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\QuickLinksController;
use App\Http\Controllers\Admin\SubNavigationController;
use App\Models\User;
use App\Models\Navigation;
use App\Models\Articles;
use App\Models\SubMenu;
use App\Models\Faq;

Auth::routes();

Route::prefix('super-user')->group(function() {


    Route::get('{vue?}', [HomeController::class, 'index'])->where('vue', '[\/\w\.-]*');
});
Route::prefix('navigation')->group(function() {

    Route::get('{vue?}', [NavigationController::class, 'index'])->where('vue', '[\/\w\.-]*');

});
Route::prefix('subnav')->group(function() {

    Route::get('{vue?}', [SubNavigationController::class, 'index'])->where('vue', '[\/\w\.-]*');
});


Route::prefix('generic-pages')->group(function() {


    Route::get('{vue?}', [GenericPageController::class, 'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('article-pages')->group(function() {


    Route::get('{vue?}', [ArticlesController::class, 'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('images')->group(function() {


    Route::get('{vue?}', [ImagesController::class, 'index'])->where('vue', '[\/\w\.-]*');
});


Route::group(['prefix' => 'accounts'], function() {
    Route::get('{vue?}', [AccountsController::class, 'index'])->where('vue', '[\/\w\.-]*');

});

Route::prefix('faqs')->group(function() {


    Route::get('{vue?}', [FaqsController::class,'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('quick-links')->group(function() {


    Route::get('{vue?}', [QuickLinksController::class, 'index'])->where('vue', '[\/\w\.-]*');
});

Route::prefix('pages')->group(function() {
    Route::get('{vue?}', [PagesController::class, 'index'])->where('vue', '[\/\w\.-]*');
});



Route::post('/save-user', [AccountsController::class, 'saveUser']);
Route::post('/get-users', [AccountsController::class, 'getUsers']);
Route::post('/delete-users', [AccountsController::class, 'deleteUser']);

Route::post('/save-nav',[NavigationController::class, 'saveNav']);
Route::post('/get-navs',[NavigationController::class, 'getNavs']);
Route::post('/delete-navs',[NavigationController::class, 'deleteNavs']);

Route::post('/save-sub-nav',[SubNavigationController::class, 'saveSubNav']);
Route::post('/get-sub-navs',[SubNavigationController::class, 'getSubNavs']);
Route::post('/delete-sub-navs',[SubNavigationController::class, 'deleteSubNavs']);


Route::post('/save-article',[ArticlesController::class, 'saveArticle']);
Route::post('/get-articles',[ArticlesController::class, 'getArticles']);
Route::post('/delete-articles',[ArticlesController::class, 'deleteArticles']);


Route::post('/save-page',[PagesController::class, 'savePage']);
Route::post('/get-pages',[PagesController::class, 'getPages']);
Route::post('/delete-pages',[PagesController::class, 'deletePages']);

// Route::get('/subnavigation/{id}', [SubNavigationController::class, 'getSubNavs']);
Route::get('/get-sub-nav/{id}',[SubNavigationController::class, 'navsubnav']);
Route::get('/get-page/{id}',[PagesController::class, 'retrievePages']);


Route::post('/save-faq', [FaqsController::class, 'saveFaq']);
Route::post('/get-faqs', [FaqsController::class, 'getFaqs']);
Route::post('/delete-faqs', [FaqsController::class, 'deleteFaq']);