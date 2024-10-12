<div class="modal fade" id="addModal">
	<div class="modal-dialog">
		<div class="modal-content">
            <div id="progress_add" class="progress"></div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Agregar un producto</h4>
			</div>
			<div class="modal-body">
                <form action="" id="addForm" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="code">Nombre:</label>
                        <input class="form-control" name="name" type="text" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Precio:</label>
                        <input class="form-control" type="number" name="price" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Velocidad de llenado(ml/Segundo):</label>
                        <input class="form-control" type="number" min="0" step="any" name="vel" placeholder="decimales separados por , Ej: 10,5" required>
                    </div>
                    <div class="form-group">
                        <label for="description">logo:</label>
                        <input class="" type="file" name="logo" placeholder="" required>
                        <span>solo se permiten imagenes</span>
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-primary" value="Guardar" onclick="addP()">
                    </div>
                </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->