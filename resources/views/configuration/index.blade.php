@extends('layouts.app')

@section('htmlheader_title')
    Configuracion
@endsection

@section('class-skin') skin-yellow @endsection

@section('contentheader_title')
    Configuraciones
@endsection
@section('here')
    Configuraciones
@endsection

@section('main-content')
    <div class="container-fow spark-screen">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Administre sus configuraciones</h3>
                            <a class="btn btn-default" data-toggle="modal" data-target="#addModal" ><span><i style="color: dodgerblue" class="fa fa-plus"></i></span> Añadir</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div >
                            <table id="configTable" class="display table table stripped table bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Valor</th>
                                    <th>Descripción</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="productTBody">
                                @if(count($configurations))
                                    @foreach($configurations as $config)
                                        <tr>
                                            <td>{{$config->code}}</td>
                                            <td>{{$config->value}}</td>
                                            <td>{{$config->description}}</td>
                                            <td>
                                                <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editC    (this)" data-config="{{$config->id}}"><span><i class="fa fa-2x fa-edit"></i></span></a>
                                                <a href="#" onclick="deleteC(this)" data-config="{{$config->id}}"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>
                                            </td>
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
    @include('configuration.partials.editConfigurationModal')
    @include('configuration.partials.addConfigurationModal')

@endsection
@push('extra-scripts')

    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#configTable').DataTable({

            });
        });
        function deleteC(e){
            swal({
                title: "¿Seguro desea eliminar este elemento?",
                icon: "warning",
                buttons: ['No','Si'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'api/configuration/'+$(e).data('config'),
                            method:'DELETE',
                            success: function (response) {

                                if(response = true){
                                    swal({
                                        title: "Se ha eliminado con éxito",
                                        icon: "success",
                                    });
                                    $('tr.selected').removeClass('selected');
                                    $(e).parent().parent().addClass('selected');
                                    $('#configTable').DataTable().rows('.selected').remove().draw();
                                }else{

                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {

                                if (XMLHttpRequest.status == 400) {

                                } else {
                                    alert('ocurrio un problema con el servidor');
                                }
                            }

                        })
                    } else {
                    }
                });

        }
        function addC(){
            var data = $('#addForm').serialize();
            $("#addForm").find("input[name=code]").parent().removeClass('has-error');
            $("#addForm input[name=value]").parent().removeClass('has-error');
            $("#addForm input[name=description]").parent().removeClass('has-error');
            $.ajax({
                url: 'api/configuration',
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": data['_token']
                },
                data: data,
                dataType: "text",
                success: function (response) {
                    $('#addForm')[0].reset()
                    $('#addModal').modal('toggle');
                    swal({
                        title: "Creación exitosa!",
                        icon: "success",
                    });
                    var config = JSON.parse(response);
                    var options = '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editC(this)" data-config="'+config.id+'"><span><i  class="fa fa-2x fa-edit"></i></span></a>' +
                        '          <a href="#" onclick="deleteC(this)" data-config="'+config.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>';
                    var row = '                               <tr>' +
                        '                                        <td>'+config.code+'</td>' +
                        '                                        <td>'+ config.value+'</td>' +
                        '                                        <td>'+ config.description+'</td>' +
                        '                                        <td>' +
                        '                                            <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editC(this)" data-config="'+ config.id+'"><span><i  class="fa fa-2x fa-edit"></i></span></a>' +
                        '                                            <a href="#" onclick="deleteC(this)" data-config="'+ config.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>' +
                        '                                        </td>' +
                        '                                    </tr>'
                    $('#productTBody').append(row);
                    $('#configTable').DataTable().row.add([config.code,config.value,config.description,options]);
                    $('#configTable').DataTable().draw()


                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {

                    if (XMLHttpRequest.status == 400) {
                        response = JSON.parse(XMLHttpRequest.responseText);
                        var text ='';
                        if(typeof(response.code) != "undefined"){
                            $('#addModal').find('input[name=code]').parent().addClass('has-error');
                            text += response.code[0]+'\n'
                        }
                        if(typeof(response.value) != "undefined"){

                            $('#addModal').find('input[name=value]').parent().addClass('has-error');
                            text += response.value[0]+'\n'
                        }
                        if(typeof(response.description) != "undefined"){
                            $('#addModal').find('input[name=description]').parent().addClass('has-error');
                            text += response.description[0]+'\n'
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
        }
        function editC(e){
            //si es un elemento que abre modal seteo el id de la configuracion
            if($(e).is('.edit')) {
                configID =$(e).data('config');
                $('#configId').val(configID);
                $('tr.selected').removeClass('selected');
                $(e).parent().parent().addClass('selected');
                $.ajax({
                    url: 'api/configuration/'+configID,
                    type: 'get',
                    headers: {
                        "X-CSRF-TOKEN": window.Laravel,
                    },
                    dataType: "text",
                    success: function (response) {
                        let config = JSON.parse(response);
                        $("#editForm input[name=code]").val(config.code);
                        $("#editForm input[name=value]").val(config.value);
                        $("#editForm input[name=description]").val(config.description);

                    }
                })
            }
            //si no hago el envio de ajax ( este caso ocurre cuando hago submit)
            else{
                var data = $('#editForm').serialize();
                $("#editForm").find("input[name=code]").parent().removeClass('has-error');
                $("#editForm input[name=value]").parent().removeClass('has-error');
                $("#editForm input[name=description]").parent().removeClass('has-error');
                $.ajax({
                    url: 'api/configuration/'+$('#configId').val(),
                    method: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": data['_token']
                    },
                    data: data,
                    dataType: "text",
                    success: function (response) {

                        $('#configTable').DataTable().rows('.selected').remove().draw();
                        $('#editModal').modal('toggle');

                        swal({
                            title: "Edición exitosa!",
                            icon: "success",
                        });
                        var config = JSON.parse(response);
                        var options = '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editC(this)" data-config="'+config.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>' +
                            '          <a href="#" onclick="deleteC(this)" data-config="'+config.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>';
                        var row = '                               <tr>' +
                            '                                        <td>'+config.code+'</td>' +
                            '                                        <td>'+ config.value+'</td>' +
                            '                                        <td>'+ config.description+'</td>' +
                            '                                        <td>' +
                            '                                            <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editC(this)" data-product="'+ config.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>' +
                            '                                            <a href="#" onclick="deleteC(this)" data-product="'+ config.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>' +
                            '                                        </td>' +
                            '                                    </tr>'
                        $('#productTBody').append(row);
                        $('#configTable').DataTable().row.add([config.code,config.value,config.description,options]);
                        $('#configTable').DataTable().draw()


                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                        if (XMLHttpRequest.status == 400) {
                            response = JSON.parse(XMLHttpRequest.responseText);
                            var text ='';
                            if(typeof(response.code) != "undefined"){
                                $('#editModal').find('input[name=code]').parent().addClass('has-error');
                                text += response.code[0]+'\n'
                            }
                            if(typeof(response.value) != "undefined"){

                                $('#editModal').find('input[name=value]').parent().addClass('has-error');
                                text += response.value[0]+'\n'
                            }
                            if(typeof(response.description) != "undefined"){
                                $('#editModal').find('input[name=description]').parent().addClass('has-error');
                                text += response.description[0]+'\n'
                            }
                            swal({
                                title: "Ha ocurrido un error",
                                text: text,
                                icon: "warning",
                                buttons: false,
                                dangerMode: true,
                            })
                        } else {
                            alert('ocurrio un problema con el servidor')
                        }
                    }
                });
            }

        };

    </script>
@endpush