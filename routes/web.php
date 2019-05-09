<?php

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

Route::get('/', function () {
    return view('bloghome');
});

Route::resource('blogs', 'BlogsController');
// Route::get('articles', 'ArticleController@index');
// Route::post('articles', 'ArticleController@post');
// Route::get('articles/{id}','ArticleController@show');
Auth::routes(['verify' => true]);

Route::get('createuserblog', 'UserblogController@createuserblog')->name('createuserblog.index');
Route::post('createuserblog', 'UserblogController@storeuserblog')->name("createuserblog.store");
Route::get('userblogs/{blog_id}', 'UserblogController@index')->name("userblog.index");
Route::get('userblogs/{blog_id}/entry/{entry_id}', 'UserblogController@show')->name('userblog.show');
Route::get('myaccount', 'UserblogController@create')->name('myaccount');
Route::post('myaccount', 'UserblogController@store')->name('myaccount.post');


Route::middleware(['verified'])->group(function(){
    Route::get('myaccount/reading', 'AdminController@reading')->name('myaccount.reading');
    Route::get('myaccount/index', 'AdminController@index')->name('myaccount.index');
    Route::get('myaccount/manage/{blogid}', 'AdminController@manage')->name('myaccount.manage');
    Route::get('myaccount/manage/{blogid}/edit/{articleid}', 'AdminController@edit')->name('myaccount.edit');
    Route::post('myaccount/manage/{blogid}/edit/{articleid}', 'AdminController@updatearticle')->name('myaccount.updatearticle');
    Route::get('myaccount/managetag', 'AdminController@managetag')->name('myaccount.managetag');
    Route::post('myaccount/managetag', 'AdminController@revisetag')->name('myaccount.revisetag');
    Route::post('myaccount/changeblog', 'AdminController@changeblog')->name('myaccount.changeblog');
});

Route::get('countbyredis', 'RedisController@index')->name('countbyredis');
Route::post('countbyredis', 'RedisController@update')->name('countup');

Route::get('notice', 'UserblogController@notice');

