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


Route::group(['prefix' => 'forum/{forum_id}', 'where' => ['id' => '[0-9]+'], 'namespace' => 'Client', 'middleware' => 'check.forum'], function () {

    Auth::routes();

    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('/login', 'Auth\LoginController@authenticate');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@index')->name('password.reset');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendPasswordReset')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@index')->name('password.reset.token');
    Route::post('password/reset', 'Auth\ResetPasswordController@resetPassword')->name('password.request');

    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');

	Route::post('tags/autocomplete', 'TagController@autocomplete')->name('client.tags.autocomplete');

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('tags', 'TagController', ['only' => [
        'show'
    ]]);

    Route::resource('theme', 'ThemeController', [
        'except' => ['index', 'destroy']
    ]);
    Route::resource('messages', 'MessageController', [
        'except' => ['index', 'show', 'destroy']
    ]);
    Route::resource('answer', 'AnswerController', ['only' => [
        'show', 'index'
    ]]);
});


// Login from for admin and partner
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'prevent-back-history'], function () {
    Route::get('/', 'Auth\LoginController@index')->name('admin');
    Route::post('/', 'Auth\LoginController@login')->name('admin.login');
});

// Logout
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:admin;moderator;partner', 'prevent-back-history']], function () {
    Route::get('/logout', 'Auth\LoginController@logout')->name('admin.logout');
});

// Admin's routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:admin;moderator', 'prevent-back-history']], function () {

    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    // Partners
    Route::get('partner/{id}/login', 'PartnerController@login')->name('admin.partner.login');
    Route::resource('partners', 'PartnerController', ['as' => 'admin']);

    // Settings
    Route::resource('settings', 'SettingController', ['as' => 'admin']);
    Route::resource('decors', 'DecorController', ['as' => 'admin']);
    Route::get('get-decors/{decor_id}', 'DecorController@getDownload')->name('admin.decors.download');


    // Clients
    Route::get('clients/{client_id}/login', 'ClientController@login')->name('admin.clients.login');
    Route::get('clients', 'ClientController@index')->name('admin.clients.index');

});

// Partner's routes
Route::group(['prefix' => 'partner', 'namespace' => 'Partner', 'middleware' => ['role:partner', 'prevent-back-history',]], function () {

    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('partner.dashboard');
    Route::get('/', function () {
        return redirect()->route('partner.dashboard');
    });

    // Forums
    Route::resource('forums', 'ForumController', [
        'as' => 'partner',
        'except' => 'show',
    ]);

    // Themes
    Route::resource('themes', 'ThemeController', [
        'as' => 'partner',
        'except' => 'show',
    ]);

    // Messages
    Route::resource('messages', 'MessageController', [
        'as' => 'partner',
    ]);

    Route::get('{theme_id}/messages/', 'MessageController@index')->name('partner.messages.index');
    Route::post('{theme_id}/messages/', 'MessageController@store')->name('partner.messages.store');
    Route::delete('{theme_id}/messages/{id}', 'MessageController@destroy')->name('partner.messages.destroy');

    // Tags
    Route::post('tags/autocomplete', 'TagController@autocomplete')->name('partner.tags.autocomplete');

    Route::resource('tags', 'TagController', [
        'as' => 'partner',
        'except' => 'show',
    ]);

    // Users
    Route::get('clients/{client_id}/login', 'ClientController@login')->name('partner.clients.login');
    Route::get('clients', 'ClientController@index')->name('partner.clients.index');


    /*
     * Partners
     * Partner logout via admin
     */
    Route::get('logout', 'PartnerController@logout')->name('partner.logout');

});