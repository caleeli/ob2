@makefile('resources/assets/js/modules/'.$resource->package->name().'/'.$resource->name().'.js')
/**
 * {!! $resource->plural() !!} collection
 */
{!! $resource->plural() !!} = function () {
	Nano.Resources.apply(this, arguments);
	this.resource = {!! $resource->singular() !!},
	this.url = '{!! $resource->url() !!}',
	this.selection = {!! $resource->selection() !!};
}
Nano.extends({!! $resource->plural() !!}, Nano.Resources);

/**
 * {!! $resource->singular() !!} model
 */
{!! $resource->singular() !!} = function () {
	Nano.Resource.apply(this, arguments);
}
Nano.extends({!! $resource->singular() !!}, Nano.Resource);
{!! $resource->singular() !!}.prototype.type = '{!! $resource->singular() !!}';
Nano.Resource.types['{!! $resource->singular() !!}'] = {!! $resource->singular() !!};
{!! $resource->singular() !!}.definition = {!! $resource->definition() !!};
