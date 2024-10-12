<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar datos de la compañia</h4>
            </div>
            <div class="modal-body">
                <form action="" id="editForm">
                    <input type="hidden" id="productId">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="code">Nombre:</label>
                        <input class="form-control" name="name" type="text" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label for="description">direccion:</label>
                        <input class="form-control" type="text" name="direction" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label for="description">número de teléfono:</label>
                        <input class="form-control" type="text" name="phone_number" placeholder="" >
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-primary" value="Guardar" onclick="editP(this)">
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->