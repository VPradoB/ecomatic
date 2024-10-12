<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables/jquery.dataTables.css')}}">
</head>
<body>
<div class="container-full-fluid">
    <table class="table table-responsive table-striped">
        <tr>
            <th>Maquina</th>
            <th>Producto</th>
            <th>Productos afectados</th>
            <th>Evento</th>
            <th>Fecha</th>
        </tr>
        @if(count($stats))
            @foreach($stats as $stat)
                <tr>
                    <td>{{$stat->machine->name}}</td>
                    <td>{{$stat->product->name}}</td>
                    <td>{{$stat->product_count}}</td>
                    <td>{{$stat->event_types->name}}</td>
                    <td>{{$stat->created_at}}</td>
                </tr>
            @endforeach
            @else
                <h3>No hay alertas en el rango de fechas</h3>
            @endif
    </table>
</div>
</body>
</html>