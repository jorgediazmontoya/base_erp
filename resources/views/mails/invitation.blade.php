<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Invitacion de {{ app('currentTenant')->name }}</title>
</head>
<body>
    <p>{{ app('currentTenant')->name }} te esta invitando a ser parte de Links S.A.</p>
    <span>{{date('Y-m-d')}}</span>
</body>
</html>
