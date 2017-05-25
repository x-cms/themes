<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your Module. Just tell Your app the URIs it should respond to
| using a Closure or controller method. Build something great!
|
*/

use Illuminate\Routing\Router;

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function (Router $router) {
    $router->get('themes', 'ThemeController@index')->name('themes.index')->middleware('has-permission:view-themes');
    $router->post('themes', 'ThemeController@update')->name('themes.update')->middleware('has-permission:edit-themes');
});