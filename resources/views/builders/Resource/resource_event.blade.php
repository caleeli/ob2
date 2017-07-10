{!! "<"."?php" !!}
namespace App\Events\{!! $resource->package->name() !!};

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\{!! $resource->package->name() !!}\{!! $resource->name() !!};

class {!! $resource->name() !!}{!! $event->name() !!} implements ShouldBroadcast
{
    use InteractsWithSockets;
    public ${!! lcfirst($resource->name()) !!} = null;
    public function __construct({!! $resource->name() !!} $model)
    {
        $this->{!! lcfirst($resource->name()) !!}=$model;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
