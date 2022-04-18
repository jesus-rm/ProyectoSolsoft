@extends('layouts.dashboard')

@section('title','Estados')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="modalEstados" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalEstadosTitle" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEstadosTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-none" role="alert" id="alertEstados"></div>
                    <form id="formularioModal" action="" method="post" enctype="multipart/form-data" class="px-3" role="form" autocomplete="off">
                        @csrf
                        <input type="hidden" name="estadoID" id="estadoID" value="">
                        <div class="mb-3">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado">
                        </div>
                        <div class="mb-3">
                            <label for="claveInegi">Clave (INEGI)</label>
                            <input type="text" class="form-control" name="claveInegi" id="claveInegi">
                        </div>
                        <div class="mb-3">
                            <label for="codigoIso">Código (ISO)</label>
                            <input type="text" class="form-control" name="codigoIso" id="codigoIso">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crearEstadoBtn">Guardar</button>
                    <button type="button" class="btn btn-primary" id="editarEstadoBtn">Guardar cambios</button>
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
                                <h3>Estados de la República Mexicana</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="estadosList" class="table table-hover table-bordered yajra-datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="ebz-table" scope="col" width="10%">Id</th>
                                                <th class="ebz-table" scope="col" width="28%">Estado</th>
                                                <th class="ebz-table" scope="col" width="24%">Clave INEGI</th>
                                                <th class="ebz-table" scope="col" width="24%">Código ISO</th>
                                                <th class="ebz-table" scope="col" width="14%">Acción</th>
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
            var table = $('#estadosList').DataTable( {
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
                    "url": "{{ route('dashboard.estados') }}",
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
                        "data": "nombreEstado",
                        "name": "nombreEstado",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "claveEstado",
                        "name": "claveEstado",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'codigoEstado',
                        "name": "codigoEstado",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": 'action',
                        "name": "action",
                        "searchable": false,
                        "orderable": false
                    }
                ],
                lengthMenu: [ [6, 12, 18, 24, -1], [6, 12, 18, 24, "Todos"] ],
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
                            text: '<i class="fas fa-plus"></i> Añadir Estado',
                            action: function ( e, dt, node, config ) {
                                $('#modalEstadosTitle').text('Registrar Estado');
                                $('#formularioModal')[0].reset();
                                $('#alertEstados').addClass('d-none');
                                $('#editarEstadoBtn').addClass('d-none');
                                $('#crearEstadoBtn').removeClass('d-none');
                                $('#modalEstados').modal('show');
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
            
            //CREAR ESTADO
            $(document).on('click', '#crearEstadoBtn', function(event) {
                event.preventDefault();
                var dataStr = $('#formularioModal').serialize(); // carga todos los campos para enviarlos
                // AJAX
                $.ajax({
                    method: "POST",
                    url: "{{ route('estados.store') }}",
                    data: dataStr,
                    dataType: "json",
                    success: function(data) {
                        if(data.errors){
                            $('#alertEstados').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + data.errors[0]);
                            $('#alertEstados').removeClass('d-none');
                        }else{
                            $('#modalEstados').modal('hide');
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
                                title: 'Estado guardada',
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

            //VER ESTADO EN MODAL
            $(document).on('click','#showEstadoBtn', function() {
                var estadoID = $(this).data('id'); //Obtener el id del boton al ser presionado
                $.ajax({
                    method: "POST",
                    url: "{{ route('estados.show') }}",
                    data: {_token: "{{ csrf_token() }}",id: estadoID},
                    dataType: "json",
                    success: function(data) {
                        $('#formularioModal')[0].reset();
                        $('#estadoID').val(data.details.id);
                        $('#estado').val(data.details.nombreEstado);
                        $('#claveInegi').val(data.details.claveEstado);
                        $('#codigoIso').val(data.details.codigoEstado);
                        $('#modalEstadosTitle').text('Editar Estado');
                        $('#alertEstados').addClass('d-none');
                        $('#crearEstadoBtn').addClass('d-none');
                        $('#editarEstadoBtn').removeClass('d-none');
                        $('#modalEstados').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            //EDITAR Y ACTUALIZAR ESTADOS
            $(document).on('click', '#editarEstadoBtn', function() {
                event.preventDefault();
                var dataStr = $('#formularioModal').serialize(); // carga todos los campos para enviarlos
                var estadoID = $("#estadoID").val();
                // AJAX
                $.ajax({
                    method: "POST",
                    url: "{{ url('estados/actualizar') }}"+'/'+estadoID,
                    data: dataStr,
                    dataType: "json",
                    success: function(data) {
                        if(data.errors){
                            $('#alertEstados').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + data.errors[0]);
                            $('#alertEstados').removeClass('d-none');
                        }else{
                            $('#modalEstados').modal('hide');
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

            //ELIMINAR ESTADOS
            $(document).on('click','#deleteEstadoBtn', function() {
                var estadoID = $(this).data('id'); //Obtener el id del boton al ser presionado
                var url = "{{ url('estados/eliminar') }}"+'/'+estadoID;

                Swal.fire({
                    title: 'Eliminar Estado',
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
                            data: {_token: "{{ csrf_token() }}",id: estadoID},
                            dataType: "json",
                            success: function(data) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El Estado ha sido eliminado',
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