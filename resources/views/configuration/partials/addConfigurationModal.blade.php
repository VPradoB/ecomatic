<div class="modal fade" id="addModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Agregue una configuración</h4>
			</div>
			<div class="modal-body">
                <form action="" id="addForm">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="code">Codigo:</label>
                        <input class="form-control" name="code" type="text" maxlength="5" placeholder="Codigo de 5 caracteres unico" required>
                    </div>
                    <div class="form-group">
                        <label for="value">Valor:</label>
                        <input class="form-control" type="number" name="value" placeholder="Valor de la configuracion" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input class="form-control" type="text" name="description" maxlength="240" placeholder="Ej. Tiempo de actualizacion de maquinas" required>
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-primary" value="Guardar" onclick="addC()">
                    </div>
                </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->