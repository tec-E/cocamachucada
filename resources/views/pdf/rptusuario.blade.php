<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Usuarios</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 25px;
            text-align: center;
            margin: 5px 0 2px 0;
        }

        .info-contacto {
            text-align: left;
            font-size: 11px;
            line-height: 1.1;
            margin: 5px 30px 0 30px;
        }

        .info-contacto span {
            display: block;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: 10px;
            right: 20px;
            font-size: 10px;
            color: #777;
        }
        thead {
            background-color: #d0e6f7; /* 💡 Fondo celeste suave */
        }
        .negrita {
            font-weight: bold;
        }
    </style>

</head>
<body>
<div>
    Direccion: Calle Principal #123, Cocamachucada - Bermejo <br>
    Whatsapp: 78223768<br>
    Correo: caco@gmail.com
</div>
<h2>Reporte de Usuario</h2>
<table>
    <thead>
    <tr>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Creado</th>
        <th>Modificado</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($registros as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<footer>
    Fecha de generación: {{ $fechaLiteral }}
</footer>
</body>
</html>
