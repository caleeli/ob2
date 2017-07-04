<?php
namespace App\Events\UserAdministration;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\UserAdministration\Tarea;

class TareaSaved implements ShouldBroadcast
{
    use InteractsWithSockets;
    public $tarea = null;
    public function __construct(Tarea $model)
    {
        $this->tarea=$model;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
