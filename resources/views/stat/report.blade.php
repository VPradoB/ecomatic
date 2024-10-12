@extends('layouts.app')

@section('htmlheader_title')
    Reportes
@endsection
@section('class-skin') skin-red @endsection

@section('contentheader_title')
    Reportes
@endsection
@section('here')
    Reportes
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Ventas</h3>
                        </div>
                       </div>
                    <div class="box-body">
                        <form action="{{route('sales.report')}}" target="_blank" method="POST" role="form" class="form-inline" >
                            {{csrf_field()}}
                            <div class="form-group" >
                                <label for="dateRange" style="margin-top:6px">Rango de fecha</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-right" name="dateRange" id="dateRangeSales" required     type="text" placeholder="Rango de fechas">
                                </div><!-- /.input group -->
                                <div class="form-group pull">
                                    <button type="submit" class="btn btn-danger" name="pdf">PDF</button>
                                    <button type="submit" class="btn btn-success" name="excel">EXCEL</button>
                                </div>
                            </div> <!-- /. form group -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Ventas de una maquina</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="{{route('machine.sales.report')}}" target="_blank" method="POST" role="form" class="form-inline" >
                            {{csrf_field()}}
                            <div class="form-group" >
                                <label for="dateRange" style="margin-top:6px">Rango de fecha</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-right" name="dateRange" id="dateRangeMachineSales" required type="text" placeholder="Rango de fechas">
                                </div><!-- /.input group -->
                                <div class="form-group">
                                    <label for="machine_id" style="margin-top:6px">Maquina</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <select name="machine_id" class="form-control" id="">
                                            @foreach($machines as $machine)
                                                <option value="{{$machine->id}}">{{$machine->mac}}, {{$machine->name}} ({{$machine->ubication}})</option>
                                            @endforeach
                                        </select>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger" name="pdf">PDF</button>
                                    <button type="submit" class="btn btn-success" name="excel">EXCEL</button>
                                </div>
                            </div> <!-- /. form group -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Ventas de un producto</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="{{route('product.sales.report')}}" target="_blank" method="POST" role="form" class="form-inline" >
                            {{csrf_field()}}
                            <div class="form-group" >
                                <label for="dateRange" style="margin-top:6px">Rango de fecha</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-right" name="dateRange" id="dateRangeProductSales" required type="text" placeholder="Rango de fechas">
                                </div><!-- /.input group -->
                                <div class="form-group">
                                    <label for="machine_id" style="margin-top:6px">Producto</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <select name="product_id" class="form-control" id="">
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger" name="pdf">PDF</button>
                                    <button type="submit" class="btn btn-success" name="excel">EXCEL</button>
                                </div>
                            </div> <!-- /. form group -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Alertas</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="{{route('stat.alert.report')}}" target="_blank" method="POST" role="form" class="form-inline" >
                            {{csrf_field()}}
                            <div class="form-group" >
                                <label for="dateRange" style="margin-top:6px">Rango de fecha</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-right" name="dateRange" id="dateRangesAlert" required type="text" placeholder="Rango de fechas">
                                </div><!-- /.input group -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger" name="pdf">PDF</button>
                                    <button type="submit" class="btn btn-success" name="excel">EXCEL</button>
                                </div>
                            </div> <!-- /. form group -->
                        </form>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-12">--}}
                {{--<div class="box box-solid">--}}
                    {{--<div class="box-header with-border">--}}
                        {{--<div>--}}
                            {{--<h3 class="box-title"><span><i class="fa fa-setting"></i></span>Alertas de una maquina</h3>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}
                        {{--<form action="{{route('machine.alert.report')}}" target="_blank" method="POST" role="form" class="form-inline" >--}}
                            {{--{{csrf_field()}}--}}
                            {{--<div class="form-group" >--}}
                                {{--<label for="dateRange" style="margin-top:6px">Rango de fecha</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">--}}
                                        {{--<i class="fa fa-calendar"></i>--}}
                                    {{--</div>--}}
                                    {{--<input class="form-control pull-right" name="dateRange" id="dateRangesMachineAlert" required type="text" placeholder="Rango de fechas">--}}
                                {{--</div><!-- /.input group -->--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="machine_id" style="margin-top:6px">Maquina</label>--}}
                                    {{--<div class="input-group">--}}
                                        {{--<div class="input-group-addon">--}}
                                            {{--<i class="fa fa-calendar"></i>--}}
                                        {{--</div>--}}
                                        {{--<select name="machine_id" class="form-control" id="">--}}
                                            {{--@foreach($machines as $machine)--}}
                                                {{--<option value="{{$machine->id}}">{{$machine->mac}}, {{$machine->name}} ({{$machine->ubication}})</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div><!-- /.input group -->--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<button type="submit" class="btn btn-danger" name="pdf">PDF</button>--}}
                                    {{--<button type="submit" class="btn btn-success" name="excel">EXCEL</button>--}}
                                {{--</div>--}}
                            {{--</div> <!-- /. form group -->--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


        </div>
    </div>
@endsection
@push('extra-scripts')
    <script src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script>
        $('#dateRangeMachineSales').daterangepicker();
        $('#dateRangeSales').daterangepicker();
        $('#dateRangeProductSales').daterangepicker();
        $('#dateRangesAlert').daterangepicker();
        $('#dateRangesMachineAlert').daterangepicker();
    </script>
@endpush

