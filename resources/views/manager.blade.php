@extends('layouts.page')
@section('content')
<div id="app">
  <div class="ibox ">
    <div class="ibox-title">
      <h5>Actualizar de backup</h5>
    </div>
    <form method="post" action="manager/restorebk">
      <div class="ibox-content">
        <p>
          <input name="url" class="form-control" placeholder="http://backup.place/file">
          <input name="password" class="form-control" placeholder="password">
        </p>

        <div class=" m-t-sm">

          <button type="submit" class="btn btn-success"><i class="fa fa-play"></i> Restaurar backup desde</button>

        </div>
      </div>
    </form>
  </div>
</div>
<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/vue/dist/vue.min.js"></script>
@stop
