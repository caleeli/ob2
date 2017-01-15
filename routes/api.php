<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('/{module}/{model1}/{id1?}/{model2?}/{id2?}/{model3?}/{id3?}/{model4?}/{id4?}/{model5?}/{id5?}',
           array('as' => 'api', 'uses' => 'ApiController@index'))/*->middleware('auth:api')*/;

Route::post('/{module}/{model1}/{id1?}/{model2?}/{id2?}/{model3?}/{id3?}/{model4?}/{id4?}/{model5?}/{id5?}',
           array('as' => 'api', 'uses' => 'ApiController@store'))/*->middleware('auth:api')*/;

Route::patch('/{module}/{model1}/{id1?}/{model2?}/{id2?}/{model3?}/{id3?}/{model4?}/{id4?}/{model5?}/{id5?}',
           array('as' => 'api', 'uses' => 'ApiController@update'))/*->middleware('auth:api')*/;

Route::put('/{module}/{model1}/{id1?}/{model2?}/{id2?}/{model3?}/{id3?}/{model4?}/{id4?}/{model5?}/{id5?}',
           array('as' => 'api', 'uses' => 'ApiController@update'))/*->middleware('auth:api')*/;

Route::delete('/{module}/{model1}/{id1?}/{model2?}/{id2?}/{model3?}/{id3?}/{model4?}/{id4?}/{model5?}/{id5?}',
           array('as' => 'api', 'uses' => 'ApiController@delete'))/*->middleware('auth:api')*/;

