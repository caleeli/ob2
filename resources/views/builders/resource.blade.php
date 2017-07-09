<?php
makefile(
    'resources/assets/js/modules/'.$resource->package->name.'/'.$resource->name.'.js',
    view('Resource.resource.js')->render(),
    'js'
);
makefile(
    'app/Models/' . $resource->package->name . '/' . $resource->name . '.php',
    view('Resource.resource.model')->render(),
    'php'
);
?>

