<?php

use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Page;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

/*Route::prefix('/{locale?}/')->middleware('locale')->group(function() {
    Route::get('/{slug}/{id}', 'Posts@show')
        ->where('id', '[0-9]+');

    Route::get('/', function () {
        $pages = Page::get();
        $pages = $pages->translate(app()->getLocale(), 'fallbackLocale');
        $posts = Post::get();
        $posts = $posts->translate(app()->getLocale(), 'fallbackLocale');

        return view('theme::welcome', compact('pages', 'posts'));
    });
});*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function()
    {
    Route::get('/', function () {
        $pages = Page::get();
        $pages = $pages->translate(app()->getLocale(), 'fallbackLocale');
        $posts = Post::get();
        $posts = $posts->translate(app()->getLocale(), 'fallbackLocale');

        return view('theme::welcome', compact('pages', 'posts'));
    });

    Route::get('/{slug}', 'Posts@show');
});



