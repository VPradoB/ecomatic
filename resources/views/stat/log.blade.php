@extends('layouts.app')

@section('htmlheader_title')
    Cronica de eventos
@endsection
@section('class-skin') skin-red @endsection

@section('contentheader_title')
    Cronica de eventos
@endsection
@section('here')
    Log de eventos
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Cronica de eventos</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div >
                            <table id="saleTable" class="display table table stripped table bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Numero de evento</th>
                                    <th>Maquina</th>
                                    <th>Tipo de evento</th>
                                    <th>Fecha</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($stadistics))
                                @foreach($stadistics as $stat)
                                        @php
                                            $machine = $stat->machine
                                        @endphp
                                        <tr>
                                            <td>{{$stat->id}}</td>
                                            <td>{{$machine->mac}}, {{$machine->name}} ({{$machine->ubication}})</td>
                                            <td>{{$stat->event_types->name}}</td>
                                            <td>{{$stat->created_at}}</td>
                                            <td>{{$stat->product->name}}</td>
                                            <td>@if($stat->event_types->id != 3)  {{$stat->product_count}} @endif</td>
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