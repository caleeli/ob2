/**
 * {!! $resource->fullNamePlural() !!} collection
 */
{!! $resource->fullNamePlural() !!} = function () {
	Nano.Resources.apply(this, arguments);
	this.resource = {!! $resource->fullName() !!},
	this.url = '{!! $resource->url() !!}',
	this.selection = {!! $resource->selection() !!};
}
Nano.extends({!! $resource->fullNamePlural() !!}, Nano.Resources);

/**
 * {!! $resource->fullName() !!} model
 */
{!! $resource->fullName() !!} = function () {
	Nano.Resource.apply(this, arguments);
}
Nano.extends({!! $resource->fullName() !!}, Nano.Resource);
{!! $resource->fullName() !!}.prototype.type = '{!! $resource->fullName() !!}';
Nano.Resource.types['{!! $resource->fullName() !!}'] = {!! $resource->fullName() !!};
{!! $resource->fullName() !!}.definition = {!! $resource->definition() !!};
