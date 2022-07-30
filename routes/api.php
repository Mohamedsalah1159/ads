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
define('PAGINATION_COUNT', 10);
Route::group(['namespace'=> 'App\Http\Controllers'], function(){
    ################# start tags ###############
    Route::post('createTag', 'TagsController@store');
    Route::post('updateTag/{id}', 'TagsController@update');
    Route::get('getAllTags', 'TagsController@getAllTags');
    Route::post('removeTag/{id}', 'TagsController@destroy');
    #################end tags #################
    ################# start categories ###############
    Route::post('createCategory', 'CategoryController@store');
    Route::post('updateCategory/{id}', 'CategoryController@update');
    Route::get('getAllCategories', 'CategoryController@getAllCategories');
    Route::post('removeCategory/{id}', 'CategoryController@destroy');
    #################end categoris #################
    ################# start ads ###############
    Route::post('createAds', 'AdsController@store');
    Route::post('updateAds/{id}', 'AdsController@update');
    Route::post('changeStatus/{id}', 'AdsController@changestatus');
    Route::get('getAllAds', 'AdsController@getAllAds');
    Route::post('removeAds/{id}', 'AdsController@destroy');
    #################end ads #################
    ################# start advertiser ###############
    Route::post('createnews', 'NewsController@store');
    Route::post('updatenews/{id}', 'NewsController@update');
    Route::get('getallnews', 'NewsController@getAllNews');
    Route::post('removenews/{id}', 'NewsController@destroy');
    #################end advertiser #################
     
});
