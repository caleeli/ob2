{!! "<"."?php" !!}
namespace App\Listeners\{!! $resource->package->name() !!};

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\{!! $resource->package->name() !!}\{!! $resource->name() !!};
use App\Events\{!! $resource->package->name() !!}\{!! $resource->name() !!}{!! $event->name() !!};

class {!! $resource->name() !!}{!! $event->name() !!}Listener
{
    public ${!! lcfirst($resource->name()) !!} = null;
    public function {!! $event->method('handle') !!}
}
