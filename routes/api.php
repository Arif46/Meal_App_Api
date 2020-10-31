<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register','AuthController@register');
Route::post('/groupCreate','MainController@groupcreate');
Route::post('/postMonthsCreate','MainController@postmonthscreate');
Route::post('/preeMonthsCreate','MainController@createpreemonths');
Route::post('/payables','MainController@payablescreate');
Route::post('/dailyMealInput','MainController@postmealinputcreate');
Route::post('/GroupMembercreate','MainController@groupmemberinsert');
Route::post('/usermealcreate','MainController@insertusermeal');

Route::post('/UpdatePayables/{id}','UpdateController@updatepayables');
Route::post('/UpdateDailyMealInput/{id}','UpdateController@updatedailymealinput');
Route::post('/UpdateUser/{id}','UpdateController@Updateuser');


Route::get('/UserInformation/{phone_number}','GetController@getuser');
Route::get('/GroupMember/{group_id}','GetController@getgroupmember');
Route::get('/GetPayables/{group_id}','GetController@getpayables');
Route::get('/UserMealDate/{date}','GetController@getusermealdate');
Route::get('/getalluser','GetController@GetallUser');
Route::get('/Group_search/{keyword}','GetController@Searchgroup');
Route::get('/Member_search/{keyword}','GetController@Membergroup');

//bazar add
Route::post('/BazarInsert','MainController@bazarcreate');
Route::get('/Bazarlist/{group_id}','GetController@Getbazarlist');
Route::post('/BazarUpdate/{id}','UpdateController@bazarupdate');
//end bazar

//getuserlist by groupid
Route::get('/GetAllGroupUser/{group_id}','GetController@getallgroupuser');

//group invitaion
Route::post('/Groupinvitation','MainController@invitaioncreate');
Route::get('/Senderinfo/{sender_id}','GetController@getsenderinfo');
Route::get('/Receiverinfo/{receiver_id}','GetController@getreceiverinfo');
Route::get('/GroupInviationStatusChange/{id}','GetController@getstatuschange');
