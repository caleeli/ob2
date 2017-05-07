@extends('layouts.page')
@section('content')
    <style>
        html, body {
            height: 100%;
        }

        @media (orientation: landscape) {
            body {
            / / background-image: url('/images/dark-background.jpg');
                background-size: 100% auto;
                overflow-x: hidden;
                padding-top: 2em;
            }
        }

        @media (orientation: portrait) {
            body {
            / / background-image: url('/images/dark-background.jpg');
                background-size: auto 100%;
                overflow-x: hidden;
                padding-top: 2em;
            }
        }
    </style>
    <div id="now_loading">
        Cargando ...<br/>
        <i class="ajax-loader"></i>
    </div>
    <div id="app" style="visibility:hidden;">
        <h1>
            <center><img src="images/logo.jpg"
                         style="height: 48px; display: inline;"> {{env('APP_NAME', 'Application Name')}}</center>
        </h1>
        <carousel>
            <carouselitem class="active">
                <div class="row">
                    <div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-3 col-xs-10 col-sm-10 col-md-8 col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Ingresa tu cuenta</div>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Usuario</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="usuario"
                                                   v-model="login.username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Contraseña</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" placeholder="contraseña"
                                                   v-model="login.password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10">
                                            <label>
                                                <i class="fa fa-user-plus"></i>
                                                <a href="#registrar" v-on:click="goto(1)">Registrarse para obtener una
                                                    cuenta</a>
                                            </label>
                                            <br>
                                            <label>
                                                <i class="glyphicon glyphicon-question-sign"></i>
                                                <a href="#olvido" v-on:click="goto(2)">¿Olvido su contraseña?</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="reset" class="btn btn-default" v-on:click="reset">Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-primary" v-on:click="submit">Ingresar
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </carouselitem>
            <carouselitem>
                <div class="row">
                    <div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-3 col-xs-10 col-sm-10 col-md-8 col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Registro</div>
                            <div class="panel-body">
                                <fieldset class=" col-lg-12">
                                    <div id="username" class="form-group">
                                        <label class="col-lg-2 control-label">Usuario</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="usuario"
                                                   v-model="user.username">
                                            <span class="label label-danger if-has-error">debe introducir un nombre de usuario</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Email</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="usuario"
                                                   v-model="user.email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Contraseña</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" placeholder="contraseña"
                                                   v-model="user.password">
                                        </div>
                                    </div>
                                    <div id="password2" class="form-group">
                                        <label class="col-lg-2 control-label">Confirmar</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control"
                                                   placeholder="confirmar contraseña" v-model="password2">
                                            <span class="label label-danger if-has-error">la contraseña no coincide</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nombres</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="usuario"
                                                   v-model="user.nombres">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Paterno</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="usuario"
                                                   v-model="user.paterno">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Materno</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="usuario"
                                                   v-model="user.materno">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Unidad</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="Entidad / Unidad"
                                                   v-model="user.unidad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="reset" class="btn btn-default" v-on:click="resetReg">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-primary" v-on:click="submitReg">
                                                Registrar
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </carouselitem>
            <carouselitem>
                <div class="row">
                    <div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-3 col-xs-10 col-sm-10 col-md-8 col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Recupera tu contraseña</div>
                            <div class="panel-body">
                                <fieldset>
                                    <p>Escribe tu nombre de usuario o correo electrónico. Te enviaremos un correo con
                                        las instruciones para restablecer tu contraseña.</p>
                                    <div class="form-group">
                                        <label for="account" class="col-lg-2 control-label">Usuario o email</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control"
                                                   placeholder="usuario o correo electrónico" v-model="recover.account">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="reset" class="btn btn-default" v-on:click="resetRecover">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-primary" v-on:click="submitRecover">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </carouselitem>
        </carousel>
    </div>
    <script src="{{ elixir('js/login.js') }}?t=<?=filemtime(public_path().'/js/login.js')?>">"></script>
@stop
