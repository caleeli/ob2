<?php
$resource->makefile(
    'resources/assets/js/modules/'.$resource->package->name().'/'.$resource->name().'.js',
    view('builders.Resource.resource_js', ['resource'=>$resource])->render(),
    'js'
);
$resource->makefile(
    'app/Models/' . $resource->package->name() . '/' . $resource->name() . '.php',
    view('builders.Resource.resource_model', ['resource'=>$resource])->render(),
    'php'
);
$resource->makefile(
    $resource->makeMigration($resource->name),
    view('builders.Resource.resource_migration', ['resource'=>$resource])->render(),
    'php'
);
foreach($resource->definition->events as $event) {
    $resource->makefile(
        'app/Events/' . $resource->package->name() . '/' . $resource->name().$event->name() . '.php',
        view('builders.Resource.resource_event', ['resource'=>$resource, 'event'=>$event])->render(),
        'php'
    );
    $resource->makefile(
        'app/Listeners/' . $resource->package->name() . '/' . $resource->name().$event->name() . 'Listener.php',
        view('builders.Resource.resource_listener', ['resource'=>$resource, 'event'=>$event])->render(),
        'php'
    );
}

?>