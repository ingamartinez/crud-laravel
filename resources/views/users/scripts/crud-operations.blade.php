<script>
    let form = $("#form");
    form.on('submit', async evt => {
        evt.preventDefault();
        let form = $(evt.currentTarget);
        let data = $(evt.currentTarget).serializeObject();
        let accion = $("#form button[type='submit']").attr('data-action');
        switch (accion) {
            case "create":
                try {
                    await addUser(form, data)
                } catch (e) {
                    dibujarErrores(e)
                }
                break;
            case "edit":
                try {
                    await updateUser(form, data)
                } catch (e) {
                    dibujarErrores(e)
                }
                break;
            default:
                break;
        }
    });
    tableUsers.on('click', '.btn-edit', async evt => {
        let id = $(evt.currentTarget).parents('tr:first').attr('id');
        try {
            fillFields(await getUser(id))
        } catch (e) {
            dibujarErrores(e)
        }
    });
    tableUsers.on('click', '.btn-delete', evt => {
        let id = $(evt.currentTarget).parents('tr:first').attr('id');
        swal("Eliminar Usuario", `¿Esta seguro que quiere eliminar este usuario?`, "warning", {buttons: [true, "Ok"]})
            .then((value) => {
                if (value) {
                    deleteUser(id).catch((e) => dibujarErrores(e));
                }
            });
    });
</script>

<script>
    // Formularios
    function addUser(form, data) {
        return new Promise(async(resolve, reject) => {
            try {
                const response = await axios.post('/users', data);
                await swal("¡Bien!", response.data.message, "success", {button: "Ok",});
                dataTableUsers.ajax.reload(null, false);
                limpiarForm();
                $("#modal-user").modal('toggle');
                resolve();
            }catch (e) {
                reject(e.response.data);
            }
        });
    }
    function updateUser(form, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.put('/users/' + data.id_user, data);
                await swal("¡Bien!", response.data.message, "success", {button: "Ok",});
                dataTableUsers.ajax.reload(null, false);
                limpiarForm();
                $("#modal-user").modal('toggle');
                resolve();
            }catch (e) {
                reject(e.response.data);
            }
        });
    }
    function deleteUser(id) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.delete('/users/' + id);
                await swal("¡Bien!", response.data.message, "success", {button: "Ok",});
                dataTableUsers.ajax.reload(null, false);
                resolve();
            }catch (e) {
                console.log(e.response);
                reject(e.response.data);
            }
        });
    }
    function getUser(id) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.get('/users/' + id);
                $("#form button[type='submit']").html("Editar").attr("data-action", "edit");
                $("#modal-user").modal('toggle');
                resolve(response.data.data);
            }catch (e) {
                reject(e.response.data);
            }
        });
    }

    // Helpers
    function limpiarForm() {
        form.trigger("reset");
        $("#form button[type='submit']").html("Guardar").attr("data-action", "create");
    }
    function fillFields(data) {
        $("#id_user").val(data.id);
        $("#nombres").val(data.first_name);
        $("#apellidos").val(data.last_name);
        $("#cedula").val(data.cedula);
        $("#email").val(data.email);
    }
    $('#modal-user').on('hidden.bs.modal', function () {
        $('input').removeClass('is-invalid');
        $("#id_user").val('');
        limpiarForm();
    })
</script>