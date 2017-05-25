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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/lang/datatable', function () {
    $minutes = 60;
    $content = file_get_contents(public_path('/js/Spanish.json'));
    $response = new \Illuminate\Http\Response($content, 200, array(
        'Cache-Control' => 'max-age='.($minutes*60).', public',
        'Content-Length' => strlen($content),
    ));

    $response->setLastModified(new \DateTime('now'));
    $response->setExpires(\Carbon\Carbon::now()->addMinutes($minutes));

    return $response;
});
Route::post('/uploadfile',
            array('as' => 'api', 'uses' => 'UploadFileController@upload'));
Route::get('/ping', array('as' => 'api', 'uses' => 'PingController@ping'));
Route::get('/empty', array('as' => 'api', 'uses' => 'PingController@data'));

Route::get('/pivot/{table}/{aggregator}/{measure}/{rows}/{cols}/{variables}',
           array('as' => 'api', 'uses' => 'PivotController@index'));

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

