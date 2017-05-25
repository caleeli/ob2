@extends('layouts.page')
@section('content')
<div id="now_loading">
    <h1>{{env('APP_NAME', 'Application Name')}}</h1>
    <br>
    <i class="ajax-loader"></i>
</div>
        <div  id="app" style="visibility:hidden;">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><img src="images/logo.jpg" style="height: 40px;display: inline;margin-top: -8px;"></a>
                        <!-- template-tuner template="cosmo"></template-tuner -->
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li v-for="menu in menues">
                                <a v-if="!menu.options.length" href="#" v-on:click="goto(menu.id)"><i :class="menu.icon"></i> @{{menu.text}}</a>
                                <a v-if="menu.options.length" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i :class="menu.icon"></i> @{{menu.text}} <span class="caret"></span></a>
                                <ul v-if="menu.options.length" class="dropdown-menu">
                                    <li v-for="submenu in menu.options">
                                        <a href="#" v-on:click="goto(submenu.id)"><i :class="submenu.icon"></i> @{{submenu.text}}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="glyphicon glyphicon-equalizer"></i> Tema/Colores <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li v-bind:class="cssTemplateMenu('simplex')"><a href="#" v-on:click="changeTemplate('simplex')"><i class="glyphicon glyphicon-equalizer"></i> Sencillo</a></li>
                                    <li v-bind:class="cssTemplateMenu('cerulean')"><a href="#" v-on:click="changeTemplate('cerulean')"><i class="glyphicon glyphicon-equalizer"></i> Azul claro</a></li>
                                    <li v-bind:class="cssTemplateMenu('darkly')"><a href="#" v-on:click="changeTemplate('darkly')"><i class="glyphicon glyphicon-equalizer"></i> Oscuro</a></li>
                                    <li v-bind:class="cssTemplateMenu('flatly')"><a href="#" v-on:click="changeTemplate('flatly')"><i class="glyphicon glyphicon-equalizer"></i> Contraste</a></li>
                                    <li v-bind:class="cssTemplateMenu('united')"><a href="#" v-on:click="changeTemplate('united')"><i class="glyphicon glyphicon-equalizer"></i> United</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="login"><i class="fa fa-sign-out"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="breadcrumb" style="margin-bottom: -1px;border-radius: 0px;">
                    <!-- li class="visible-xs-inline visible-sm-inline previous disabled"><a href="#">&larr; Older</a></li -->
                    <li v-for="item in getPaths()">
                        <a href="javascript:void(0)" v-on:click="item.goto()">@{{item.name}}</a>
                    </li>
                    <!-- li class="pull-right visible-xs-inline visible-sm-inline"><a href="#">Newer &rarr;</a></li -->
                </ul>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <carousel>
                            <?php $dirList = glob(base_path().'/nano/modules/*.php'); sort($dirList); ?>
                            @foreach ($dirList as $filename)
                            <carouselitem id="{{'module-'.basename($filename, '.php')}}">
                                <{!! strtolower(basename($filename, '.php')) !!} />
                            </carouselitem>
                            @endforeach
                        </carousel>
                    </div>
                </div>
            </div>
        </div>
<script src="{{ elixir('js/admin.js') }}?t=<?=filemtime(public_path('js/admin.js'))?>"></script>
@stop
