<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>

    <form action="{{ url('/oauth/clients') }}" method="post">
        <p>
            <input type="text" name="name" id="name" />
        </p>

        <p>
            <input type="text" name="redirect" id="redirect"/>
        </p>

        <p>
            <input type="submit" value="Enviar" name="send" />
        </p>

        {{ csrf_field() }}
    </form>

    <table border="1">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Redirect</th>
            <th>Secret</th>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->redirect }}</td>
                <td>{{ $client->secret }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
