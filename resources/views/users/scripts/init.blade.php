<script src="{{ asset('js/jquery.blockUI.js') }}"></script>
<script>
    $(document).ready(function () {
        dataTableUsers = tableUsers.DataTable({
            order: [[0, "desc"]],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                url: '{{asset ('/js/Spanish.json')}}',
            },
            bAutoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('users.datatable') !!}',
                type: "GET",
                beforeSend: function () {
                    $("#table-users_wrapper").block({
                        message: '<h1>Procesando...</h1>',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                },
                complete: function () {
                    $("#table-users_wrapper").unblock();
                }
            },
            rowId: 'id',
            columns: [
                {data: 'cedula'},
                {data: 'first_name'},
                {data: 'last_name'},
                {data: 'email'},
                {
                    data: 'id',
                    render: function (data) {
                        return '<div class="btn-group">' +
                            `<a href="#" title="Editar" class="btn btn-info btn-icon btn-circle btn-sm btn-edit"><i class="fa fa-edit"></i></a>` +
                            '<a href="#" title="Eliminar" class="btn btn-danger btn-icon btn-circle btn-sm btn-delete"><i class="fa fa-remove"></i></a>'
                    },
                    targets: -1,
                    orderable: false,
                    className: 'text-center with-btn-group'
                }
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.type = "text";
                    input.style.width = "100%";
                    input.className = "form-control form-control-sm";
                    $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });
            }
        });
    });
</script>