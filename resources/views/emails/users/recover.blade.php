<h1>
    <img src="http://be.entreparentesys.com:8081/images/logo.jpg" style="height: 64px;"> {{env('APP_NAME', 'Application Name')}}
</h1>

<h2>
    Recuperación de contraseña
</h2>

<p><b>{{$user->username}}</b>, recientemente ha pedido restablecer su contraseña.</p>

<p>Para cambiar la contraseña, haga clic en el siguiente enlace:</p>
    <a href="{{env('APP_URL', 'http://localhost')}}/recover/{{$recover->key}}">
        {{env('APP_URL', 'http://localhost')}}/recover/{{$recover->key}}
    </a>

<h3>Si no ha solicitado este cambio ignore este mensaje</h3>
