<?php
namespace App\Listeners\UserAdministration;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\UserAdministration\EstadoFinanciero;
use App\Events\UserAdministration\EstadoFinancieroSaving;

class EstadoFinancieroSavingListener
{
    public $estadoFinanciero = null;
    public function handle($event)
    {
        if (empty($event->estadoFinanciero->prefix)) {
            $event->estadoFinanciero->prefix = uniqid('tmp_');
        }
        $file = realpath(storage_path('app/public/'.$event->estadoFinanciero->archivo['path']));
        $event->estadoFinanciero->tablas = \App\Xls2Csv2Db::import(
                            $event->estadoFinanciero->prefix,
                            $file
                        );
    }
}
