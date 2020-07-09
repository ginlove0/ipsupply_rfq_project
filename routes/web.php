<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('home');
//})->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/Vender', function () {
        return view('home');
    })->name('home');

    Route::get('/', function (){
        return view('welcome');
    })->name('welcome');


});

Route::group(['middleware' => ['is.admin']], function() {
    Route::get('/admin/createNewList', function(){
        return view ('create-list');
    });

    Route::get('/admin/requestList', function (){
        return view('request-list');
    });
});



Auth::routes();

Route::post('/login/custom', [
    'uses' => 'Auth\LoginController@login',
    'as' => 'login.custom'
]);

//Route::post('/register/custom', [
//    'uses' => 'Auth\RegisterController@register',
//    'as' => 'register.custom'
//]);

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register/notice', function (){
    return view('registered');
})->name('registered');


//Route::get('/home', 'HomeController@index')->name('home');
