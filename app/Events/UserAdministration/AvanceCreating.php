<?php
namespace App\Events\UserAdministration;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\UserAdministration\Avance;

class AvanceCreating implements ShouldBroadcast
{
    use InteractsWithSockets;
    public $avance = null;
    public function __construct(Avance $model)
    {
        $this->avance=$model;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
