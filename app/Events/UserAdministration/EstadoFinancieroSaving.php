<?php
namespace App\Events\UserAdministration;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\UserAdministration\EstadoFinanciero;


class EstadoFinancieroSaving implements ShouldBroadcast
{
    use InteractsWithSockets;
    public $estadoFinanciero = NULL;
public function __construct(EstadoFinanciero $model){$this->estadoFinanciero=$model;}

public function broadcastOn(){return new PrivateChannel('channel-name');}
}