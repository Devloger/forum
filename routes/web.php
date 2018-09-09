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
//\Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
//	var_dump($query->sql);
//});

Route::group(['middleware' => 'Groups', 'groups' => 'Admin'], function() {
    Route::get('/', 'IndexController@index')->name('index');
});

Route::resource('sekcja', 'SectionsController');
Route::get('sekcja/{sekcja}/temat', 'SectionsController@topic_create')->name('sekcja.topic.create');
Route::post('sekcja/{sekcja}/temat', 'SectionsController@topic_store')->name('sekcja.topic.store');

Route::resource('uzytkownik', 'UsersController');
Route::get('uzytkownik/{user}/wiadomosc', 'UsersController@message_create')->name('uzytkownik.message.create');

Route::resource('wiadomosci', 'MessagesController');
Route::resource('strona', 'PagesController');
Route::resource('reports', 'ReportsController');

Route::post('temat/post-edit', 'TopicsController@post_edit')->name('temat.post.edit');
Route::resource('temat', 'TopicsController');
Route::post('temat/like', 'TopicsController@post_like')->name('temat.post.like');
Route::post('temat/{temat}', 'TopicsController@post_store')->name('temat.post.store');

//////////////////////// Auth
Route::post('/login', ['uses' => 'MyAuth@login', 'as' => 'login']);
Route::get('/logout', ['uses' => 'MyAuth@logout', 'as' => 'logout']);