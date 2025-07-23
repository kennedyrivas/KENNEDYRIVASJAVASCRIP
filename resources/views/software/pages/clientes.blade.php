@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Clientes')
@section('content_header_title', 'Clientes')
@section('content_header_subtitle', 'Clientes')

{{-- plugins --}}
{{-- Datatable --}}
@section('plugins.Datatables', true)
{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="crear()">
            Agregar Cliente
        </button>
    </div>
    <div class="container mt-4">
        <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
            style="width: 100%">
            <thead class="bg-info">
                <tr>
                    <th data-priority="1">Nombre</th>
                    <th>Apellido</th>
                    <th data-priority="2">Cedula</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="empleado" aria-hidden="true">
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
                                <label for="nombre">Nombre *</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="255" class="form-control"
                                    id="nombre" placeholder="Jose">
                                <small id="nombreHelp" class="form-text text-muted">Nombre del Cliente
                                    (Obligatorio).</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido">Apellido *</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="255" class="form-control"
                                    id="apellido" placeholder="Gomez">
                                <small id="apellidoHelp" class="form-text text-muted">Apellido del Cliente
                                    (Obligatorio).</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cedula">Cedula/Rif *</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="20" class="form-control"
                                    id="cedula" placeholder="V-XXXXXXXXX">
                                <small id="apellidoHelp" class="form-text text-muted">Cedula/Rif del Cliente
                                    (Obligatorio).</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefono">Telefono *</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="20" class="form-control"
                                    id="telefono" placeholder="(04XX) XXXXXXXX">
                                <small id="apellidoHelp" class="form-text text-muted">Telefono del Cliente
                                    (Obligatorio).</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electronico *</label>
                            <input type="email" autocomplete="false" required minlength="1" maxlength="255" class="form-control"
                                id="email" placeholder="example@example.com">
                            <small id="apellidoHelp" class="form-text text-muted">Correo Electronico del Cliente
                                (Obligatorio).</small>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Direccion *</label>
                            <input type="text" autocomplete="false" required minlength="1" maxlength="255" class="form-control"
                                id="direccion" placeholder="1234 Main St">
                            <small id="apellidoHelp" class="form-text text-muted">Direccion del Cliente
                                (Obligatorio).</small>
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
    <script src="{{ asset('Modujs/clientes.js') }}"></script>
@endpush
