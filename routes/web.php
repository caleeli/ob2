<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\GDrive;

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

Route::get('/', function () {
    return redirect('/documentacion/login.html');
});
Route::get('gdrive', function () {
    $drive = new GDrive;
    $authUrl = $drive->getAuthUrl();
    echo "<a class='login' href='$authUrl'>Conectar a Google Drive</a>";
})->name('gdrive');
Route::get('gdrive_cb', function (Request $request) {
    $drive = new GDrive;
    $token = $drive->fetchAccessToken($request->input('code'));
    Cache::forever('gdrive_token', $token);
    return redirect()->route('gdrive');
});

Route::get(
    '/gdrive/vuedit/{id}',
    function ($id) {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $id);
        return view('hoja_trabajo', ['document' => $gTemplate->parse()]);
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/vue-editor/file/{templeta}/{hojaTrabajo?}', 'VueEditorController@edit')->name('vue-editor');
Route::get('/vue-editor/list/{path}', 'VueEditorController@index')->name('vue-editor-list');
Route::get('/vue-editor/references', 'VueEditorController@listPDFs')->name('vue-editor-references');

Route::get('/report', 'ReportController@report')->name('report');
Route::get('/pdf', 'ReportController@pdf')->name('pdf');
