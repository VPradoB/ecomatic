@extends('layouts.app')
@section('class-skin') skin-purple @endsection
@section('sidebar-color')#605ca8 @endsection
@section('htmlheader_title')
    Product
@endsection

@section('contentheader_title')
    Productos
@endsection
@section('here')
    Productos
@endsection

@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="box box-solid">
                <div class="box-header with-border">
                    <div>
                        <h3 class="box-title"><span><i class="fa fa-setting"></i></span>Manejo de productos</h3>
                        <a class="btn btn-default" data-toggle="modal" data-target="#addModal" ><span><i style="color: dodgerblue" class="fa fa-plus"></i></span> Añadir</a>
                    </div>
                </div>
                <div class="box-body">
                    <div >
                        <table id="productTable" class="display table table stripped table bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio (Litro)</th>
                                    <th>Vel. llenado(ml/segundos)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="productTBody">
                            @if(count($products))
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->vel}}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#imgModal" onclick="changeImage(this)" data-logo="{{$product->logo}}"><span><i style="color: #00a157;" class="fa fa-2x fa-camera"></i></span></a>
                                            <a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="{{$product->id}}"><span><i class="fa fa-2x fa-edit"></i></span></a>
                                            <a href="#" onclick="deleteP(this)" data-product="{{$product->id}}"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>
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
    @include('product.partials.addProductModal')
    @include('product.partials.editProductModal')
    @include('product.partials.imgModal')

