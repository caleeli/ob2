<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME', 'Application Name')}}</title>

        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}?t=<?=filemtime(public_path().'/css/app.css')?>">
        <script src="/documentacion/js/jquery-2.1.1.js"></script>
    </head>
    <body>
@yield('content')
    </body>
</html>
