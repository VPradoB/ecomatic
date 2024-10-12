
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
    <div><h3>PRODUCTO: {{$product->name}}</h3></div>
    <div class="container-full-fluid">
        <table class="table">
            <tr>
                <th>Maquina</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total de venta</th>
                <th>Fecha</th>
            </tr>
            @foreach($sales as $sale)
                <tr>
                    <td>{{$sale->machine->mac}}</td>
                    <td>  {{$sale->price}}</td>
                    <td>  {{$sale->quantity}}</td>
                    <td>  {{$sale->total_amount}}</td>
                    <td>  {{$sale->created_at}}</td>
                </tr>
            @endforeach
        </table>

    </div>
</body>
</html>