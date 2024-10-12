@extends('layouts.app')

@section('htmlheader_title')
    User
@endsection
@section('class-skin') skin-green @endsection

@section('contentheader_title')
    Users
@endsection
@section('here')
    Users
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <div>
                            <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Lista de compañias</h3>
                            <a class="btn btn-default" data-toggle="modal" data-target="#addModal" ><span><i style="color: dodgerblue" class="fa fa-plus"></i></span> Añadir</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div >
                            <table id="userTable" class="display table table stripped table bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="companyTBody">
                                @if(count($users))
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->type}}</td>
                                            <td>
                                                <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="{{$user->id}}"><span><i class="fa fa-2x fa-edit"></i></span></a>
                                                <a href="#" onclick="deleteP(this)" data-product="{{$user->id}}"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>
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
    @include('users.partials.addUserModal')
    @include('users.partials.editUserModal')

@endsection
@push('extra-scripts')

    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({

            });
        });
        function deleteP(e){
            swal({
                title: "¿Seguro desea eliminar este elemento?",
                icon: "warning",
                buttons: ['No','Si'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'api/user/'+$(e).data('product'),
                            method:'DELETE',
                            success: function (response) {
                                if(response == 'true'){
                                    swal({
                                        title: "Se ha eliminado exitosamente!",
                                        icon: "success",
                                    });
                                    $('tr.selected').removeClass('selected');
                                    $(e).parent().parent().addClass('selected');
                                    $('#userTable').DataTable().rows('.selected').remove().draw();
                                }else{

                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {

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
        function addP(){
            var data = $('#addForm').serialize();

            $('#addModal').find('input[name=email]').parent().removeClass('has-error');
            $('#addModal').find('input[name=name]').parent().removeClass('has-error');
            $('#addModal').find('input[name=password]').parent().removeClass('has-error');
            $('#addModal').find('input[name=type]').parent().removeClass('has-error');
            $.ajax({
                url: 'api/user',
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": data['_token']
                },
                data: data,
                dataType: "text",
                success: function (response) {
                    swal({
                        title: "Registro completado!",
                        icon: "success",
                    });
                    $('#addModal').modal('toggle');
                    $('#addForm')[0].reset();
                    var product = JSON.parse(response);
                    var options = '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>\n' +
                        '          <a href="#" onclick="deleteP(this)" data-product="'+product.id+'"><span><i style="color: darkgray"  class="fa fa-2x fa-trash"></i></span></a>';
                    var row = '                               <tr>' +
                    	'					<td>'+product.email+'</td>' +
                        '                                        <td>'+product.name+'</td>' +
                        '                                        <td>'+ product.password+'</td>' +
                        '                                        <td>'+ product.type+'</td>' +
                        '                                        <td>' +
                        '                                            <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+ product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>' +
                        '                                            <a href="#" onclick="deleteP(this)" data-product="'+ product.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>' +
                        '                                        </td>' +
                        '                                    </tr>'
                    $('#userTBody').append(row);
                    $('#userTable').DataTable().row.add([product.email,product.name,product.password,product.type,options]);
                    $('#userTable').DataTable().draw()


                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    response = JSON.parse(XMLHttpRequest.responseText);
                    console.log(response);
                    var text ='';
                    if(typeof(response.name) != "undefined"){
                        $('#addModal').find('input[name=name]').parent().addClass('has-error');
                        text += response.name[0]+'\n'
                    }
                    if(typeof(response.email) != "undefined"){

                        $('#addModal').find('input[name=email]').parent().addClass('has-error');
                        text += response.email[0]+'\n'
                    }
                    if(typeof(response.password) != "undefined"){

                        $('#addModal').find('input[name=password]').parent().addClass('has-error');
                        text += response.password[0]+'\n'
                    }
                    swal({
                        title: "Ha ocurrido un error",
                        text: text,
                        icon: "warning",
                        buttons: false,
                        dangerMode: true,
                    })
                }
            });
        }
        function editP(e){
            //si es un elemento que abre modal seteo el id de la configuracion
            if($(e).is('.edit')) {
                $('#productId').val($(e).data('product'));
                $('tr.selected').removeClass('selected');
                $(e).parent().parent().addClass('selected');
                if($(e).is('.edit')) {
                    var configID = $(e).data('product');
                    $('#productId').val(configID);
                    $('tr.selected').removeClass('selected');
                    $(e).parent().parent().addClass('selected');
                    $.ajax({
                        url: 'api/user/'+configID,
                        type: 'get',
                        headers: {
                            "X-CSRF-TOKEN": window.Laravel,
                        },
                        dataType: "text",
                        success: function (response) {
                            let config = JSON.parse(response);
                            $("#editForm input[name=email]").val(config.email);
                            $("#editForm input[name=name]").val(config.name   );
                            $("#editForm input[name=password]").val(config.password   );
                            $("#editForm input[name=type]").val(config.type   );
                        }
                    })
                }
            }
            //si no hago el envio de ajax ( este caso ocurre cuando hago submit)
            else{
                var data = $('#editForm').serialize();
                $('#editModal').find('input[name=email]').parent().removeClass('has-error');
            	$('#editModal').find('input[name=name]').parent().removeClass('has-error');
            	$('#editModal').find('input[name=password]').parent().removeClass('has-error');
            	$('#editModal').find('input[name=type]').parent().removeClass('has-error');

                console.log(data);

                $.ajax({
                    url: 'api/user/'+$('#productId').val(),
                    method: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": data['_token']
                    },
                    data: data,
                    dataType: "text",
                    success: function (response) {
                        $('#editModal').modal('toggle');
                        let product = JSON.parse(response);
                        swal({
                            title: "edición de compañia completado!",
                            icon: "success",
                        });
                        var options = '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>\n' +
                            '          <a href="#" onclick="deleteP(this)" data-product="'+product.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>';
                        $('#companyTable').DataTable().rows('.selected').remove().draw();
                        var row = '                               <tr>' +
                            '					     <td>'+product.email+'</td>' +
                       	    '                                        <td>'+product.name+'</td>' +
                            '                                        <td>'+ product.password+'</td>' +
                            '                                        <td>'+ product.type+'</td>' +
                            '                                        <td>' +
                            '                                            <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+ product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>' +
                            '                                            <a href="#" onclick="deleteP(this)" data-product="'+ product.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>' +
                            '                                        </td>' +
                            '                                    </tr>'
                        $('#userTBody').append(row);
                        $('#userTable').DataTable().row.add([product.email,product.name,product.password,product.type,options]);
                        $('#userTable').DataTable().draw()


                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        response = JSON.parse(XMLHttpRequest.responseText);
                        console.log(response);
                        var text ='';
                        if(typeof(response.name) != "undefined"){
                            $('#editModal').find('input[name=name]').parent().addClass('has-error');
                            text += response.name[0]+'\n'
                        }
                        if(typeof(response.email) != "undefined"){

                            $('#editModal').find('input[name=email]').parent().addClass('has-error');
                            text += response.email[0]+'\n'
                        }
                        if(typeof(response.password) != "undefined"){

                            $('#editModal').find('input[name=password]').parent().addClass('has-error');
                            text += response.password[0]+'\n'
                        }
                        swal({
                            title: "Ha ocurrido un error",
                            text: text,
                            icon: "warning",
                            buttons: false,
                            dangerMode: true,
                        })
                    }
                });
            }

        };

    </script>
@endpush