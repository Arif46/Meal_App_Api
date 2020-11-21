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

Route::post('/Profile_Update/{id}','UpdateController@profileupdate');


Route::get('/UserInformation/{phone_number}','GetController@getuser');
Route::get('/GroupMember/{group_id}','GetController@getgroupmember');
Route::get('/GetPayables/{group_id}','GetController@getpayables');
Route::get('/UserMealDate/{date}','GetController@getusermealdate');
Route::get('/getalluser','GetController@GetallUser');
Route::get('/Group_search/{keyword}','GetController@Searchgroup');
Route::get('/Member_search/{keyword}','GetController@Membergroup');
Route::get('/Daily_meal_input/{group_id}/{from}/{to}','GetController@getdailymealinput');

//bazar add
Route::post('/BazarInsert','MainController@bazarcreate');
Route::get('/Bazarlist/{group_id}/{from}/{to}','GetController@Getbazarlist');
Route::get('/GetAllBazarlist/{group_id}/{from}/{to}','GetController@getallbazarlist');
Route::post('/BazarUpdate/{id}','UpdateController@bazarupdate');
//end bazar

//getuserlist by groupid
Route::get('/GetAllGroupUser/{group_id}','GetController@getallgroupuser');

//getallgroupuserphonenumber

Route::get('/Getgroupuser/{phone_number}','GetController@getgroupuserphonenumber');

//group invitaion
Route::post('/Groupinvitation','MainController@invitaioncreate');
// Route::get('/Senderinfo/{sender_id}','GetController@getsenderinfo');
// Route::get('/Receiverinfo/{receiver_id}','GetController@getreceiverinfo');
Route::post('/GroupInviationStatusUpdate/{id}','GetController@updatestatuschange');

Route::get('/Invitationdataget/{user_id}','GetController@getinviationdatainfo');

//groupactive user

Route::get('/GroupActive/{phone_number}','GetController@getactiveuser');
