var token = $('meta[name="csrf-token"]').attr('content');
var opcion;
const urlCompleta = window.location.href;


$(document).ready(function () {
    $('#cedula').on('input', function () {
        var input = $(this).val().toUpperCase();
        if (input.length === 1 && !/^[JEV]$/.test(input)) {
            input = '';
        }
        input = input.replace(/[^JE-V0-9-]/g, '');
        if (/^[JEV]$/.test(input)) {
            if (input.length === 1) {
                input += '-';
            } else if (/^[JEV]-?\d{0,8}$/.test(input)) {
                input = input.replace(/^([JEV])-?(\d{0,8})$/, '$1-$2');
            }
        }
        $(this).val(input);
    });
});

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
        data: 'nombre',
        name: 'nombre',
        className: 'text-center'
    },
    {
        data: 'apellido',
        name: 'apellido',
        className: 'text-center'
    },
    {
        data: 'cedula',
        name: 'cedula',
        className: 'text-center'
    },
    {
        data: 'email',
        name: 'email',
        className: 'text-center'
    },
    {
        data: 'telefono',
        name: 'telefono',
        className: 'text-center'
    },
    {
        "data": null,
        "width": "100px",
        "className": "text-center",
        "render": function (row) {
            return `
                        <div class="dropdown dropleft">
                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-file text-primary"></i> Ver</a>
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="fa fa-edit text-warning"></i> Editar</a>
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar</a>
                            </div>
                        </div>`;
        },
        "orderable": false
    },
    ],
    columnDefs: [{
        orderable: false,
        targets: [5],
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

// Consulta Registro
consulta = function (id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: urlCompleta + "/" + id,
            method: "GET",
            success: function (Data) {
                resolve(Data);
            },
            error: function (error) {
                reject(error);
            }
        });
    });
};

// Enviar datos
$('#formulario').submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append('nombre', $.trim($('#nombre').val()));
    formData.append('apellido', $.trim($('#apellido').val()));
    formData.append('cedula', $.trim($('#cedula').val()));
    formData.append('telefono', $.trim($('#telefono').val()));
    formData.append('email', $.trim($('#email').val()));
    formData.append('direccion', $.trim($('#direccion').val()));

    $.ajax({
        url: rutaAccion,
        method: 'POST',
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (data) {
            if (data.success) {
                table.ajax.reload(null, false);
                if (accion === 1) {
                    notificacion.fire({
                        icon: "success",
                        title: "Informacion Guardada!!",
                        text: "Registro guardado con exito."
                    });
                } else {
                    notificacion.fire({
                        icon: "success",
                        title: "Informacion Editada!!",
                        text: "Registro Editado con exito."
                    });
                }
            } else {
                notificacion.fire({
                    icon: "error",
                    title: "Registro no cargado.",
                    text: "Recuerda que no pueden haber 2 Clientes con la misma cedula."
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Falla en el sistema",
                text: "El registro no fue agregado al sistema!!",
                icon: "error"
            });
        }
    });

    $('#modalCRUD').modal('hide');
});

// Funciones de Botones
crear = function () {
    rutaAccion = urlCompleta;
    accion = 1;

    // reinicial Formulario
    $("#formulario").trigger("reset");

    // Editar Modal
    $("#titulo").html("Agregar Cliente");
    $("#titulo").attr("class", "modal-title text-white");
    $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

    $("#nombre").attr("readonly", false);
    $("#apellido").attr("readonly", false);
    $("#cedula").attr("readonly", false);
    $("#email").attr("readonly", false);
    $("#telefono").attr("readonly", false);
    $("#direccion").attr("readonly", false);

    $('#submit').show()
    $('#modalCRUD').modal('show');
};

ver = async function (id) {
    try {
        $("#formulario").trigger("reset");
        datos = await consulta(id);
        $("#titulo").html("Ver Cliente -> " + datos.cedula);
        $("#titulo").attr("class", "modal-title text-white");
        $("#bg-titulo").attr("class", "modal-header bg-info");

        // asigancion de valores
        $("#nombre").val(datos.nombre);
        $("#nombre").attr("readonly", true);
        $("#apellido").val(datos.apellido);
        $("#apellido").attr("readonly", true);
        $("#cedula").val(datos.cedula);
        $("#cedula").attr("readonly", true);
        $("#email").val(datos.email);
        $("#email").attr("readonly", true);
        $("#telefono").val(datos.telefono);
        $("#telefono").attr("readonly", true);
        $("#direccion").val(datos.direccion);
        $("#direccion").attr("readonly", true);

        $('#submit').hide()
        $('#modalCRUD').modal('show');
    } catch (error) {
        notificacion.fire({
            icon: "error",
            title: "¡ No Existe !",
            text: "Tu registro no se puede ver."
        });
    }
};

editar = async function (id) {
    rutaAccion = urlCompleta + '/Editar/' + id;
    accion = 2;

    try {
        $("#formulario").trigger("reset");
        datos = await consulta(id);
        $("#titulo").html("Editar Cliente -> " + datos.cedula);
        $("#titulo").attr("class", "modal-title text-white");
        $("#bg-titulo").attr("class", "modal-header bg-warning");

        // asigancion de valores
        $("#nombre").val(datos.nombre);
        $("#nombre").attr("readonly", false);
        $("#apellido").val(datos.apellido);
        $("#apellido").attr("readonly", false);
        $("#cedula").val(datos.cedula);
        $("#cedula").attr("readonly", false);
        $("#email").val(datos.email);
        $("#email").attr("readonly", false);
        $("#telefono").val(datos.telefono);
        $("#telefono").attr("readonly", false);
        $("#direccion").val(datos.direccion);
        $("#direccion").attr("readonly", false);

        $('#submit').show()
        $('#modalCRUD').modal('show');
    } catch (error) {
        notificacion.fire({
            icon: "error",
            title: "¡ No Existe !",
            text: "Tu registro no se puede ver."
        });
    }
};

eliminar = function (id) {
    Swal.fire({
        title: '¿ Estas seguro que desea eliminar el registro #' + id + ' ?',
        text: "¡ No podrás revertir esto !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡ Sí, bórralo !',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlCompleta + '/' + id,
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (data) {
                    if (data.success) {
                        table.row('#' + id).remove().draw();
                        notificacion.fire({
                            icon: "success",
                            title: "¡ Eliminado !",
                            text: "Tu registro ha sido eliminado."
                        });
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "¡ Error !",
                            text: "Tu registro no ha sido eliminado."
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "Error en el sistema",
                        text: "El registro no fue agregado al sistema!!",
                        icon: "error"
                    });
                }
            });
        }
    });
};