@extends('layouts.app')

@section('htmlheader_title')
    Product
@endsection

@section('class-skin') skin-red  @endsection

@section('contentheader_title')
    Ventas
@endsection
@section('here')
    Ventas
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Registro de ventas</h3>
                            {{--<a class="btn btn-default" data-toggle="modal" data-target="#addModal" ><span><i style="color: dodgerblue" class="fa fa-plus"></i></span> Añadir</a>--}}
                        </div>
                    </div>
                    <div class="box-body">
                        <div >
                            <table id="saleTable" class="display table table stripped table bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <td>Codigo</td>
                                    <th>Producto</th>
                                    <th>Maquina</th>
                                    <th>precio</th>
                                    <th>cantidad</th>
                                    <th>Fecha de venta</th>
                                    <th>Total</th>
                                    {{--<th></th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($sales))
                                    @foreach($sales as $sale)
                                        @php
                                            $machine = $sale->machine
                                        @endphp
                                        <tr>
                                            <td>M{{dechex($machine->id)}}-{{$sale->code}}</td>
                                            <td>{{$sale->product->name}}</td>
                                            <td>{{$machine->mac}}, {{$machine->name}} ({{$machine->ubication}})</td>
                                            <td>{{$sale->price}}</td>
                                            <td>{{$sale->quantity}}</td>
                                            <td>{{$sale->updated_at}}</td>
                                            <td>{{$sale->total_amount}}</td>
                                            {{--<td>
                                                <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editS(this)" data-sale="{{$sale->id}}"><span><i class="fa fa-2x fa-edit"></i></span></a>
                                                <a href="#" onclick="deleteS(this)" data-sale="{{$sale->id}}"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>
                                            </td>--}}
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('extra-scripts')
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#saleTable').DataTable();
        });
    </script>
@endpush