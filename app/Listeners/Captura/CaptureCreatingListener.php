<?php
namespace App\Listeners\Captura;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Captura\Capture;
use App\Events\Captura\CaptureCreating;

class CaptureCreatingListener
{
    public $capture = null;
    public function handle(CaptureCreating $event)
    {
        $event->capture->temporal_table = uniqid('tpm_');
        \DB::select("CREATE TABLE ".$event->capture->temporal_table." ( like valores_produccion )");
        \DB::select('ALTER TABLE "'.$event->capture->temporal_table.'" ADD CONSTRAINT "'.$event->capture->temporal_table.'_id_valor_index" UNIQUE ("id_valor");');
    }
}
