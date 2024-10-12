@extends('layouts.app')

@section('htmlheader_title')
    Maquinas
@endsection
@section('class-skin') skin-black  @endsection
@section('contentheader_title')
    informacion general (Maquinas y Cilindros)
@endsection
@section('here')
    Lista de maquinas
@endsection
@section('main-content')
    <div class="container-fluid spark-screen">
        <form action="machine" method="post" id="searchForm">

            {{csrf_field()}}
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div class="dropdown">
                            <h3 class="box-title">Maquinas </h3>
                            <a class="btn btn-default" data-toggle="modal" data-target="#addMachineModal" ><span><i style="color: dodgerblue" class="fa fa-plus"></i></span> Añadir</a>
                            <div class="pull-right">
                                <input type="text" form="searchForm" name="search" class="input-sm"  placeholder="Buscar...">
                                <button type="submit"  form="searchForm"  class="btn btn-default"><span class=""><i class="fa fa-search"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" >
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="col-md-12" id="accordion">
                                @if(count($machines))
                                    @foreach($machines as $machine)
                                        <div  class="panel box box-primary">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" id="dateMachine{{$machine->id}}" data-parent="#accordion" href="#collpapse{{$machine->id}}" aria-expanded="false" onclick="showTank(this)" data-machine="{{ $machine->id }}" class="collapsed">
                                                        M{{dechex ( $machine->id )}}  {{$machine->name	}} ({{$machine->ubication}}), {{$machine->mac}}
                                                    </a>
                                                </h4>
                                                <div class="pull-right">
                                                    <a class="" data-toggle="modal" data-target="#editMachineModal" data-machine="{{ $machine->id }}" onclick="editMachine(this)" ><span><i style="color: dodgerblue;"  class="fa fa-2x fa-edit"></i></span></a>
                                                    <a type="button" onclick="destroyMachine(this)" data-machine ="{{$machine->id}}"><span><i style="color:darkgray" class="fa fa-2x fa-trash"></i></span></a>
                                                </div>

                                            </div>
                                            <div id="collpapse{{$machine->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="box-body">
                                                    <div class="dropdown">
                                                        <a style="background-color: white"  id="agregarBtn{{$machine->id}}" class="btn btn-default" data-toggle="modal" data-machine="{{$machine->id}}" onclick="addTank(this)" data-target="#addTank"><span style="color: dodgerblue"><i class="fa fa-plus"></i></span>Agregar</a>
                                                        <a style="background-color: white" id="editarBtn{{$machine->id}}" class="btn btn-default disabled" data-toggle="modal" data-target="#editTank"><span style="color: dodgerblue"><i class="fa fa-edit"></i></span>Editar</a>
                                                        <a style="background-color: white"  class="btn btn-default disabled"  id="eliminarBtn{{  $machine->id }}" onclick="destroyTank(this)" data-tank="" data-machine="{{ $machine->id }}"><span style="color:darkgray"><i class="fa fa-trash"></i></span>Eliminar</a>
                                                    </div>
                                                    <br>
                                                    <table id="tankTable{{$machine->id}}" class="display table table-striped table-bordered" width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <th>id</th>
                                                            <th>Número de cilindro</th>
                                                            <th>Estatus</th>
                                                            <th>Producto</th>
                                                            <th>Cantidad </th>
                                                            <th>Cantidad minima </th>
                                                            <th>Alerta</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody ></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    @endforeach

                                @else
                                    <h4>no hay máquinas actualmente</h4>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right">
                                    {!! $machines->links() !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="editMachineModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Editar Información de maquina</h4>
                </div>
                <div class="modal-body">
                    <form id="formEditMachine" action="" method="POST" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" value="" name="machine_id" id="machine_id">
                        <div class="form-group">
                            <label for="mac">MAC</label>
                            <input type="text" class="form-control input-sm" name="mac" id="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control input-sm" name="name" id="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="ubication">Ubicación</label>
                            <input type="text" class="form-control input-sm" name="ubication" id="" placeholder="">
                        </div>
                        <button type="submit" id="submitEditar" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="addMachineModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Agregar Información de maquina</h4>
                </div>
                <div class="modal-body">
                    <form id="formAddMachine" action="" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="mac">MAC</label>
                            <input type="text" class="form-control input-sm" name="mac" id="" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control input-sm" name="name" id="" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="ubication">Ubicación</label>
                            <input type="text" class="form-control input-sm" name="ubication" id="" placeholder="" required>
                        </div>
                        <button type="submit" id="submitAgregar" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="editTank">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Editar informacion del cilindro</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="editTankForm" method="POST" role="form">
                        {{csrf_field()}}
                        <input type="hidden" id="oldMachineIdInput" name="oldMachineIdInput">
                        <input type="hidden" name="tank" id="editTankInput">
                        <div class="form-group">
                            <label for="status">Estatus</label>
                            <select name="status" id="statusEditTankInput" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Producto:</label>
                            <select name="product_id" id="" class="form-control">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_values">Cantidad maxima del productos </label>
                            <input type="number"  class="form-control" min="0" max="100" name="product_values" id="">
                        </div>
                        <div class="form-group">
                            <label for="min_product_values">cantidad minima del producto </label>
                            <input type="number" name="min_product_values" min="0" max="100" class="form-control">
                        </div>
                        <input type="submit" id="submitEditTankForm" class="btn btn-primary" value="Guardar Cambios" form="editTankform">
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="addTank">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Agregar Cilindro</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="addTankForm" role="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" hidden class="hidden" name="machine_id" id="machine_idT">
                        </div>
                        <div class="form-group">
                            <label for="">Estado</label>
                            <select name="status" id="" class="form-control" required   >
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Producto</label>
                            <select name="product_id" id="" class="form-control" required>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                            @if(!count($products)) <h5 class="text-red">No existen productos <a class="text-aqua" href="{{route('product.view')}}">click aqui</a> para registrar</h5> @endif
                            <div class="form-group">
                                <label for="product_values">Cantidad maxima del productos </label>
                                <input type="number"  class="form-control" min="0" max="100" name="product_values" placeholder="Litros de producto actual" value="0" id="" required>
                            </div>
                            <div class="form-group">
                                <label for="min_product_values">cantidad minima del producto </label>
                                <input type="number" name="min_product_values" min="0" max="100" class="form-control" placeholder="Litros minimos para hacer recarga" value="0" required>
                            </div>
                        </div>
                        <button type="submit" id="submitAddTank" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('extra-scripts')
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#submitEditar').click(function(e){
                $('#editMachineModal').find('input[name=mac]').parent().removeClass('has-error');
                $('#editMachineModal').find('input[name=name]').parent().removeClass('has-error');
                $('#editMachineModal').find('input[name=ubication]').parent().removeClass('has-error');
                e.preventDefault();
                var formData = new FormData(document.getElementById("formEditMachine"));
                var data = $("#formEditMachine").serialize();
                $.ajax({
                    type: "PUT",
                    url: "api/machine/"+formData.get('machine_id'),
                    headers: {
                        "X-CSRF-TOKEN": formData.get('_token')
                    },
                    data: data,
                    dataType: "text",
                    success: function(response) {
                        if(response){
                            $('#editMachineModal').modal('toggle');
                            swal({
                                title: "Edición completada!",
                                icon: "success",
                            });
                            var machine = JSON.parse(response)
                            var a = $('#dateMachine'+machine.id);
                            a.empty();
                            a.append(machine.mac+', '+machine.name+' ('+machine.ubication+')')

                        }else{
                            alert('no se ha podido actualizar, intente nuevamente')
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                        if (XMLHttpRequest.status == 400) {
                            response = JSON.parse(XMLHttpRequest.responseText);
                            var text ='';
                            if(typeof(response.mac) != "undefined"){
                                $('#editMachineModal').find('input[name=mac]').parent().addClass('has-error');
                                text += response.mac[0]+'\n'
                            }
                            if(typeof(response.name) != "undefined"){

                                $('#editMachineModal').find('input[name=name]').parent().addClass('has-error');
                                text += response.name[0]+'\n'
                            }
                            if(typeof(response.ubication) != "undefined"){
                                $('#editMachineModal').find('input[name=ubication]').parent().addClass('has-error');
                                text += response.ubication[0]+'\n'
                            }
                            swal({
                                title: "Ha ocurrido un error",
                                text: text,
                                icon: "warning",
                                buttons: false,
                                dangerMode: true,
                            })
                        } else {
                            alert('ocurrio un problema con el servidor');
                        }
                    }
                });
            });
            $('#submitAgregar').click(function(e){
                e.preventDefault();
                $('#addMachineModal').find('input[name=mac]').parent().removeClass('has-error');
                $('#addMachineModal').find('input[name=name]').parent().removeClass('has-error');
                $('#addMachineModal').find('input[name=ubication]').parent().removeClass('has-error');
                var formData = new FormData(document.getElementById("formAddMachine"));
                $.ajax({
                    type: "POST",
                    url: "api/machine",
                    headers: {
                        "X-CSRF-TOKEN": formData.get('_token')
                    },
                    data: {'name': formData.get('name'),
                        'ubication': formData.get('ubication'),
                        'mac':  formData.get('mac')
                    },
                    dataType: "text",
                    success: function(response) {
                        $('#addMachineModal').modal('toggle');
                        swal({
                            title: "Creacion exitosa",
                            icon: "success",
                        });
                        var machine = JSON.parse(response);
                        $('#formAddMachine')[0].reset();
                        var newMachine = '<div  class="panel box box-primary">' +
                            '                                            <div class="box-header with-border">' +
                            '                                                <h4 class="box-title">' +
                            '                                                    <a data-toggle="collapse" id="dateMachine'+machine.id+'" data-parent="#accordion" href="#collpapse'+machine.id+'" aria-expanded="false" onclick="showTank(this)" data-machine="'+machine.id+'" class="collapsed">' +
                            '                                                       '+machine.id.toString(16)+' '+machine.mac+', '+machine.name+' ('+machine.ubication+')' +
                            '                                                    </a>' +
                            '                                                </h4>' +
                            '                                                <div class="pull-right">' +
                            '                                                        <a class="" data-toggle="modal" data-target="#editMachineModal" data-machine="'+machine.id+'" onclick="editMachine(this)" ><span><i style="color: dodgerblue;"  class="fa fa-2x fa-edit"></i></span></a>' +
                            '                                                        <a type="button" onclick="destroyMachine(this)" data-machine ="'+machine.id+'"><span><i style="color:darkgray" class="fa fa-2x fa-trash"></i></span></a>'+
                            '                                                </div>' +
                            '                                            </div>' +
                            '                                            <div id="collpapse'+machine.id+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">' +
                            '                                                <div class="box-body">' +
                            '                                                    <div class="dropdown">' +
                            '                                                        <a style="background-color: white"  id="agregarBtn'+machine.id+'" class="btn btn-default" data-toggle="modal" data-machine="'+machine.id+'" onclick="addTank(this)" data-target="#addTank"><span style="color: dodgerblue"><i class="fa fa-plus"></i></span>Agregar</a>' +
                            '                                                        <a style="background-color: white" id="editarBtn'+machine.id+'" class="btn btn-default disabled" data-toggle="modal" data-target="#editTank"><span style="color: dodgerblue"><i class="fa fa-edit"></i></span>Editar</a>' +
                            '                                                        <a style="background-color: white"  class="btn btn-default disable"  id="eliminarBtn'+machine.id+'" onclick="destroyTank(this)" data-tank="" data-machine="'+machine.id+'"><span style="color:darkgray"><i class="fa fa-trash"></i></span>Eliminar</a>'+
                            '                                                    </div>' +
                            '                                                    <br>' +
                            '                                                    <table id="tankTable'+machine.id+'" class="display table table-striped table-bordered" width="100%" cellspacing="0">' +
                            '                                                        <thead>' +
                            '                                                        <tr>' +
                            '                                                            <th>id</th>' +
                            '                                                            <th>Número de cilindro</th>' +
                            '                                                            <th>Estatus</th>' +
                            '                                                            <th>Producto</th>' +
                            '                                                            <th>Cantidad (litros) </th>' +
                            '                                                            <th>Cantidad minima (litros) </th>' +
                            '                                                            <th>Alerta </th>' +
                            '                                                        </tr>' +
                            '                                                        </thead>' +
                            '                                                        <tbody ></tbody>' +
                            '                                                    </table>' +
                            '                                                </div>' +
                            '                                            </div>' +
                            '                                        </div>'

                        $('#accordion').append(newMachine);

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        if (XMLHttpRequest.status == 400) {
                            response = JSON.parse(XMLHttpRequest.responseText);
                            var text ='';
                            if(typeof(response.mac) != "undefined"){
                                $('#addMachineModal').find('input[name=mac]').parent().addClass('has-error');
                                text += response.mac[0]+'\n'
                            }
                            if(typeof(response.name) != "undefined"){

                                $('#addMachineModal').find('input[name=name]').parent().addClass('has-error');
                                text += response.name[0]+'\n'
                            }
                            if(typeof(response.ubication) != "undefined"){
                                $('#addMachineModal').find('input[name=ubication]').parent().addClass('has-error');
                                text += response.ubication[0]+'\n'
                            }
                            swal({
                                title: "Ha ocurrido un error",
                                text: text,
                                icon: "warning",
                                buttons: false,
                                dangerMode: true,
                            })
                        } else {
                            alert('ocurrio un problema con el servidor');
                        }
                    }
                });
            });
            $('#submitAddTank').click(function(e){
                e.preventDefault();
                $("#addTankForm input[name=machine_id]").parent().removeClass('has-error');
                $("#addTankForm input[name=product_values]").parent().removeClass('has-error');
                $("#addTankForm input[name=min_product_values]").parent().removeClass('has-error');
                $("#addTankForm input[name=status]").parent().removeClass('has-error');
                $("#addTankForm input[name=product_id]").parent().removeClass('has-error');
                var formData = $('#addTankForm').serialize();
                $.ajax({
                    type: "POST",
                    url: "api/tank/forTable",
                    headers: {
                        "X-CSRF-TOKEN": formData['token']
                    },
                    data: formData,
                    dataType: "text",
                    success: function(response) {
                        $('#addTank').modal('toggle');
                        swal({
                            title: "Se a registrado el tanque con exito!",
                            icon: "success",
                            button: true,
                        });
                        $('#addTankForm')[0].reset()

                        var tank = JSON.parse(response);
                        let parent = $('#tankTable'+tank.machine_id).parent().parent().parent().parent();
                        $('#tankTable'+tank.machine_id).dataTable().fnDestroy(true);
                        row= '<table id="tankTable'+tank.machine_id+'" class="display table table-striped table-bordered" width="100%" cellspacing="0">' +
                            '                                                        <thead>' +
                            '                                                        <tr>' +
                            '                                                            <th>id</th>' +
                            '                                                            <th>Número de cilindro</th>' +
                            '                                                            <th>Estatus</th>' +
                            '                                                            <th>Producto</th>' +
                            '                                                            <th>Cantidad maxima (litros) </th>' +
                            '                                                            <th>Cantidad minima (litros) </th>' +
                            '                                                            <th>Alerta </th>' +
                            '                                                        </tr>' +
                            '                                                        </thead>' +
                            '                                                        <tbody></tbody>' +
                            '                                                    </table>';
                        parent.append(row)
                        initDatatable(tank.machine_id);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                        if (XMLHttpRequest.status == 400) {
                            response = JSON.parse(XMLHttpRequest.responseText);
                            console.log(response);
                            var text ='';
                            if(typeof(response.machine_id) != "undefined"){
                                $('#addTankForm').find('input[name=machine_id]').parent().addClass('has-error');
                                text += response.machine_id[0]+'\n'
                            }
                            if(typeof(response.product_values) != "undefined"){

                                $('#addTankForm').find('input[name=product_values]').parent().addClass('has-error');
                                text += response.product_values[0]+'\n'
                            }
                            if(typeof(response.product_id) != "undefined"){

                                $('#addTankForm').find('input[name=product_id]').parent().addClass('has-error');
                                text += response.product_id[0]+'\n'
                            }
                            if(typeof(response.min_product_values) != "undefined"){

                                $('#addTankForm').find('input[name=min_product_values]').parent().addClass('has-error');
                                text += response.min_product_values[0]+'\n'
                            }
                            if(typeof(response.status) != "undefined"){

                                $('#addTankForm').find('input[name=status]').parent().addClass('has-error');
                                text += response.status[0]+'\n'
                            }
                            swal({
                                title: "Ha ocurrido un error",
                                text: text,
                                icon: "warning",
                                buttons: false,
                                dangerMode: true,
                            })
                        } else {
                            alert('ocurrio un problema con el servidor');
                        }
                    }
                });
            });
        });
        $('#submitEditTankForm').click(function (e){
            e.preventDefault();
            var formData = new FormData(document.getElementById("editTankForm"));

            $("#editTankForm input[name=machine_id]").parent().removeClass('has-error');
            $("#editTankForm input[name=product_values]").parent().removeClass('has-error');
            $("#editTankForm input[name=min_product_values]").parent().removeClass('has-error');
            $("#editTankForm input[name=status]").parent().removeClass('has-error');
            $("#editTankForm input[name=product_id]").parent().removeClass('has-error');

            $.ajax({
                type: "PUT",
                url: "api/tank/"+formData.get('tank')+"/forTable",
                headers: {
                    "X-CSRF-TOKEN": formData.get('_token')
                },
                data: {'machine_id': formData.get('machine_id'),
                    'status':  formData.get('status'),
                    'product_values': formData.get('product_values'),
                    'product_id': formData.get('product_id'),
                    'min_product_values': formData.get('min_product_values')
                },
                dataType: "text",
                success: function(response) {
                    $('#editTank').modal('toggle');
                    swal({
                        title: "Actualizacón exitosa!",
                        icon: "success",
                        button: true,
                    });
                    var tank = JSON.parse(response);
                    let parent = $('#tankTable'+tank.machine_id).parent().parent().parent().parent();
                    $('#tankTable'+tank.machine_id).dataTable().fnDestroy(true);
                    row= '<table id="tankTable'+tank.machine_id+'" class="display table table-striped table-bordered" width="100%" cellspacing="0">' +
                        '                                                        <thead>' +
                        '                                                        <tr>' +
                        '                                                            <th>id</th>' +
                        '                                                            <th>Número de cilindro</th>' +
                        '                                                            <th>Estatus</th>' +
                        '                                                            <th>Producto</th>' +
                        '                                                            <th>Cantidad maxima (litros) </th>' +
                        '                                                            <th>Cantidad minima (litros) </th>' +
                        '                                                            <th>Alerta </th>' +
                        '                                                        </tr>' +
                        '                                                        </thead>' +
                        '                                                        <tbody></tbody>' +
                        '                                                    </table>';
                    parent.append(row)
                    initDatatable(tank.machine_id);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.status == 400) {
                        response = JSON.parse(XMLHttpRequest.responseText);
                        console.log(response);
                        var text ='';
                        if(typeof(response.machine_id) != "undefined"){
                            $('#editTankForm').find('input[name=machine_id]').parent().addClass('has-error');
                            text += response.machine_id[0]+'\n'
                        }
                        if(typeof(response.product_values) != "undefined"){

                            $('#editTankForm').find('input[name=product_values]').parent().addClass('has-error');
                            text += response.product_values[0]+'\n'
                        }
                        if(typeof(response.product_id) != "undefined"){

                            $('#editTankForm').find('input[name=product_id]').parent().addClass('has-error');
                            text += response.product_id[0]+'\n'
                        }
                        if(typeof(response.min_product_values) != "undefined"){

                            $('#editTankForm').find('input[name=min_product_values]').parent().addClass('has-error');
                            text += response.min_product_values[0]+'\n'
                        }
                        if(typeof(response.status) != "undefined"){

                            $('#editTankForm').find('input[name=status]').parent().addClass('has-error');
                            text += response.status[0]+'\n'
                        }
                        swal({
                            title: "Ha ocurrido un error",
                            text: text,
                            icon: "warning",
                            buttons: false,
                            dangerMode: true,
                        })
                    } else {
                        alert('ocurrio un problema con el servidor');
                    }
                }
            });
        });
        function editMachine(e) {
            $.ajax({
                type: "get",
                url: "api/machine/"+$(e).data('machine'),
                headers: {
                    "X-CSRF-TOKEN": window.Laravel,
                },
                dataType: "text",
                success: function(response){
                    response = JSON.parse(response);
                    $("#formEditMachine input[name=mac]").val(response.mac);
                    $("#formEditMachine input[name=name]").val(response.name);
                    $("#formEditMachine input[name=ubication]").val(response.ubication);
                }
            })
            $('#machine_id').val($(e).data('machine'));

        }
        function addTank(e) {
            $('#machine_idT').val($(e).data('machine'))
        }

        function destroyMachine(e){
            swal({
                title: "¿Seguro quiere este elemento?",
                text: "una vez eliminado no hay forma de recuperarlo\n tambien se eliminaran los tanques de esta maquina",
                icon: "warning",
                buttons: ['Cancelar','Eliminar'],
                dangerMode: true,
                closeModal: false,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'delete',
                            url: 'api/machine/'+$(e).data('machine'),
                            success: function(response){
                                swal({title: "Maquina eliminada con exito!", icon: "success", buttons:true});
                                var tank = JSON.parse(response);
                                tank.machine_id = $(e).data('machine');
                                let parent = $(e).parent().parent().parent();
                                parent.empty();
                                parent.remove();

                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest);
                                console.log(textStatus);
                                console.log(errorThrown);
                                if (XMLHttpRequest.status == 422) {
                                    var alerta = $('<div class="alert alert-danger alert-dismissible" role="alert"></div>');

                                    alerta.html(XMLHttpRequest.responseJSON.message);

                                    $('#alerta1').append(alerta);

                                    alerta.delay(3000).fadeOut();
                                } else {
                                    alert('ocurrio un problema con el servidor');
                                }
                            }
                        })
                    } else {
                    }
                });
        }

        function showTank(e) {
            if(!$('#tankTable'+$(e).data('machine')).is('.dataTable')) {
                initDatatable($(e).data('machine'));
            }else{
            }
        };
        function initDatatable(machine){
            $('#tankTable'+machine).DataTable( {
                "pageLength" : 5,
                "lengthMenu": [5,10,15,20,50],
                "sAjaxSource": 'api/machine/'+machine+'/tanksWhitProduct',
                "aaSorting" :[],
                "sAjaxDataProp": "" ,
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "bProcessing": "true",
                "aoColumns": [
                    { "mData": "id"},
                    { "mData": "tank_number"},
                    {
                        "mData": function (row, type, set) {
                            if(row.status == 1){
                                return 'activo'
                            }
                            return 'inactivo'
                        }
                    },
                    { "mData": "product_name" },
                    {"mData": "product_values"},
                    {"mData": "min_product_values"},
                    {
                        "mData": function (row, type, set) {
                            if(row.alert == 0){
                                return '<a class="text-green" href="#" onclick="alertTank(this)" data-tank="'+row.id+'" ><i " class="fa fa-check"></i> </a>';
                            }
                            return '<a class="text-red" href="#" onclick="alertTank(this)" data-tank="'+row.id+'" ><i class="fa fa-remove" aria-hidden="true"></i></a>';
                        }
                    }
                ]
            });
            $('#tankTable'+machine+' tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $('#editarBtn'+machine).addClass('disabled');
                    $('#eliminarBtn'+machine).addClass('disabled');



                } else {

                    var row = $(this).children();
                    //parametros de row: 0=>tank.id, 1=>tank.status, 2 => tank.product_name
                    var data = row[0].innerText;
                    $('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('#editarBtn'+machine).removeClass('disabled');
                    $('#eliminarBtn'+machine).removeClass('disabled');
                    $('#eliminarBtn'+machine).attr('data-tank',data);
                    $('#editTankInput').val(data);
                    $('#oldMachineIdInput').val(+machine);
                    $.ajax({
                        url: 'api/tank/'+data,
                        type: 'get',
                        headers: {
                            "X-CSRF-TOKEN": window.Laravel,
                        },
                        dataType: "text",
                        success: function(response){
                            var tank = JSON.parse(response);
                            $("#editTankForm input[name=product_values]").val(tank.product_values);
                            $("#editTankForm input[name=min_product_values]").val(tank.min_product_values);
                            $("#editTankForm select[name=status] option[value="+tank.status+"]").prop('selected',true);
                            $("#editTankForm select[name=machine_id] option[value="+tank.machine_id+"]").prop('selected',true);

                        }
                    })
                }
            });
        }

        function alertTank(e){
            $.ajax({
                method: 'put',
                url: 'api/tank/'+$(e).data('tank')+'/toggleAlert',
                success: function(response){

                    var tank = JSON.parse(response);
                    let parent = $('#tankTable'+tank.machine_id).parent().parent().parent().parent();
                    $('#tankTable'+tank.machine_id).dataTable().fnDestroy(true);
                    row= '<table id="tankTable'+tank.machine_id+'" class="display table table-striped table-bordered" width="100%" cellspacing="0">' +
                        '                                                        <thead>' +
                        '                                                        <tr>' +
                        '                                                            <th>id</th>' +
                        '                                                            <th>Número de cilindro</th>' +
                        '                                                            <th>Estatus</th>' +
                        '                                                            <th>Producto</th>' +
                        '                                                            <th>Cantidad (litros) </th>' +
                        '                                                            <th>Cantidad minima (litros) </th>' +
                        '                                                            <th>Alerta </th>' +
                        '                                                        </tr>' +
                        '                                                        </thead>' +
                        '                                                        <tbody></tbody>' +
                        '                                                    </table>';
                    parent.append(row)
                    initDatatable(tank.machine_id);
                }
            });
        }
        function destroyTank(e){
            swal({
                title: "Estas seguro?",
                text: "una vez eliminado, no podras recuperar este elemento",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'GET',
                            url: 'api/tank/'+$(e).data('tank')+'/destroy',
                            success: function(response){
                                $('#tankTable'+$(e).data('machine')).DataTable().rows('.selected').remove().draw();
                                swal({title: "Cilindro eliminado con exito!", icon: "success", buttons:true});
                            }
                        })

                    } else {
                    }
                });

        }
    </script>
@endpush