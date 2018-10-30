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
Route::get('/vue-editor/download/{templeta}/{tarea}/{indice}/{nombre}', 'VueEditorController@viewTarea')->name('vue-download');
Route::get('/vue-editor/tarea/{templeta}/{tarea}/{indice}/{nombre}', 'VueEditorController@editTarea')->name('vue-tarea');
Route::get('/pdfhl/edit/{storage?}/{path1?}/{path2?}/{path3?}/{path4?}', 'VueEditorController@editPDF')->name('vue-edit-pdf');
Route::get('/pdfhl/view/{storage?}/{path1?}/{path2?}/{path3?}/{path4?}', 'VueEditorController@viewPDF')->name('vue-view-pdf');
Route::get('/pdfhl/list/{storage}/{path1?}/{path2?}/{path3?}/{path4?}', 'VueEditorController@listPDFStorage')->name('vue-edit-pdf');
Route::put('/pdfhl/mark/{storage}/{path1?}/{path2?}/{path3?}/{path4?}', 'VueEditorController@markPDF')->name('vue-mark-pdf');

Route::get('/report', 'ReportController@report')->name('report');
Route::get('/pdf', 'ReportController@pdf')->name('pdf');

Route::get('/manager', 'ManagerController@index')->name('manager');
Route::post('/manager/restorebk', 'ManagerController@restoreBK')->name('restorebk');


Route::get('/angie', function () {
    $folder = 'documentacion/tareas/unir_excel';
    $path = public_path($folder);
    if (!file_exists($path)) {
        mkdir($path, 0777);
    }
    echo '<form action="angie/procesar">';
    echo '<h2>Archivos a ser cargados</h2>';
    echo '<h4>Carpeta: ',$folder,'</h4>';
    dump(glob($path.'/*'));
    echo '<h2>Tabla destino</h2>';
    echo '<input name="tabla">';
    echo '<button>Procesar</button>';
    echo '</form>';
});

Route::get('/angie/procesar', function () {
    $tabla = request()->input('tabla');
    if (!$tabla) {
        dump('Nombre de tabla invalida');
        echo '<a href="../angie">Volver</a>';
        return;
    }
    $folder = 'documentacion/tareas/unir_excel';
    $path = public_path($folder);

    $pdo = \DB::getPdo();
    $pdo->exec('drop table ' . $tabla);
    foreach (glob($path . '/*') as $file) {
        $excelLoader = new \App\Xls2Csv2Db2($tabla);
        $excelLoader->import($tabla, $file);
    }
    echo '<h2>Listo!</h2>';
    dump($pdo->query('select count(*) as "Total registros" from ' . $tabla)->fetch(PDO::FETCH_ASSOC));
    echo '<a href="../angie">Volver</a>';
});
