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

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');


 Route::middleware('auth:api')->group( function () {

    Route::post('/groupCreate','MainController@groupcreate');
    Route::post('/postMonthsCreate','MainController@postmonthscreate');
    Route::post('/preeMonthsCreate','MainController@createpreemonths');
    Route::post('/payables','MainController@payablescreate');
    Route::post('/dailyMealInput','MainController@postmealinputcreate');
    Route::post('/GroupMembercreate','MainController@groupmemberinsert');
    Route::post('/usermealcreate','MainController@insertusermeal');

    Route::post('/UpdatePayables/{id}','UpdateController@updatepayables');
    Route::post('/UpdateDailyMealInput/{id}','UpdateController@updatedailymealinput');

   
    Route::get('/UserInformation/{phone_number}','GetController@getuser');
    Route::get('/GroupMember/{group_id}','GetController@getgroupmember');
    Route::get('/GetPayables/{group_id}','GetController@getpayables');
    Route::get('/UserMealDate/{date}','GetController@getusermealdate');

      
});