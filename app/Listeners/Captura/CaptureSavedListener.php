<?php
namespace App\Listeners\Captura;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Captura\Capture;
use App\Events\Captura\CaptureSaved;

class CaptureSavedListener
{
    public $capture = null;
    public function handle(CaptureSaved $event)
    {
        if (empty($event->capture->file)) {
            return;
        }
        $import = new \App\Xls2Csv2Db;
        $import->originalName = $event->capture->file['name'];
        $import->filename = $event->capture->file['path'];
        $sheets = $import->load(storage_path('app/public/'.$event->capture->file['path']));
        $loadOrder = 1;
        foreach ($sheets as $sheet) {
            $sheetModel = $event->capture->sheets()->firstOrNew([
                                'number' => $sheet->number,
                            ]);
            if (!$sheetModel->exists) {
                $sheetModel->name = $sheet->name;
                $sheetModel->rows = $sheet->rows;
                $sheetModel->cols = count($sheet->columns);
                $sheetModel->to_load = $sheet->rows ? 'si' : 'no';
                $sheetModel->load_order = $sheet->rows ? $loadOrder++ : null;
                $sheetModel->process = 'descombinar';
                $sheetModel->save();
            }
            foreach ($sheet->columns as $c=>$column) {
                $detail=$sheetModel->details()->firstOrNew([
                                    'name'=> $column
                                ]);
                if (!$detail->exists) {
                    $detail->name = $column;
                    $detail->type = $c==0?'variable':'dimension';
                    $detail->copia_inicio_fila = 2;
                    $detail->copia_inicio_columna = $c+1;
                    $detail->copia_fin_fila = $sheet->rows;
                    $detail->copia_fin_columna = $c+1;
                    $detail->pegado_inicio_fila = 1;
                    $detail->repetir_pegado = 1;
                    $detail->save();
                }
            }
        }
    }
}
