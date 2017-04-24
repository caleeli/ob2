<h1>
    {{env('APP_NAME', 'Application Name')}}
</h1>

<h2>
    Recuperación de contraseña
</h2>

<p>Tienes registrada una cuenta cuyo nombre de usuario es:</p>
<ul>
    <li>{{$user->username}}</li>
</ul>

<h3>
    Restalecer contraseña
</h3>

<p>Para restablecer tu contraseña, haz click en el siguiente enlace:
    <a href="{{env('APP_URL', 'http://localhost')}}/recover/{{$recover->key}}">
        {{env('APP_URL', 'http://localhost')}}/recover/{{$recover->key}}
    </a>.
</p>

