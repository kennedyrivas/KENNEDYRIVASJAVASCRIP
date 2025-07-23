@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Administradores')
@section('content_header_title', 'Administradores')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
{{-- Datatable --}}
@section('plugins.Datatables', true)
{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="crear()">
            Agregar Administrador
        </button>
    </div>
    <div class="container mt-4">
        <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
            style="width: 100%">
            <thead class="bg-info">
                <tr>
                    <th data-priority="1">Cedula</th>
                    <th data-priority="2">Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Tipo</th>
                    <th>Email</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="administrador" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="min-width: 600px">
            <div class="modal-content">
                <form id="formulario" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" id="bg-titulo">
                        <h5 class="modal-title" id="titulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="255" class="form-control"
                                    id="nombre" placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido">Apellido</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="255" class="form-control"
                                    id="apellido" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefono">Telefono</label>
                                <input type="tel" autocomplete="false" minlength="1" maxlength="20" class="form-control"
                                    id="telefono" placeholder="Telefono">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cedula">Cedula</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="20" class="form-control"
                                    id="cedula" placeholder="cedula">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Rol</label>
                            <select id="tipo" class="form-control" required>
                                <option value="1">SuperAdmin</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" autocomplete="false" required minlength="1" maxlength="255" class="form-control"
                                id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" autocomplete="false" required minlength="8" maxlength="255" class="form-control"
                                id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="submit" class="btn btn-primary"><i class="fas fa-lg fa-save"></i>
                            Guarda</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('css')
    <style>
        .dropdown-menu.show {
            display: inline-table;
        }
    </style>
@endpush

@push('js')
    <script>
        const urlCompleta = window.location.href;
        var table = new DataTable('#datatable', {
            ajax: urlCompleta + '/Lista',
            responsive: true,
            processing: true,
            serverSide: true,
            lengthMenu: [
                [10, 25, 50],
                [10, 25, 50]
            ],
            columns: [{
                    data: 'cedula',
                    name: 'cedula',
                    className: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-center'
                },
                {
                    data: 'apellido',
                    name: 'apellido',
                    className: 'text-center'
                },
                {
                    data: 'telefono',
                    name: 'telefono',
                    className: 'text-center'
                },
                {
                    data: 'tipo',
                    name: 'tipo',
                    className: 'text-center'
                },
                {
                    data: 'email',
                    name: 'email',
                    className: 'text-center'
                },
                {
                    "data": null,
                    "width": "100px",
                    "className": "text-center",
                    "render": function(row, data) {
                        if (row.cedula == '{{ Auth::user()->cedula }}') {
                            return `<span class="badge badge-success">Tu</span>`
                        } else {
                            return `
                        <div class="dropdown dropleft">
                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="fa fa-edit text-warning"></i> Editar</a>
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar</a>
                            </div>
                        </div>`;
                        }
                    },
                    "orderable": false
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [6],
                responsivePriority: 1,
                responsivePriority: 2,

            }],
            language: {
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
        });
    </script>
    <script src="{{ asset('modujs/administradores.js') }}"></script>
@endpush