@endsection
@push('extra-scripts')
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js')}}"></script>

    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.24.min.js"></script>

    <script>

        AWS.config.update({
            accessKeyId : '',
            secretAccessKey : ''
        });

        function UploadS3(response)
        {
            let resource = $('#addModal').find('input[name=logo]')[0];
            var bucket = new AWS.S3({params: {Bucket: 'ecomatic'}});
            var upFile = resource.files[0];
            if (upFile)
            {
                var uploadParams = {Key: 'product/'+    upFile.name, ContentType: upFile.type, Body: upFile};
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
                        $('#addForm')[0].reset();

                        $('#addModal').modal('toggle');
                        swal({
                            title: "Creación exitosa!",
                            icon: "success",
                        });
                        var product = JSON.parse(response);
                        var options = '<a href="#" data-toggle="modal" data-target="#imgModal" onclick="changeImage(this)" data-logo="'+product.logo+'"><span><i style="color: #00a157;" class="fa fa-2x fa-camera"></i></span></a>'+
                            '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>' +
                            '          <a href="#" onclick="deleteP(this)" data-product="'+product.id+'"><span><i style="color: darkgray"  class="fa fa-2x fa-trash"></i></span></a>';
                        var row = '                               <tr>' +
                            '                                        <td>'+product.name+'</td>' +
                            '                                        <td>'+ product.price+'</td>' +
                            '                                        <td>'+ product.vel+'</td>' +
                            '                                        <td>' +
                            '<a href="#" data-toggle="modal" data-target="#imgModal" onclick="changeImage(this)" data-logo="'+product.logo+'"><span><i style="color: #00a157;" class="fa fa-2x fa-camera"></i></span></a>'+
                            '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>' +
                            '                                            <a href="#" onclick="deleteP(this)" data-product="'+ product.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>' +
                            '                                        </td>' +
                            '                                    </tr>'
                        $('#productTBody').append(row);
                        $('#productTable').DataTable().row.add([product.name,product.price,product.vel,options]);
                        $('#productTable').DataTable().draw()
                    }
                });
            }
        }

        function changeImage(e)
        {
            console.log($(e).data('logo'));
            document.getElementById('imagen').src = 'storage/img/'+$(e).data('logo');
        };
        $(document).ready(function () {
            $('#productTable').DataTable({

            });
        });
        function deleteP(e) {
            swal({
                title: "¿Seguro desea eliminar este elemento?",
                icon: "warning",
                buttons: ['No', 'Si'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'api/product/' + $(e).data('product'),
                            method: 'DELETE',
                            success: function (response) {
                                if (response = true) {
                                    swal({
                                        title: "Se ha eliminado con éxito",
                                        icon: "success",
                                    });
                                    $('tr.selected').removeClass('selected');
                                    let row = $(e).parent().parent();
                                    row.addClass('selected');
                                    row.remove();

                                    $('#productTable').DataTable().rows('.selected').remove().draw();
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
        function progress(e){
            if(e.lengthComputable){
                var max = e.total;
                var current = e.loaded;

                var Percentage = (current * 100)/max;
                console.log(Percentage);


                if(Percentage >= 100)
                {
                    // process completed
                }
            }
        }
        function addP(){
            var form = new FormData(document.getElementById('addForm'));

            $("#addForm input[name=name]").parent().removeClass('has-error');
            $("#addForm input[name=price]").parent().removeClass('has-error');
            $("#addForm input[name=logo]").parent().removeClass('has-error');
            $("#addForm input[name=vel]").parent().removeClass('has-error');
            $.ajax({
                xhr: function()
                {
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;

                            document.getElementById('progress_add').style = 'width :'+percentComplete*100+'%';
                            //Do something with upload progress
                            console.log(percentComplete);
                        }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            document.getElementById('progress_add').style = 'width :'+percentComplete*100+'%';

                            //Do something with download progress
                            console.log(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                url: 'api/product',
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": form['_token']
                },
                contentType: false,
                processData: false,
                data: form,
                dataType: "text",
                success: function (response) {
                    document.getElementById('progress_add').style = 'width :'+0+'%';
                    UploadS3(response);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    document.getElementById('progress_add').style = 'width :'+0+'%';

                    response = JSON.parse(XMLHttpRequest.responseText);
                    console.log(response);
                    var text ='';
                    if(typeof(response.name) != "undefined"){
                        $('#addModal').find('input[name=name]').parent().addClass('has-error');
                        text += response.name[0]+'\n'
                    }
                    if(typeof(response.price) != "undefined"){

                        $('#addModal').find('input[name=price]').parent().addClass('has-error');
                        text += response.price[0]+'\n'
                    }
                    if(typeof(response.logo) != "undefined"){

                        $('#addModal').find('input[name=logo]').parent().addClass('has-error');
                        text += response.logo[0]+'\n'
                    }
                    if(typeof(response.vel) != "undefined"){

                        $('#addModal').find('input[name=vel]').parent().addClass('has-error');
                        text += response.vel[0]+'\n'
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
                var configID = $(e).data('product');
                $('#productId').val(configID);
                $('tr.selected').removeClass('selected');
                $(e).parent().parent().addClass('selected');
                console.log(configID);
                $.ajax({
                    url: 'api/product/'+configID,
                    type: 'get',
                    headers: {
                        "X-CSRF-TOKEN": window.Laravel,
                    },
                    dataType: "text",
                    success: function (response) {
                        let config = JSON.parse(response);
                        $("#editForm input[name=name]").val(config.name);
                        $("#editForm input[name=price]").val(config.price   );
                        $("#editForm input[name=vel]").val(config.vel);
                    }
                })
            }
            //si no, hago el envio de ajax ( este caso ocurre cuando hago submit)
            else{
                $("#editForm input[name=name]").parent().removeClass('has-error');
                $("#editForm input[name=price]").parent().removeClass('has-error');
                $("#editForm input[name=vel]").parent().removeClass('has-error');
                var form = new FormData(document.getElementById('editForm'));

                $.ajax({
                    xhr: function()
                    {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;

                                document.getElementById('progress_edit').style = 'width :'+percentComplete+'%';
                                //Do something with upload progress
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
                    url: 'api/product/'+$('#productId').val(),
                    method: 'post',
                    contentType: false,
                    processData: false,
                    headers: {
                        "X-CSRF-TOKEN": form['_token']
                    },
                    data: form,
                    dataType: "text",
                    success: function (response) {
                        $('#editModal').modal('toggle');
                        let product = JSON.parse(response);
                        var options = '<a href="#" data-toggle="modal" data-target="#imgModal" onclick="changeImage(this)" data-logo="'+product.logo+'"><span><i style="color: #00a157;" class="fa fa-2x fa-camera"></i></span></a>'+
                        '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>'+
                            '          <a href="#" onclick="deleteP(this)" data-product="'+product.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>'
                        $('#productTable').DataTable().rows('.selected').remove().draw();
                        var row = '                               <tr>' +
                            '                                        <td>'+product.name+'</td>' +
                            '                                        <td>'+ product.price+'</td>' +
                            '                                        <td>'+ product.vel+'</td>' +
                            '                                        <td>' +
                            '<a href="#" data-toggle="modal" data-target="#imgModal" onclick="changeImage(this)" data-logo="'+product.logo+'"><span><i style="color: #00a157;" class="fa fa-2x fa-camera"></i></span></a>'+
                            '<a href="#" class="edit" data-toggle="modal" data-target="#editModal" onclick="editP(this)" data-product="'+product.id+'"><span><i class="fa fa-2x fa-edit"></i></span></a>' +
                            '                                            <a href="#" onclick="deleteP(this)" data-product="'+ product.id+'"><span><i style="color: darkgray" class="fa fa-2x fa-trash"></i></span></a>' +
                            '                                        </td>' +
                            '                                    </tr>'
                        $('#productTBody').append(row);
                        $('#productTable').DataTable().row.add([product.name,product.price,product.vel,options]);
                        $('#productTable').DataTable().draw()


                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                        if (XMLHttpRequest.status == 400) {
                            response = JSON.parse(XMLHttpRequest.responseText);
                            console.log(response);
                            var text ='';
                            if(typeof(response.name) != "undefined"){
                                $('#editModal').find('input[name=name]').parent().addClass('has-error');
                                text += response.name[0]+'\n'
                            }
                            if(typeof(response.price) != "undefined"){

                                $('#editModal').find('input[name=price]').parent().addClass('has-error');
                                text += response.price[0]+'\n'
                            }
                            if(typeof(response.vel) != "undefined"){

                                $('#editModal').find('input[name=vel]').parent().addClass('has-error');
                                text += response.vel[0]+'\n'
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

        };

    </script>
@endpush
