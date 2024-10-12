@extends('layouts.app')
@section('class-skin') skin-blue @endsection

@section('htmlheader_title')
	Home
@endsection

@section('contentheader_title')
    Panel principal
@endsection
@section('here')
    Página de inicio
@endsection

@section('main-content')
<div class="container-fluid">
    {{--<div class="input-group input-daterange">--}}
        {{--<input type="text" class="form-control" >--}}
        {{--<div class="input-group-addon">hasta</div>--}}
        {{--<input type="text" class="form-control">--}}
    {{--</div>--}}
    <a href="{{route('configuration.view')}}">

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Configuraciones</span>
                    <span class="info-box-text">{{$configNumber}} configuraciones creadas</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </a>
    <a href="{{route('sale.view')}}">

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ventas</span>
                    <span class="info-box-text">{{$salesNumber}} productos vendidos este mes</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </a>
    <a href="{{route('machine.view')}}">

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-black"><i class="ion ion-ios-pricetag-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Maquinas</span>
                    <span class="info-box-text">{{count($machines)}} maquinas activas</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </a>

</div>
	<div class="container-fluid spark-screen">


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="box box-default">
                <div class="box-header with-border">
                    <a data-widget="collapse" href="">

                        <h3 class="box-title">Resultados de Globales</h3>
                    </a>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-md-offset-8">

                                <select class="form-control" title="Seleccione el rango de datos">
                                    <option onclick="refreshSalesChart({{0}})" value="" selected>Todos los tiempos</option>
                                    <option onclick="refreshSalesChart({{1}})" value="1" >1  meses</option>
                                    <option onclick="refreshSalesChart({{2}})" value="2" >2  meses</option>
                                    <option onclick="refreshSalesChart({{3}})" value="3" >3  meses</option>
                                    <option onclick="refreshSalesChart({{6}})" value="6" >6  meses</option>
                                    <option onclick="refreshSalesChart({{9}})" value="9" >9  meses</option>
                                    <option onclick="refreshSalesChart({{12}})" value="12" >12 meses</option>
                                </select>
                            </div>
                            <br>
                            <div class="chart-responsive">
                                <canvas id="machinesSales" height="50%" width="100%" style="width: 50%; height: 100%;"></canvas>

                            </div>
                            <!-- ./chart-responsive -->
                        </div>
                        <div class="col-md-6">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-md-offset-8">

                                <select class="form-control" title="Seleccione el rango de datos">
                                    <option onclick="refreshProductsChart({{0}})" value="0" selected>Todos los tiempos</option>
                                    <option onclick="refreshProductsChart({{1}})" value="1" >1  meses</option>
                                    <option onclick="refreshProductsChart({{2}})" value="2" >2  meses</option>
                                    <option onclick="refreshProductsChart({{3}})" value="3" >3  meses</option>
                                    <option onclick="refreshProductsChart({{6}})" value="6" >6  meses</option>
                                    <option onclick="refreshProductsChart({{9}})" value="9" >9  meses</option>
                                    <option onclick="refreshProductsChart({{12}})" value="12" >12 meses</option>
                                </select>
                            </div>
                            <br>
                            <div class="chart-responsive">
                                <canvas id="productsSales" height="50%" width="100%" style="width: 50%; height: 100%;"></canvas>

                            </div>
                            <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
	</div>
    <div class="container-fluid spark-screen">
        @if(count($machines))
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" id="tabList">
                    @foreach($machines as $machine)
                        <li class=""><a href="#tab{{$machine->id}}" onclick="loadMachine({{$machine->id}});" data-toggle="tab" aria-expanded="false">{{$machine->mac}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($machines as $machine)
                        <div class="tab-pane" id="tab{{$machine->id}}">
                            <h3>{{$machine->mac}}, {{$machine->name}} ({{$machine->ubication}})</h3>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="chart-responsive">
                                        <select class="form-control" title="Seleccione el rango de datos">
                                            <option onclick="refreshMachineSalesChart({{$machine->id}},0)" value="0" selected>Año actual</option>
                                            <option onclick="refreshMachineSalesChart({{$machine->id}},1)" value="1" >año pasado</option>
                                            <option onclick="refreshMachineSalesChart({{$machine->id}},2)" value="2" >hace 2 años</option>
                                            <option onclick="refreshMachineSalesChart({{$machine->id}},5)" value="3" >3  años</option>
                                            <option onclick="refreshMachineSalesChart({{$machine->id}},6)" value="6" >4 años</option>
                                            <option onclick="refreshMachineSalesChart({{$machine->id}},5)" value="5" >5 años</option>
                                        </select>
                                        <br>
                                        <canvas id="sales{{$machine->id}}" height="50%" width="100%" style="width: 50%; height: 100%;"></canvas>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="chart-responsive">
                                        <select class="form-control" title="Seleccione el rango de datos">
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'january')" value="1" >Enero</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'february')"           value="2" >Febrero</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'march')"           value="3" >Marzo</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'april')"           value="4" >Abril</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'may')"           value="5" >Mayo</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'june')"          value="6" >Junio</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'july')" value="7" >Julio</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'august')" value="8" >Agosto</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'september')" value="9" >Septiembre</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'october')" value="10" >Octubre</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'november')" value="11" >Noviembre</option>
                                            <option onclick="refreshMachineProductsChart({{$machine->id}},'december')" value="12" >Diciembre</option>
                                        </select>
                                        <br>
                                        <canvas id="products{{$machine->id}}" height="50%" width="100%" style="width: 50%; height: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                @endforeach
                <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        @else
            <h3 class="text-red">No hay maquinas, <a class="text-blue" href="{{route('machine.view')}}">Click aquí</a> para registrar </h3>
        @endif

    </div>
    @endsection
