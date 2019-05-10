<?php
namespace App\Events\UserAdministration;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\UserAdministration\CargaEstado;


class CargaEstadoSaving implements ShouldBroadcast
{
    use InteractsWithSockets;
    public $cargaEstado = NULL;
public function __construct(CargaEstado $model){$this->cargaEstado=$model;}

public function broadcastOn(){return new PrivateChannel('channel-name');}
}