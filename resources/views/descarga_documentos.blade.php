@extends('layouts.simple')

@section('content')
<style>
#main {
    height: 100vh;
    padding-top: 1em;
}
.file-link {
    display: inline-block;
    margin-right: 1em;
}
.file-link div{
    font-size: 4em;
}
</style>
<div id="main" class="gray-bg">
    <p><button id="descargar" class="btn btn-success">Descargar Todos</button></p>
    @foreach ($files as $i => $file)
        <a class="file-link" href="{{$file['url']}}" download>
            <div><i class="fa fa-file"></i></div>
            <label>{{$file['name']}}</label>
        </a>
    @endforeach
</div>
<script>
    $('#descargar').click(function () {
        $(".file-link").each(function(index, link) {
            link.click();
        });
    });
</script>
@endsection
