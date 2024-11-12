@extends('layouts.app')

@section('class-skin') skin-green @endsection

@section('htmlheader_title')
    Publicity
@endsection

@section('contentheader_title')
    Lista de publicidades <a class="btn btn-default" data-toggle="modal" data-target="#addModal" ><span><i style="color: dodgerblue" class="fa fa-plus"></i></span> Añadir</a>
@endsection
@section('here')
    Lista de publicidades
@endsection
@section('main-content')
    <div class="container-fluid spark-screen" id="container">
    <div class="progress"></div>

        @if(count($publicities))
            @foreach($publicities as $publicity)
                <div class="col-md-6" id="publicity{{$publicity->id}}">
                    <div class="x_panel div">
                        <div class="x_title ">
                            <video class="center-block img-responsive" poster="storage/img/{{$publicity->logo}}" controls width="500px"  alt="imagen no encontrada">
                                <source src="storage/img/{{$publicity->vid}}">
                            </video>

                        </div>
                        <div class="x_content">
                            <div class="box-group" id="accordion">

                                <div class="panel box box-primary" >
                                    <div class="box-header with-border text-center">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$publicity->id}}" data-parent="#accordion" aria-expanded="false" class="collapsed">
                                                Datos de la publicidad
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{$publicity->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            <table class="table table-condensed table-striped ">
                                                <tbody>
                                                <tr>
                                                    <th>Nombre:</th>
                                                    <td>{{$publicity->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Descripción:</th>
                                                    <td>{{$publicity->description}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Compañia:</th>
                                                    <td>{{$publicity->company->name}}</td>
                                                </tr>
                                                <tr>

                                                    <td>
                                                        <a class="btn btn-block btn-success edit" href="#"  data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="{{$publicity->id}}">Editar <span><i class="fa fa-edit"></i></span></a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-block bg-primary" href="#" onclick="deleteP(this)" data-product="{{$publicity->id}}">Eliminar <span><i class="fa fa-trash"></i></span></a>
                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box box-success text-center">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseM{{$publicity->id}}" onclick="showMachines({{$publicity->id}})" class="" aria-expanded="true">
                                                Maquinas asociadas
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseM{{$publicity->id}}" class="panel-collapse collapse"  aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            <form action="#" id="attachMachineForm{{$publicity->id}}" >
                                                <div class="form-group">
                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                        <select name="machine_id" class="form-control" title="seleccione la maquina para agregar">

                                                                @foreach($machines as $machine)
                                                                <option value="{{$machine->id}}">{{$machine->mac}}, {{$machine->name}} ({{$machine->ubication}})</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <a href="#" onclick="attachMachine({{$publicity->id}})" class="btn btn-success" >Agregar</a>
                                                @if(!count($machines))<h5 class="text-red">No hay maquinas <a class="text-aqua" href="{{route('machine.view')}}">click aqui</a> para registrar</h5> @endif
                                                </div>
                                                <br>
                                            </form>
                                            <h4 id="nohay{{$publicity->id}}">Cargando...</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @include('publicity.partials.addPublicityModal')
    @include('publicity.partials.editPublicityModal')

@endsection
@push('extra-scripts')

    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js')}}"></script>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.24.min.js"></script>
    <script>
        window.machines = <?php echo $machines->toJson(); ?>;
    AWS.config.update({
        accessKeyId : {{env('AWS_ACCESS_KEY_ID')}},
        secretAccessKey : {{env('AWS_SECRET_KEY_ID')}}
    });
        function UploadS3()
        {
            let resource = $('#addModal').find('input[name=logo]')[0];
        console.log(resource);    
	var bucket = new AWS.S3({params: {Bucket: 'ecomatic'}});
            var upFile = resource.files[0];
            if (upFile) 
            {
                var uploadParams = {Key: 'storage/'+    upFile.name, ContentType: upFile.type, Body: upFile};
                bucket.upload(uploadParams)
                .on('build', function(req) { req.httpRequest.headers['Access-Control-Allow-Origin'] = '*';   })
                .on('httpUploadProgress', function(evt) {
                    var percentComplete = evt.loaded / evt.total;
                    //Do something with upload progress
                    document.getElementById('progress_add').style = 'width :'+percentComplete*100+'%';
                    console.log(percentComplete);
                }).send(function(err, data) {
                    if(err){console.log('err',err); alert('problema al subir el logo')}
                    else{
                        let resource = $('#addModal').find('input[name=vid]')[0];
                        var bucket = new AWS.S3({params: {Bucket: 'ecomatic'}});
                        var upFile = resource.files[0];
                        if (upFile) 
                        {
                            var uploadParams = {Key: 'storage/'+    upFile.name, ContentType: upFile.type, Body: upFile};
                            bucket.upload(uploadParams)
                            .on('build', function(req) { req.httpRequest.headers['Access-Control-Allow-Origin'] = '*';   })
                            .on('httpUploadProgress', function(evt) {
                                var percentComplete = evt.loaded / evt.total;
                                //Do something with upload progress
                                document.getElementById('progress_add').style = 'width :'+percentComplete*100+'%';
                                console.log(percentComplete);
                            }).send(function(err, data) {
                                if(err){console.log('err',err); alert('problema al subir el video')}
                                else{
                                    /**
                                     $.ajax({
                                        url: 'api/publicity',
                                        contentType: false,
                                        processData: false,
                                        cache:false,
                                        method: 'POST',
                                        headers: {
                                            "X-CSRF-TOKEN": window.laravel
                                        },
                                        data: data,
                                        dataType: "json",
                                        success: function (response) {
                                            document.getElementById('progress_add').style = 'width :'+0;
                                            $('#addForm')[0].reset();
                                            $('#addModal').modal('toggle');
                                            var publicity = JSON.parse(response);
                                            
                                            $.ajax({
                                                url: 'api/company/'+publicity.company_id,
                                                method: 'get',
                                                headers: {
                                                    "X-CSRF-TOKEN": window.Laravel
                                                },
                                                success: function(response){
                                                    $('#addPsubmit').val('Guardar');
                                                    $('#addPsubmit').removeClass('disabled');
                                                    swal({
                                                        title: "Se ha registrado exitosamente!",
                                                        icon: "success",
                                                    });
                                                    publicity.company = JSON.parse(response);
                                                    var optmachines = '';
                                                    for(var i=0;i< window.machines.length;i++)
                                                    {
                                                        optmachines += '<option value="'+window.machines[i].id+'">'+window.machines[i].mac+', '+window.machines[i].name+' ('+window.machines[i].ubication+')</option>';
                                                    }
                                                    var panel = '<div class="col-md-6" id="publicity'+publicity.id+'">' +
                                                        '                    <div class="x_panel div">' +
                                                        '                        <div class="x_title ">' +
                                                        '                            <video class="center-block img-responsive" poster="storage/img/'+publicity.logo+'" controls width="500px"  alt="imagen no encontrada">' +
                                                        '                                <source src="storage/img/'+publicity.vid+'">' +
                                                        '                            </video>' +
                                                        '' +
                                                        '                        </div>' +
                                                        '                        <div class="x_content">' +
                                                        '                            <div class="box-group" id="accordion">' +
                                                        '' +
                                                        '                                <div class="panel box box-primary" >' +
                                                        '                                    <div class="box-header with-border text-center">' +
                                                        '                                        <h4 class="box-title">' +
                                                        '                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'+publicity.id+'" data-parent="#accordion" aria-expanded="false" class="collapsed">' +
                                                        '                                                Datos de la publicidad' +
                                                        '                                            </a>' +
                                                        '                                        </h4>' +
                                                        '                                    </div>' +
                                                        '                                    <div id="collapse'+publicity.id+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">' +
                                                        '                                        <div class="box-body">' +
                                                        '                                            <table class="table table-condensed table-striped ">' +
                                                        '                                                <tbody>' +
                                                        '                                                <tr>' +
                                                        '                                                    <th>Nombre:</th>' +
                                                        '                                                    <td>'+publicity.name+'</td>' +
                                                        '                                                </tr>' +
                                                        '                                                <tr>' +
                                                        '                                                    <th>Descripción:</th>' +
                                                        '                                                    <td>'+publicity.description+'</td>' +
                                                        '                                                </tr>' +
                                                        '                                                <tr>' +
                                                        '                                                    <th>Compañia:</th>' +
                                                        '                                                    <td>'+publicity.company.name+'</td>' +
                                                        '                                                </tr>' +
                                                        '                                                <tr>' +
                                                        '' +
                                                        '                                                    <td>' +
                                                        '                                                        <a class="btn btn-block btn-success edit" href="#"  data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+publicity.id+'">Editar <span><i class="fa fa-edit"></i></span></a>' +
                                                        '                                                    </td>' +
                                                        '                                                    <td>' +
                                                        '                                                        <a class="btn btn-block bg-primary" href="#" onclick="deleteP(this)" data-product="'+publicity.id+'">Eliminar <span><i class="fa fa-trash"></i></span></a>' +
                                                        '                                                    </td>' +
                                                        '' +
                                                        '                                                </tr>' +
                                                        '                                                </tbody>' +
                                                        '                                            </table>' +
                                                        '                                        </div>' +
                                                        '                                    </div>' +
                                                        '                                </div>' +
                                                        '                                <div class="panel box box-success text-center">' +
                                                        '                                    <div class="box-header with-border">' +
                                                        '                                        <h4 class="box-title">' +
                                                        '                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseM'+publicity.id+'" onclick="showMachines('+publicity.id+')" class="" aria-expanded="true">' +
                                                        '                                                Maquinas asociadas' +
                                                        '                                            </a>' +
                                                        '                                        </h4>' +
                                                        '                                    </div>' +
                                                        '                                    <div id="collapseM'+publicity.id+'" class="panel-collapse collapse"  aria-expanded="false" style="height: 0px;">' +
                                                        '                                        <div class="box-body">' +
                                                        '                                            <form action="#" id="attachMachineForm'+publicity.id+'" >' +
                                                        '                                                <div class="form-group">' +
                                                        '                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">' +
                                                        '                                                        <select name="machine_id" class="form-control" title="seleccione la maquina para agregar">'
                                                        +optmachines+
                                                        '                                                        </select>' +
                                                        '                                                    </div>' +
                                                        '                                                    <a href="#" onclick="attachMachine('+publicity.id+')" class="btn btn-success" >Agregar</a>' +
                                                        '                                                @if(!count($machines))<h5 class="text-red">No hay maquinas <a class="text-aqua" href="/company">click aqui</a> para registrar</h5> @endif' +
                                                        '                                                </div>' +
                                                        '                                            </form>' +
                                                        '                                            <br>' +
                                                        '                                        </div>' +
                                                        '                                    </div>' +
                                                        '                                </div>' +
                                                        '                            </div>' +
                                                        '' +
                                                        '                        </div>' +
                                                        '                    </div>' +
                                                        '                </div>';
                                                    $('#container').append(panel);
                                                }
                                            });
                                            
                                             
                                             //locatio
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            document.getElementById('progress_add').style = 'width :'+0;

                                            $('#addPsubmit').val('Guardar');
                                            $('#addPsubmit').removeClass('disabled');
                                            response = JSON.parse(XMLHttpRequest.responseText);
                                            console.log(response);
                                            var text ='';
                                            if(typeof(response.name) != "undefined"){
                                                $('#addModal').find('input[name=name]').parent().addClass('has-error');
                                                text += response.name[0]+'\n'
                                            }
                                            if(typeof(response.company_id) != "undefined"){

                                                $('#addModal').find('input[name=company_id]').parent().addClass('has-error');
                                                text += response.company_id[0]+'\n'
                                            }
                                            if(typeof(response.description) != "undefined"){

                                                $('#addModal').find('input[name=description]').parent().addClass('has-error');
                                                text += response.description[0]+'\n'
                                            }
                                            if(typeof(response.vid) != "undefined"){

                                                $('#addModal').find('input[name=vid]').parent().addClass('has-error');
                                                text += response.vid[0]+'\n'
                                            }
                                            if(typeof(response.logo) != "undefined"){

                                                $('#addModal').find('input[name=logo]').parent().addClass('has-error');
                                                text += response.logo[0]+'\n'
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
                                    */
                                    
                                }
                            });
                        }
                    }
                });
            } 
        }
    </script>
    <script>

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
                             url: 'api/publicity/' + $(e).data('product'),
                             method: 'DELETE',
                             success: function (response) {
                                 if (response = true) {
                                     swal({
                                         title: "Se ha eliminado exitosamente!",
                                         icon: "success",
                                     });
                                     $('#publicity' + $(e).data('product')).empty();
                                     $('#publicity' + $(e).data('product')).remove();


                                 } else {

                                 }
                             },
                             error: function (XMLHttpRequest, textStatus, errorThrown) {

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
            $('#addPsubmit').val('Cargando...');
            $('#addPsubmit').addClass('disabled');
            var data = new FormData(document.getElementById('addForm'));
             $('#addModal').find('input[name=description]').parent().removeClass('has-error');
             $('#addModal').find('input[name=name]').parent().removeClass('has-error');
             $('#addModal').find('input[name=company_id]').parent().removeClass('has-error');
             $('#addModal').find('input[name=vid]').parent().removeClass('has-error');
             $('#addModal').find('input[name=logo]').parent().removeClass('has-error');
            UploadS3()
		$.ajax({
                xhr: function()
                {
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with upload progress
                            document.getElementById('progress_add').style = 'width :'+percentComplete*100+'%';
                            console.log(percentComplete);
                        }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with download progress
                            console.log(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                url: 'api/publicity',
                contentType: false,
                processData: false,
                cache:false,
                method: 'POST',
		enctype:"multipart/form-data",
                headers: {
                    "X-CSRF-TOKEN": window.laravel
                },
                data: data,
                dataType: "json",
                enctype:"multipart/form-data",
                success: function (response) {
                    document.getElementById('progress_add').style = 'width :'+0;
                    $('#addForm')[0].reset();
                    $('#addModal').modal('toggle');
                    var publicity = response;
                    $.ajax({
                        url: 'api/company/'+publicity.company_id,
                        method: 'get',
                        headers: {
                            "X-CSRF-TOKEN": window.Laravel
                        },
                        success: function(response){
                            $('#addPsubmit').val('Guardar');
                            $('#addPsubmit').removeClass('disabled');
                            swal({
                                title: "Se ha registrado exitosamente!",
                                icon: "success",
                            });
                            publicity.company = JSON.parse(response);
                            var optmachines = '';
                            for(var i=0;i< window.machines.length;i++)
                            {
                                optmachines += '<option value="'+window.machines[i].id+'">'+window.machines[i].mac+', '+window.machines[i].name+' ('+window.machines[i].ubication+')</option>';
                            }
                            var panel = '<div class="col-md-6" id="publicity'+publicity.id+'">' +
                                '                    <div class="x_panel div">' +
                                '                        <div class="x_title ">' +
                                '                            <video class="center-block img-responsive" poster="storage/img/'+publicity.logo+'" controls width="500px"  alt="imagen no encontrada">' +
                                '                                <source src="storage/img/'+publicity.vid+'">' +
                                '                            </video>' +
                                '' +
                                '                        </div>' +
                                '                        <div class="x_content">' +
                                '                            <div class="box-group" id="accordion">' +
                                '' +
                                '                                <div class="panel box box-primary" >' +
                                '                                    <div class="box-header with-border text-center">' +
                                '                                        <h4 class="box-title">' +
                                '                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'+publicity.id+'" data-parent="#accordion" aria-expanded="false" class="collapsed">' +
                                '                                                Datos de la publicidad' +
                                '                                            </a>' +
                                '                                        </h4>' +
                                '                                    </div>' +
                                '                                    <div id="collapse'+publicity.id+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">' +
                                '                                        <div class="box-body">' +
                                '                                            <table class="table table-condensed table-striped ">' +
                                '                                                <tbody>' +
                                '                                                <tr>' +
                                '                                                    <th>Nombre:</th>' +
                                '                                                    <td>'+publicity.name+'</td>' +
                                '                                                </tr>' +
                                '                                                <tr>' +
                                '                                                    <th>Descripción:</th>' +
                                '                                                    <td>'+publicity.description+'</td>' +
                                '                                                </tr>' +
                                '                                                <tr>' +
                                '                                                    <th>Compañia:</th>' +
                                '                                                    <td>'+publicity.company.name+'</td>' +
                                '                                                </tr>' +
                                '                                                <tr>' +
                                '' +
                                '                                                    <td>' +
                                '                                                        <a class="btn btn-block btn-success edit" href="#"  data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+publicity.id+'">Editar <span><i class="fa fa-edit"></i></span></a>' +
                                '                                                    </td>' +
                                '                                                    <td>' +
                                '                                                        <a class="btn btn-block bg-primary" href="#" onclick="deleteP(this)" data-product="'+publicity.id+'">Eliminar <span><i class="fa fa-trash"></i></span></a>' +
                                '                                                    </td>' +
                                '' +
                                '                                                </tr>' +
                                '                                                </tbody>' +
                                '                                            </table>' +
                                '                                        </div>' +
                                '                                    </div>' +
                                '                                </div>' +
                                '                                <div class="panel box box-success text-center">' +
                                '                                    <div class="box-header with-border">' +
                                '                                        <h4 class="box-title">' +
                                '                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseM'+publicity.id+'" onclick="showMachines('+publicity.id+')" class="" aria-expanded="true">' +
                                '                                                Maquinas asociadas' +
                                '                                            </a>' +
                                '                                        </h4>' +
                                '                                    </div>' +
                                '                                    <div id="collapseM'+publicity.id+'" class="panel-collapse collapse"  aria-expanded="false" style="height: 0px;">' +
                                '                                        <div class="box-body">' +
                                '                                            <form action="#" id="attachMachineForm'+publicity.id+'" >' +
                                '                                                <div class="form-group">' +
                                '                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">' +
                                '                                                        <select name="machine_id" class="form-control" title="seleccione la maquina para agregar">'
                                +optmachines+
                                '                                                        </select>' +
                                '                                                    </div>' +
                                '                                                    <a href="#" onclick="attachMachine('+publicity.id+')" class="btn btn-success" >Agregar</a>' +
                                '                                                @if(!count($machines))<h5 class="text-red">No hay maquinas <a class="text-aqua" href="/company">click aqui</a> para registrar</h5> @endif' +
                                '                                                </div>' +
                                '                                            </form>' +
                                '                                            <br>' +
                                '                                        </div>' +
                                '                                    </div>' +
                                '                                </div>' +
                                '                            </div>' +
                                '' +
                                '                        </div>' +
                                '                    </div>' +
                                '                </div>';
                            $('#container').append(panel);
                        }
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    document.getElementById('progress_add').style = 'width :'+0;

                    $('#addPsubmit').val('Guardar');
                    $('#addPsubmit').removeClass('disabled');
                    response = JSON.parse(XMLHttpRequest.responseText);
                    console.log(response);
                    var text ='';
                    if(typeof(response.name) != "undefined"){
                        $('#addModal').find('input[name=name]').parent().addClass('has-error');
                        text += response.name[0]+'\n'
                    }
                    if(typeof(response.company_id) != "undefined"){

                        $('#addModal').find('input[name=company_id]').parent().addClass('has-error');
                        text += response.company_id[0]+'\n'
                    }
                    if(typeof(response.description) != "undefined"){

                        $('#addModal').find('input[name=description]').parent().addClass('has-error');
                        text += response.description[0]+'\n'
                    }
                    if(typeof(response.vid) != "undefined"){

                        $('#addModal').find('input[name=vid]').parent().addClass('has-error');
                        text += response.vid[0]+'\n'
                    }
                    if(typeof(response.logo) != "undefined"){

                        $('#addModal').find('input[name=logo]').parent().addClass('has-error');
                        text += response.logo[0]+'\n'
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
                var pubID = $(e).data('product');
                $('#productId').val(pubID);
                $.ajax({
                    url: 'api/publicity/'+pubID,
                    type: 'get',
                    headers: {
                        "X-CSRF-TOKEN": window.Laravel,
                    },
                    success: function (response) {
                        let config = JSON.parse(response);
                        $("#editForm").find("input[name=name]").val(config.name);
                        $("#editForm").find("input[name=description]").val(config.description);
                        $("#editForm").find("select[name=company_id] option[value="+config.company_id+"]").prop('selected',true);


                    }
                })
            }
            //si no hago el envio de ajax ( este caso ocurre cuando hago submit)
            else{

                $('#editModal').find('input[name=description]').parent().removeClass('has-error');
                $('#editModal').find('input[name=name]').parent().removeClass('has-error');
                $('#editdModal').find('input[name=company_id]').parent().removeClass('has-error');
                $('#editModal').find('input[name=vid]').parent().removeClass('has-error');
                $('#editModal').find('input[name=logo]').parent().removeClass('has-error');
                var data = new FormData(document.getElementById('editForm'));
                $.ajax({
                    url: 'api/publicity/'+$('#productId').val(),
                    method: 'post',
                    contentType: false,
                    processData: false,
                    dataType: 'text',
                    headers: {
                        "X-CSRF-TOKEN": window.Laravel
                    },
                    data: data,
                    success: function (response) {
                        $('#editForm')[0].reset();
                        $('#editModal').modal('toggle');
                        var publicity = JSON.parse(response)
                        $.ajax({
                            url: 'api/company/'+publicity.company_id,
                            method: 'get',
                            headers: {
                                "X-CSRF-TOKEN": window.Laravel
                            },
                            success: function(response){
                                swal({
                                    title: "Se ha registrado exitosamente!",
                                    icon: "success",
                                });
                                $('#publicity'+publicity.id).empty();
                                $('#publicity'+publicity.id).remove();
                                publicity.company = JSON.parse(response);
                                var optmachines = '';
                                for(var i=0;i< window.machines.length;i++)
                                {
                                    optmachines += '<option value="'+window.machines[i].id+'">'+window.machines[i].mac+', '+window.machines[i].name+' ('+window.machines[i].ubication+')</option>';
                                }
                                console.log(optmachines)
                                var panel = '<div class="col-md-6" id="publicity'+publicity.id+'">' +
                                    '                    <div class="x_panel div">' +
                                    '                        <div class="x_title ">' +
                                    '                            <video class="center-block img-responsive" poster="storage/img/'+publicity.logo+'" controls width="500px"  alt="imagen no encontrada">' +
                                    '                                <source src="storage/img/'+publicity.vid+'">' +
                                    '                            </video>' +
                                    '' +
                                    '                        </div>' +
                                    '                        <div class="x_content">' +
                                    '                            <div class="box-group" id="accordion">' +
                                    '' +
                                    '                                <div class="panel box box-primary" >' +
                                    '                                    <div class="box-header with-border text-center">' +
                                    '                                        <h4 class="box-title">' +
                                    '                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'+publicity.id+'" data-parent="#accordion" aria-expanded="false" class="collapsed">' +
                                    '                                                Datos de la publicidad' +
                                    '                                            </a>' +
                                    '                                        </h4>' +
                                    '                                    </div>' +
                                    '                                    <div id="collapse'+publicity.id+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">' +
                                    '                                        <div class="box-body">' +
                                    '                                            <table class="table table-condensed table-striped ">' +
                                    '                                                <tbody>' +
                                    '                                                <tr>' +
                                    '                                                    <th>Nombre:</th>' +
                                    '                                                    <td>'+publicity.name+'</td>' +
                                    '                                                </tr>' +
                                    '                                                <tr>' +
                                    '                                                    <th>Descripción:</th>' +
                                    '                                                    <td>'+publicity.description+'</td>' +
                                    '                                                </tr>' +
                                    '                                                <tr>' +
                                    '                                                    <th>Compañia:</th>' +
                                    '                                                    <td>'+publicity.company.name+'</td>' +
                                    '                                                </tr>' +
                                    '                                                <tr>' +
                                    '' +
                                    '                                                    <td>' +
                                    '                                                        <a class="btn btn-block btn-success edit" href="#"  data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+publicity.id+'">Editar <span><i class="fa fa-edit"></i></span></a>' +
                                    '                                                    </td>' +
                                    '                                                    <td>' +
                                    '                                                        <a class="btn btn-block bg-primary" href="#" onclick="deleteP(this)" data-product="'+publicity.id+'">Eliminar <span><i class="fa fa-trash"></i></span></a>' +
                                    '                                                    </td>' +
                                    '' +
                                    '                                                </tr>' +
                                    '                                                </tbody>' +
                                    '                                            </table>' +
                                    '                                        </div>' +
                                    '                                    </div>' +
                                    '                                </div>' +
                                    '                                <div class="panel box box-success text-center">' +
                                    '                                    <div class="box-header with-border">' +
                                    '                                        <h4 class="box-title">' +
                                    '                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseM'+publicity.id+'" onclick="showMachines('+publicity.id+')" class="" aria-expanded="true">' +
                                    '                                                Maquinas asociadas' +
                                    '                                            </a>' +
                                    '                                        </h4>' +
                                    '                                    </div>' +
                                    '                                    <div id="collapseM'+publicity.id+'" class="panel-collapse collapse"  aria-expanded="false" style="height: 0px;">' +
                                    '                                        <div class="box-body">' +
                                    '                                            <form action="#" id="attachMachineForm'+publicity.id+'" >' +
                                    '                                                <div class="form-group">' +
                                    '                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">' +
                                    '                                                        <select name="machine_id" class="form-control" title="seleccione la maquina para agregar">'
                                        +optmachines+
                                    '                                                        </select>' +
                                    '                                                    </div>' +
                                    '                                                    <a href="#" onclick="attachMachine('+publicity.id+')" class="btn btn-success" >Agregar</a>' +
                                    '                                                @if(!count($machines))<h5 class="text-red">No hay maquinas <a class="text-aqua" href="/company">click aqui</a> para registrar</h5> @endif' +
                                    '                                                </div>' +
                                    '                                            </form>' +
                                    '                                            <br>' +
                                    '                                        </div>' +
                                    '                                    </div>' +
                                    '                                </div>' +
                                    '                            </div>' +
                                    '' +
                                    '                        </div>' +
                                    '                    </div>' +
                                    '                </div>';
                                $('#container').append(panel);
                            }
                        });
                    },

                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        response = JSON.parse(XMLHttpRequest.responseText);
                        var text ='';
                        if(typeof(response.name) != "undefined"){
                            $('#editModal').find('input[name=name]').parent().addClass('has-error');
                            text += response.name[0]+'\n'
                        }
                        if(typeof(response.company_id) != "undefined"){

                            $('#editModal').find('input[name=company_id]').parent().addClass('has-error');
                            text += response.company_id[0]+'\n'
                        }
                        if(typeof(response.description) != "undefined"){

                            $('#editModal').find('input[name=description]').parent().addClass('has-error');
                            text += response.description[0]+'\n'
                        }
                        if(typeof(response.vid) != "undefined"){

                            $('#editModal').find('input[name=vid]').parent().addClass('has-error');
                            text += response.vid[0]+'\n'
                        }
                        if(typeof(response.logo) != "undefined"){

                            $('#editModal').find('input[name=logo]').parent().addClass('has-error');
                            text += response.logo[0]+'\n'
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


         function showMachines(publicity){
             $.ajax({
                 url: 'api/publicity/'+publicity+'/showMachines',
                 mehthod:'get',
                 headers:{ "X-CSRF-TOKEN": window.Laravel},
                 success: function(response){
                     machines = JSON.parse(response);
                     $('#collapseM'+publicity).find("h4").remove();
                     $('#nohay'+publicity).remove();

                     for(i=0; i< machines.length; i++){
                         let machine = machines[i];
                         var row = '<h4>'+machine.mac+', '+machine.name+'('+machine.ubication+') <a class="text-danger" data-machine='+machine.id+' onclick="detachMachine('+publicity+',this)"><i class="fa fa-remove" aria-hidden="true"></i> </a></h4>'
                         $('#collapseM'+publicity).children().append(row)
                     }
                     if(machines.length == 0) $('#collapseM'+publicity).children().append('<h4 id="nohay'+publicity+'">No hay maquinas asignadas a esta publicidad</h4');

                 }
             })
         }
         function attachMachine(publicity){
             var form = $('#attachMachineForm'+publicity);
             $.ajax({
                 url: 'api/publicity/'+publicity+'/attachMachine',
                 method:'post',
                 headers:{ "X-CSRF-TOKEN": window.Laravel},
                 data: form.serialize(),
                 success: function(response){
                     if(response == 'false'){
                         swal({
                             title: "maquina ya registrada para esta publicidad",
                             text: text,
                             icon: "warning",
                             buttons: false,
                             dangerMode: true,
                         })
                         return;
                     }
                     swal({
                         title: "Se ha registrado exitosamente!",
                         icon: "success",
                     });
                     $('#nohay'+publicity).remove();
                     var machine =JSON.parse(response);
                     var row = '<h4>'+machine.mac+', '+machine.name+'('+machine.ubication+') <a class="text-danger" data-machine='+machine.id+' onclick="detachMachine('+publicity+',this)"><i class="fa fa-remove" aria-hidden="true"></i> </a></h4>'
                    $('#collapseM'+publicity).children().append(row)
                 }
             })
         }
         function detachMachine(publicity,a){
             var machine= $(a).data('machine');
             swal({
                 title: "¿Seguro desea desenlazar este elemento?",
                 icon: "warning",
                 buttons: ['No','Si'],
                 dangerMode: true,
             })
                 .then((willDelete) => {
                     if (willDelete) {
                         $.ajax({
                             url: 'api/publicity/'+publicity+'/detachMachine',
                             method:'post',
                             headers:{ "X-CSRF-TOKEN": window.Laravel},
                             data: {'machine_id': machine},
                             success: function(response){
                                 $(a).parent().remove();
                                 swal({
                                     title: "Se ha desenlazado la maquina exitosamente!",
                                     icon: "success",
                                 });

                             }
                         })


                     } else {

                     }
                 });
         }

    </script>
@endpush