@push('extra-scripts')
    {{--<link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">--}}
    {{--<script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>--}}
    <script>
        var Charts= [];
        $(document).ready(function () {
            // $('.input-daterange input').each(function() {
            //     $(this).datepicker({language:'es'});
            // });
            refreshSalesChart(0);
            refreshProductsChart(0);

        });

        //return colors from charts
        function dynamicColors(length) {
            var rgb = [];
            rgb['background'] = [];
            rgb['border'] = [];
            for(var i=0;i<length;i++){
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                rgb['background'][i] = "rgba(" + r + "," + g + "," + b + ",0.2)";
                rgb['border'][i] = "rgba(" + r + "," + g + "," + b + ",1)";
            }
            return rgb

        }

        function refreshSalesChart($month){
            $.ajax({
                method: 'get',
                url: 'api/machines/sales/totalAmount?month=' + $month,
                headers: {
                    "X-CSRF-TOKEN": window.Laravel,
                },
                dataType: "text",
                success: function (response) {

                    if (typeof(Charts['salesChart']) !== 'undefined') Charts['salesChart'].destroy();
                    Chart['salesChart'] = initializeDoughnutChart(document.getElementById("machinesSales"), JSON.parse(response), 'Ventas por maquina')
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    response = JSON.parse(XMLHttpRequest.responseText);
                    swal({
                        title: "Ha ocurrido un error",
                        text: response,
                        icon: "warning",
                        buttons: false,
                        dangerMode: true,
                    })
                }

            })
        }
        function refreshProductsChart($month){
            $.ajax({
                method:'get',
                url: 'api/products/sales/totalAmount?month='+$month,
                headers: {
                    "X-CSRF-TOKEN": window.Laravel,
                },
                dataType: "text",
                success: function(response){

                    if(typeof(Charts['productsChart']) !== 'undefined') Charts['productsChart'].destroy();
                    Charts['productsChart'] = initializeDoughnutChart(document.getElementById("productsSales"),JSON.parse(response),'Ventas por product')
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    response = JSON.parse(XMLHttpRequest.responseText);
                    swal({
                        title: "Ha ocurrido un error",
                        text: response,
                        icon: "warning",
                        buttons: false,
                        dangerMode: true,
                    })
                }
            })
        }

        function loadMachine(machine) {
            refreshMachineSalesChart(machine,0)
            refreshMachineProductsChart(machine,'january')
        }
        /*
        *
        * inicializa un chart de tipo dona
        * @param varChart es la variable donde se va a guardar el chart
        * @param chart  elemento html en donde se cargar el chart
        * @param data con formato array(data[values],labels[respective labels for values])
        * @param titulo del chart
        *
        */
        function initializeDoughnutChart(ctx,data,title){
            var colors = dynamicColors(data['data'].length);
            return  new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data['labels'],
                    datasets: [{
                        data: data['data'],
                        backgroundColor:  colors['background'],
                        borderColor: colors['border'],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend:{
                        position: 'right'
                    },
                    title:{
                        text: title,
                        display: true,
                        position: 'top',
                        padding: 20,
                        fontSize: 16
                    }
                }
            });
        }

        function refreshMachineSalesChart(machine,year){
            $.ajax({
                method:'get',
                url: 'api/machine/'+machine+'/sales/totalAmount?diffYear='+year,
                headers: {
                    "X-CSRF-TOKEN": window.Laravel,
                },
                dataType: "text",
                success: function(response){
                    console.log(JSON.parse(response));
                    if(typeof(Charts['sales'+machine]) != 'undefined') Charts['sales'+machine].destroy();
                    Chart['sales'+machine] = initializeLineChart(document.getElementById("sales"+machine),JSON.parse(response),'Ventas En los meses')
                }
            })
        }

        function    refreshMachineProductsChart(machine,rangeTime){
            $.ajax({
                method:'get',
                url: 'api/machine/'+machine+'/products?month='+rangeTime,
                headers: {
                    "X-CSRF-TOKEN": window.Laravel,
                },
                dataType: "text",
                success: function(response){
                    console.log(JSON.parse(response));
                    if(typeof(Charts['products'+machine]) != 'undefined') Charts['products'+machine].destroy();
                    Chart['products'+machine] = initializeBarChart(document.getElementById("products"+machine),JSON.parse(response),'venta de productos')

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if(typeof(Charts['products'+machine]) != 'undefined') Charts['products'+machine].destroy();
                    response = JSON.parse(XMLHttpRequest.responseText);
                    swal({
                        title: "Ha ocurrido un error",
                        text: response,
                        icon: "warning",
                        buttons: false,
                        dangerMode: true,
                    })
                }

            })
        }
        /*
        *
        * inicializa un chart de tipo barra
        * @param varChart es la variable donde se va a guardar el chart
        * @param chart  elemento html en donde se cargar el chart
        * @param data con formato array(data[values],labels[respective labels for values])
        * @param titulo del chart
        *
        */
        function initializeBarChart(ctx,data,title){
            var colors = dynamicColors(data['data'].length);
            return  new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['label'],
                    datasets: [{
                        label: 'Litros de producto vendido',
                        data: data['data'],
                        backgroundColor:  colors['background'],
                        borderColor: colors['border'],
                        borderWidth: 1
                    }]
                },
                options: {
                    title:{
                        text: title,
                        display: true,
                        position: 'top',
                        padding: 20,
                        fontSize: 16
                    }
                }
            });
        }
        function initializeLineChart(ctx,data,title){
            var colors = dynamicColors(data['data'].length);
            return  new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data['label'],
                    datasets: [{
                        label: 'pesos vendidos',
                        data: data['data'],
                        backgroundColor:  colors['background'],
                        borderColor: colors['border'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        text: title,
                        display: true,
                        position: 'top',
                        padding: 20,
                        fontSize: 16
                    },

                }
            });
        }
    </script>
@endpush