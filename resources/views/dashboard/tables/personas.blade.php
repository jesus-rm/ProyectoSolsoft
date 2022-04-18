@extends('layouts.dashboard')

@section('title','Personas')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="modalPersonas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalPersonasTitle" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPersonasTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-none" role="alert" id="alertPersonas"></div>
                    <form id="formularioModal" action="" method="post" enctype="multipart/form-data" class="px-3" role="form" autocomplete="off">
                        @csrf
                        <input type="hidden" name="personaID" id="personaID" value="">
                        <div class="mb-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="apellidoPaterno">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno">
                        </div>
                        <div class="mb-3">
                            <label for="apellidoMaterno">Apellido Materno</label>
                            <input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno">
                        </div>
                        <div class="mb-3">
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento">
                        </div>
                        <div class="mb-3">
                            <label for="rfc">RFC</label>
                            <input type="text" class="form-control" name="rfc" id="rfc">
                        </div>
                        <div class="mb-3">
                            <label for="curp">CURP</label>
                            <input type="text" class="form-control" name="curp" id="curp">
                        </div>
                        <div class="mb-3">
                            <label for="claveInegiE">Clave Estado (INEGI)</label>
                            <input type="text" class="form-control" name="claveInegiE" id="claveInegiE">
                        </div>
                        <div class="mb-3">
                            <label for="claveInegiM">Clave Municipio (INEGI)</label>
                            <input type="text" class="form-control" name="claveInegiM" id="claveInegiM">
                        </div>
                        <div class="mb-3">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono">
                        </div>
                        <div class="mb-3">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" name="celular" id="celular">
                        </div>
                        <div class="mb-3">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" name="correo" id="correo">
                        </div>
                        <div class="mb-3">
                            <label for="edad">Edad</label>
                            <input type="text" class="form-control" name="edad" id="edad">
                        </div>
                        <div class="mb-3" id="camPass">
                            <label for="passw">Contraseña</label>
                            <input type="password" class="form-control" name="passw" id="passw">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crearPersonaBtn">Guardar</button>
                    <button type="button" class="btn btn-primary" id="editarPersonaBtn">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <h3>Personas</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="usersList" class="table table-hover table-bordered yajra-datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="ebz-table" scope="col">Id</th>
                                                <th class="ebz-table" scope="col">Nombre(s)</th>
                                                <th class="ebz-table" scope="col">Apellido Paterno</th>
                                                <th class="ebz-table" scope="col">Apellido Materno</th>
                                                <th class="ebz-table" scope="col">Fecha de Nacimiento</th>
                                                <th class="ebz-table" scope="col">Edad</th>
                                                <th class="ebz-table" scope="col">CURP</th>
                                                <th class="ebz-table" scope="col">RFC</th>
                                                <th class="ebz-table" scope="col">Estado</th>
                                                <th class="ebz-table" scope="col">Municipio</th>
                                                <th class="ebz-table" scope="col">Correo</th>
                                                <th class="ebz-table" scope="col">Teléfono</th>
                                                <th class="ebz-table" scope="col">Celular</th>
                                                <th class="ebz-table" scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- DATA TABLE -->
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#usersList').DataTable( {
                processing: true,
                serverSide: true,
                scrollX: true,
                deferRender: true,
                autoWidth: false,
                stateSave: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json"
                },
                "ajax": {
                    "url": "{{ route('dashboard.personas') }}",
                    "type": "GET"
                },
                "columns": [
                    {
                        "data": "id",
                        "name": "id",
                        "searchable": false,
                        "orderable": true
                    },
                    {
                        "data": "nombre",
                        "name": "nombre",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "apellidoPaterno",
                        "name": "apellidoPaterno",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'apellidoMaterno',
                        "name": "apellidoMaterno",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'fechaNacimiento',
                        "name": "fechaNacimiento",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'edad',
                        "name": "edad",
                        "searchable": false,
                        "orderable": true
                    },
                    {
                        "data": 'curp',
                        "name": "curp",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'rfc',
                        "name": "rfc",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'Estado',
                        "name": "Estado.nombreEstado",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'Municipio',
                        "name": "Municipio.nombreMunicipio",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'email',
                        "name": "email",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'telefono',
                        "name": "telefono",
                        "searchable": true,
                        "orderable": false
                    },
                    {
                        "data": 'celular',
                        "name": "celular",
                        "searchable": true,
                        "orderable": false
                    },
                    {
                        "data": 'action',
                        "name": "action",
                        "searchable": false,
                        "orderable": false
                    }
                ],
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
                dom: '<"row"<"col-12"<"cont-export"B>>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12 margenFormat"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

                buttons: {
                    dom: {
                        button: {
                            tag: 'button',
                            className: ''
                        }
                    },
                    buttons: [
                        {
                            className: "btn btn-purple btn-export rounded-pill w-md waves-effect waves-light mb-3",
                            text: '<i class="fas fa-plus"></i> Añadir persona',
                            action: function ( e, dt, node, config ) {
                                $('#modalPersonasTitle').text('Registrar Persona');
                                $('#formularioModal')[0].reset();
                                $('#alertPersonas').addClass('d-none');
                                $('#editarPersonaBtn').addClass('d-none');
                                $('#crearPersonaBtn').removeClass('d-none');
                                $('#modalPersonas').modal('show');
                            }
                        },
                        {
                            extend: "csv",
                            extend: 'csv',
                            charset: 'utf-8',
                            extension: '.csv',
                            fieldBoundary: '',
                            bom: true,
                            className: "btn btn-success btn-export rounded-pill w-md waves-effect waves-light mb-3",
                            text: '<i class="mdi mdi-file-table"></i> CSV',
                            exportOptions: {
                                "columns": ":visible"
                            }
                        },
                        {
                            extend: "print",
                            className: "btn btn-secondary btn-export rounded-pill w-md waves-effect waves-light mb-3",
                            text: '<i class="mdi mdi-printer"></i> Imprimir',
                            exportOptions: {
                                "columns": ":visible"
                            }
                        },
                        {
                            extend: 'colvis',
                            className: "btn btn-white btn-export rounded-pill w-md waves-effect waves-light mb-3",
                            text: '<i class="mdi mdi-format-columns"></i> Columnas',
                            collectionLayout: 'fixed columns'
                        }
                    ],
                }
            } ).clear().draw();

            //CREAR PERSONA
            $(document).on('click', '#crearPersonaBtn', function(event) {
                event.preventDefault();
                var dataStr = $('#formularioModal').serialize(); // carga todos los campos para enviarlos
                
                // AJAX
                $.ajax({
                    method: "POST",
                    url: "{{ route('personas.store') }}",
                    data: dataStr,
                    dataType: "json",
                    success: function(data) {
                        if(data.errors){
                            $('#alertPersonas').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + data.errors[0]);
                            $('#alertPersonas').removeClass('d-none');
                        }else{
                            $('#modalPersonas').modal('hide');
                            $('#formularioModal')[0].reset();
                            table.ajax.reload(null, false);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: 'success',
                                title: 'Persona guardado',
                            });

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'Ha ocurrido un error inesperado. Inténtalo más tarde',
                        });
                    }
                });
            });

            //VER Persona EN MODAL
            $(document).on('click','#showUserBtn', function() {
                var personaID = $(this).data('id'); //Obtener el id del boton al ser presionado
                $.ajax({
                    method: "POST",
                    url: "{{ route('personas.show') }}",
                    data: {_token: "{{ csrf_token() }}",id: personaID},
                    dataType: "json",
                    success: function(data) {
                        $('#formularioModal')[0].reset();
                        $('#personaID').val(data.details.id);
                        $('#nombre').val(data.details.nombre);
                        $('#apellidoPaterno').val(data.details.apellidoPaterno);
                        $('#apellidoMaterno').val(data.details.apellidoMaterno);
                        $('#fechaNacimiento').val(data.details.fechaNacimiento);
                        $('#rfc').val(data.details.rfc);
                        $('#curp').val(data.details.curp);
                        $('#claveInegiE').val(data.details.estado_id);
                        $('#claveInegiM').val(data.details.municipio_id);
                        $('#telefono').val(data.details.telefono);
                        $('#celular').val(data.details.celular);
                        $('#correo').val(data.details.email);
                        $('#edad').val(data.details.edad);
                        $('#passw').val(data.details.password);
                        $('#camPass').addClass('d-none');
                        $('#modalPersonasTitle').text('Editar Persona');
                        $('#alertPersonas').addClass('d-none');
                        $('#crearPersonaBtn').addClass('d-none');
                        $('#editarPersonaBtn').removeClass('d-none');
                        $('#modalPersonas').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            //EDITAR Y ACTUALIZAR Persona
            $(document).on('click', '#editarPersonaBtn', function() {
                event.preventDefault();
                var dataStr = $('#formularioModal').serialize(); // carga todos los campos para enviarlos
                var personaID = $("#personaID").val();
                // AJAX
                $.ajax({
                    method: "POST",
                    url: "{{ url('personas/actualizar') }}"+'/'+personaID,
                    data: dataStr,
                    dataType: "json",
                    success: function(data) {
                        if(data.errors){
                            $('#alertPersonas').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + data.errors[0]);
                            $('#alertPersonas').removeClass('d-none');
                        }else{
                            $('#modalPersonas').modal('hide');
                            $('#formularioModal')[0].reset();
                            table.ajax.reload(null, false);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: 'success',
                                title: 'Cambios guardados con éxito',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(error);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'Ha ocurrido un error inesperado. Inténtalo más tarde',
                        });
                    }
                });
            });

            //ELIMINAR Persona
            $(document).on('click','#deleteUserBtn', function() {
                var personaID = $(this).data('id'); //Obtener el id del boton al ser presionado
                var url = "{{ url('personas/eliminar') }}"+'/'+personaID;

                Swal.fire({
                    title: 'Eliminar Persona',
                    text: "¿Está seguro? No se podrá revertir esta acción",
                    icon: 'warning',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    returnFocus: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //AJAX
                        $.ajax({
                            method: "POST",
                            url: url,
                            data: {_token: "{{ csrf_token() }}",id: personaID},
                            dataType: "json",
                            success: function(data) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'La Persona ha sido eliminada',
                                    'success'
                                ).then((result) => {
                                    table.ajax.reload(null, false);
                                })
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                Swal.fire(
                                    '¡Error!',
                                    'Ha ocurrido un error inesperado. Inténtalo más tarde',
                                    'error'
                                )
                            }
                        });
                    }
                })
            });
        } );
    </script>

@stop

@section('css')
    <link href="{{ asset('libs/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/datatables/css/buttons/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/tables.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="{{ asset('libs/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/buttons/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/js/buttons/buttons.colVis.min.js') }}"></script>
@stop