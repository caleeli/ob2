<table>
    <tr>
        <th>Cuenta</th>
        <th>Valor</th>
    </tr>
    @foreach($valores as $valor)
    <tr>
        <td>{{$valor['cuenta']}}</td>
        <td>{{$valor['valor']}}</td>
    </tr>
    @endforeach
</table>