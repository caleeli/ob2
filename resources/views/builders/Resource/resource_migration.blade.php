{!! "<"."?php" !!}

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{!! camel_case($resource->table()) !!}Table extends Migration
{
    public function up()
    {
        Schema::create('{!! $resource->table() !!}', function (Blueprint $table) {
            $table->increments('id');
        @foreach($resource->attributes() as $attribute)
            $table->{!! $attribute->type !!}('{!! snake_case($attribute->name) !!}'){!!
                !empty($attribute->required) ? '': 'nullable()'
            !!};
        @endforeach
        @foreach($resource->relationships() as $relationship)
            $table->integer('{!! snake_case($relationship->name) !!}_id')->unsigned();
        @endforeach
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('{!! $resource->table() !!}');
    }
}
