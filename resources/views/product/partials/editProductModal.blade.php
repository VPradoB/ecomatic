<div class="modal fade" id="editModal">
	<div class="modal-dialog">
		<div class="modal-content">
            <div id="progress_edit" class="progress"></div>
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Editar el producto</h4>
			</div>
			<div class="modal-body">
                <form action="" id="editForm" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" id="productId">
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
                        <input class="form-control" type="number" step="any" min="0" name="vel" placeholder="decimales separados por , Ej: 10,5" required>
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-primary" value="Guardar" onclick="editP(this)">
                    </div>
                </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->