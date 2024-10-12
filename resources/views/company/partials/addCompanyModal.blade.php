<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar una compañia</h4>
            </div>
            <div class="modal-body">
                <form action="" id="addForm">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="code">Nombre:</label>
                        <input class="form-control" name="name" type="text" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">direccion:</label>
                        <input class="form-control" type="text" name="direction" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">número de teléfono:</label>
                        <input class="form-control" type="text" name="phone_number" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-primary" value="Guardar" onclick="addP()">
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->