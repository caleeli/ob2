<?php
namespace App\Events\Captura;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Captura\Capture;

class CaptureSaved implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $capture = null;
    public function __construct(Capture $model)
    {
        $this->capture=$model;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
