{!! "<"."?php" !!}
namespace App\Models\{!! $resource->package->name() !!};

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class {!! $resource->name() !!} extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = '{!! $resource->table() !!}';
    protected $fillable = {!! $resource->fillable() !!};
    protected $attributes = {!! $resource->defaults() !!};
    protected $casts = {!! $resource->casts() !!};
    protected $events = {!! $resource->events() !!};

@foreach ($resource->relationships() as $relationship)
    public function {!! $relationship->name() !!}() {
        return {!! $relationship->relationshipType() !!}({!! $relationship->className() !!}::class, {!! $relationship->foreign() !!}, {!! $relationship->local() !!});
    }
@endforeach
@foreach ($resource->methods() as $method)
    public {!! $method->method() !!}
@endforeach
}
