<div class="modal fade" id="editModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Editar el producto</h4>
			</div>
			<div class="modal-body">
                <form action="" id="editForm">
                    <input type="hidden" id="productId">
                    <div class="form-group">
                        <label for="code">Nombre:</label>
                        <input class="form-control" name="name" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <input class="form-control" type="text" name="description" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label for="description">Video:</label>
                        <input class="" type="file" name="vid" placeholder="">
                        <span>Archivos soportados, .mp4 .ogg .webm</span>
                    </div>
                    <div class="form-group">
                        <label for="description">logo:</label>
                        <input class="" type="file" name="logo" placeholder="" >
                        <span>solo se permiten imagenes</span>

                    </div>
                    <div class="form-group">
                        <label for="description">Compañia:</label>
                        <select name="company_id" class="form-control" required>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}, {{$company->direction}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-primary" value="Guardar" onclick="editP(this)">
                    </div>
                </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->