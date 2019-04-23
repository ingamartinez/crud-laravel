@extends('layouts.app')

@section('title','Crud Usuarios')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Crud usuarios</h5>
                    <p class="card-category"><button class="btn btn-info" data-toggle="modal" data-target="#modal-user">Agregar</button></p>
                </div>
                <div class="card-body ">
                    <table class="table" id="table-users">
                        <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('modals')
    @include('users.modals.modal-user')
@endsection


@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('scripts')
    <script>
        let dataTableUsers = null;
        let tableUsers = $("#table-users");
    </script>
@endpush

@push('scripts')
    @include('users.scripts.init')
    @include('users.scripts.crud-operations')
@endpush