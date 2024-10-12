<div class="modal fade" id="addModal">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="progress" id="progress_add"></div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Agregar una publicidad</h4>
			</div>
			<div class="modal-body">
                <form action="" id="addForm" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="code">Nombre:</label>
                        <input class="form-control" name="name" type="text" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <input class="form-control" type="text" name="description" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Video:</label>
                        <input class="" type="file" name="vid" placeholder="" required>
                        <span>Archivos soportados, .mp4 .ogg .webm</span>

                    </div>
                    <div class="form-group">
                        <label for="description">logo:</label>
                        <input class="" type="file" name="logo" placeholder="" required>
                        <span>solo se permiten imagenes</span>

                    </div>
                    <div class="form-group">
                        <label for="description">Compañia:</label>
                        <select name="company_id" class="form-control" required>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}, {{$company->direction}}</option>
                            @endforeach
                        </select>
                        @if(!count($companies))  <h5 class="text-red">No hay compañias <a class="text-aqua" href="{{route('company.view')}}">click aqui</a> para registrar</h5>@endif
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-primary" id="addPsubmit" value="Guardar" onclick="addP();">
                    </div>
                </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->