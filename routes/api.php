<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ipsupply/checkUserRole', 'UserController@checkUserRole');

Route::get('ipsupply/addModelDetail/{detail}/{group}', 'ModelDetailController@addModelToDB')
    ->where('detail', '(.*)');

Route::get('ipsupply/getModelDetail/{userId}', 'ModelDetailController@getModelDetail');

Route::get('ipsupply/addQuotationToDb/{quotationList}/{userId}/{freeShipping}', 'QuotationController@addQuotationToDb')
    ->where('quotationList', '(.*)');

Route::get('ipsupply/deleteModelFromDB/{modelId}', 'ModelDetailController@deleteModel');
