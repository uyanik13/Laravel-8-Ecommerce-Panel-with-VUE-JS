<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\LocaleFileController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;





Route::group(['middleware' => 'jwt.verify'], function () {



 //API RESOURCES
  Route::apiResource('admin','Api\ApiAdminController');
  Route::apiResource('post','Api\ApiPostController' );
  Route::apiResource('category','Api\ApiCategoryController');
  Route::apiResource('setting','Api\ApiSettingController');
  Route::apiResource('appointment','Api\ApiAppointmentController');
  Route::apiResource('users','Api\ApiUserController');
  Route::apiResource('custom','Api\ApiCustomController');
  Route::apiResource('gallery','Api\ApiGalleryController');
  Route::apiResource('order','Api\ApiOrderController');
  Route::apiResource('package','Api\ApiPackageController');




  //POST METHODS

  Route::post('addCategory', 'Api\ApiPostController@addCategory' );
  Route::post('copy-post/{id}', 'Api\ApiPostController@copyPost' );
  Route::post('updateCategory', 'Api\ApiPostController@updateCategory');
  Route::post('removeCategory','Api\ApiPostController@removeCategory' );
  Route::post('mediaSearch/{key}', 'Api\ApiGalleryController@mediaSearch');
  Route::post('text-editor-upload', 'Api\ApiGalleryController@textEdiorFileUpload' );



  //FOLLOW & UNFOLLOW
  Route::post('user/follow', 'Api\ApiUserController@follow' );
  Route::post('user/un-follow','Api\ApiUserController@unFollow');
  Route::get('user/my-follow-data','Api\ApiUserController@myFollowData' );
  Route::get('user/contacts', 'Api\ApiUserController@contacts');

  //LANG
  Route::post('lang/front-side-read',[LocaleFileController::class, 'frontSideRead'])->name('lang.front.read');
  Route::post('lang/front-side-write',[LocaleFileController::class, 'frontSideWrite'])->name('lang.front.write');
  Route::post('lang/back-side-read',[LocaleFileController::class, 'backSideRead'])->name('lang.back.read');
  Route::post('lang/back-side-write',[LocaleFileController::class, 'backSideWrite'])->name('lang.back.write');



  //GET METHODS


  Route::get('user', 'Api\ApiUserController@CurrentUser');




});


Route::group(['middleware' => 'guest:api'], function () {
  //POST METHODS

  Route::post('login', [AuthController::class, 'login'] )->name('api.login');
  Route::post('register', [RegisterController::class, 'registerWithApi']);

  Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
  Route::post('email/verify/{user}',[VerificationController::class, 'verify'] )->name('verification.verify');
  Route::post('email/resend', [VerificationController::class, 'resend']);
  Route::post('create_session', ['Api\ApiCustomController', 'create_session']);



  //Route::get('cities', [SettingController::class, 'getCities']);



});



Route::group(['middleware' => 'jwt.verify'], function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('refresh', [AuthController::class, 'checkToken'])->name('token.refresh');


  });
