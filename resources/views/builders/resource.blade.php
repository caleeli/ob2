<?php
if ($pathBase==='.') {
    $srcAppPath = 'app';
} else {
    $srcAppPath = $pathBase.'/src/App';
}
$resource->makefile(
    $pathBase.'/resources/assets/js/modules/'.$resource->package->name().'/'.$resource->name().'.js',
    view('builders.Resource.resource_js', ['resource'=>$resource])->render(),
    'js'
);
$resource->makefile(
    $srcAppPath.'/Models/' . $resource->package->name() . '/' . $resource->name() . '.php',
    view('builders.Resource.resource_model', ['resource'=>$resource])->render(),
    'php'
);
$resource->makefile(
    $resource->makeMigration('Create'.ucfirst(camel_case($resource->table())), $pathBase),
    view('builders.Resource.resource_migration', ['resource'=>$resource])->render(),
    'php'
);
foreach($resource->definition->events as $event) {
    $resource->makefile(
        $srcAppPath.'/Events/' . $resource->package->name() . '/' . $resource->name().$event->name() . '.php',
        view('builders.Resource.resource_event', ['resource'=>$resource, 'event'=>$event])->render(),
        'php'
    );
    $resource->makefile(
        $srcAppPath.'/Listeners/' . $resource->package->name() . '/' . $resource->name().$event->name() . 'Listener.php',
        view('builders.Resource.resource_listener', ['resource'=>$resource, 'event'=>$event])->render(),
        'php'
    );
}

?>