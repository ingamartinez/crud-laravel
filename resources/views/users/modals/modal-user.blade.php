<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="modal-user" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form">
                <input type="hidden" name="id_user" id="id_user" value="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cedula-form-agregar">Cedula</label>
                        <input type="number" class="form-control" name="cedula" id="cedula" placeholder="Cedula">
                    </div>
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" name="first_name" id="nombres" placeholder="Nombres">
                    </div>
                    <div class="form-group">
                        <label for="apellidos-form-agregar">Apellidos</label>
                        <input type="text" class="form-control" name="last_name" id="apellidos" placeholder="Apellidos">
                    </div>
                    <div class="form-group">
                        <label for="email-form-agregar">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-action="create">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>