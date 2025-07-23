@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Vendedores')
@section('content_header_title', 'Vendedores')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
{{-- Datatable --}}
@section('plugins.Datatables', true)
{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)
{{-- Select2 --}}
    @section('plugins.Select2', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="crear()">
            Agregar Vendedor
        </button>
    </div>
    <div class="container mt-4">
        <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
            style="width: 100%">
            <thead class="bg-info">
                <tr>
                    <th data-priority="2">Cedula</th>
                    <th data-priority="1">Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Email</th>
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
                                <label for="nombre">Nombre</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="255" class="form-control" id="nombre" placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido">Apellido</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="255" class="form-control" id="apellido" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefono">Telefono</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="20" class="form-control" id="telefono" placeholder="Telefono">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cedula">Cedula</label>
                                <input type="text" autocomplete="false" required minlength="1" maxlength="20" class="form-control" id="cedula" placeholder="Cedula">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" autocomplete="false" required minlength="1" maxlength="255" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" autocomplete="false" required minlength="8" maxlength="255" class="form-control" id="password" placeholder="Password">
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
    <script src="{{ asset('modujs/vendedores.js') }}"></script>
@endpush