@extends('layouts.dashboard')

@section('title','Municipios')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="modalMunicipios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalMunicipiosTitle" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMunicipiosTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-none" role="alert" id="alertMunicipios"></div>
                    <form id="formularioModal" action="" method="post" enctype="multipart/form-data" class="px-3" role="form" autocomplete="off">
                        @csrf
                        <input type="hidden" name="municipioID" id="municipioID" value="">
                        <div class="mb-3">
                            <label for="claveEstado">Clave Estado</label>
                            <select class="form-select" name="claveEstado" id="claveEstado" required>
                                <option value="" selected id="optionDef">-- Seleccionar --</option>
                                @foreach($estados as $estadosOption)
                                    <option value="{{ $estadosOption->id }}">{{ $estadosOption->nombreEstado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="municipio">Municipio</label>
                            <input type="text" class="form-control" name="municipio" id="municipio">
                        </div>
                        <div class="mb-3">
                            <label for="claveInegi">Clave (INEGI)</label>
                            <input type="text" class="form-control" name="claveInegi" id="claveInegi">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crearMunicipioBtn">Guardar</button>
                    <button type="button" class="btn btn-primary" id="editarMunicipioBtn">Guardar cambios</button>
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
                                <h3>Municipios</h3>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <select class="form-select" name="filtroEstados" id="filtroEstados" required>
                                    <option value="" selected id="optionDef">-- Seleccionar Estado --</option>
                                    @foreach($estados as $estadosOption)
                                        <option value="{{ $estadosOption->nombreEstado }}">{{ $estadosOption->nombreEstado }}</option>
                                    @endforeach
                                </select>
                                <div align="center">
                                    <button class="btn btn-purple btnFiltro btn-export rounded-pill w-md waves-effect waves-light mb-3" type="button" name="btnFiltro" id="btnFiltro" >
                                        <i class="mdi mdi-filter"></i>
                                        Filtrar
                                    </button>
                                    <button class="btn btn-danger btnFiltro btn-export rounded-pill w-md waves-effect waves-light mb-3" type="button" name="btnResetFiltro" id="btnResetFiltro" disabled>
                                        <i class="mdi mdi-filter-remove"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="municipiosList" class="table table-hover table-bordered yajra-datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="ebz-table" scope="col" width="10%">Id</th>
                                                <th class="ebz-table" scope="col" width="28%">Municipio</th>
                                                <th class="ebz-table" scope="col" width="20%">Clave INEGI</th>
                                                <th class="ebz-table" scope="col" width="28%">Estado</th>
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

            fill_datatable();
            
            function fill_datatable(filtroEstados='') {
                var table = $('#municipiosList').DataTable( {
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
                        "url": "{{ route('dashboard.municipios') }}",
                        "data": {
                            filtroEstados: filtroEstados
                        },
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
                            "data": "nombreMunicipio",
                            "name": "nombreMunicipio",
                            "searchable": true,
                            "orderable": true
                        },
                        {
                            "data": "claveMunicipio",
                            "name": "claveMunicipio",
                            "searchable": true,
                            "orderable": true
                        },
                        {
                            "data": 'Estado',
                            "name": "Estado.nombreEstado",
                            "searchable": false,
                            "orderable": true
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
                                text: '<i class="fas fa-plus"></i> Añadir Municipio',
                                action: function ( e, dt, node, config ) {
                                    $('#modalMunicipiosTitle').text('Registrar Municipio');
                                    $('#formularioModal')[0].reset();
                                    $('#alertMunicipios').addClass('d-none');
                                    $('#editarMunicipioBtn').addClass('d-none');
                                    $('#crearMunicipioBtn').removeClass('d-none');
                                    $('#modalMunicipios').modal('show');
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
            }

            $('#btnFiltro').click(function(){
                var filtroEstados = $('#filtroEstados').val();
                if(filtroEstados != '')
                {
                    $('#municipiosList').DataTable().destroy();
                    fill_datatable(filtroEstados);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Filtrado completado'
                    })
                    $('#btnResetFiltro').removeAttr('disabled');
                }
                else
                {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    })

                    Toast.fire({
                        icon: 'info',
                        title: 'Seleccione un Estado'
                    })
                }
            });

            $('#btnResetFiltro').click(function(){
                var filtroEstados = '';
                $('#municipiosList').DataTable().clear().destroy();
                fill_datatable(filtroEstados);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Filtrado removido'
                })
                $('#optionDef').prop("selected", true);
                $('#btnResetFiltro').prop("disabled", true);
            });

            //CREAR MUNICIPIO
            $(document).on('click', '#crearMunicipioBtn', function(event) {
                event.preventDefault();
                var dataStr = $('#formularioModal').serialize(); // carga todos los campos para enviarlos
                if($("#claveEstado").val()==''){
                    $('#alertMunicipios').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + 'Debe seleccionar un Estado de la lista');
                    $('#alertMunicipios').removeClass('d-none');
                }
                else
                {
                    // AJAX
                    $.ajax({
                        method: "POST",
                        url: "{{ route('municipios.store') }}",
                        data: dataStr,
                        dataType: "json",
                        success: function(data) {
                            if(data.errors){
                                $('#alertMunicipios').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + data.errors[0]);
                                $('#alertMunicipios').removeClass('d-none');
                            }else{
                                $('#modalMunicipios').modal('hide');
                                $('#formularioModal')[0].reset();

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                });
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Municipio guardado',
                                });

                                $('#municipiosList').DataTable().clear().destroy();
                                fill_datatable(filtroEstados);
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
                }
                
            });

            //VER MUNICIPIO EN MODAL
            $(document).on('click','#showMunicipioBtn', function() {
                var municipioID = $(this).data('id'); //Obtener el id del boton al ser presionado
                $.ajax({
                    method: "POST",
                    url: "{{ route('municipios.show') }}",
                    data: {_token: "{{ csrf_token() }}",id: municipioID},
                    dataType: "json",
                    success: function(data) {
                        $('#formularioModal')[0].reset();
                        $('#municipioID').val(data.details.id);
                        $('#claveEstado').val(data.details.estado_id);
                        $('#municipio').val(data.details.nombreMunicipio);
                        $('#claveInegi').val(data.details.claveMunicipio);
                        $('#modalMunicipiosTitle').text('Editar Municipio');
                        $('#alertMunicipios').addClass('d-none');
                        $('#crearMunicipioBtn').addClass('d-none');
                        $('#editarMunicipioBtn').removeClass('d-none');
                        $('#modalMunicipios').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            //EDITAR Y ACTUALIZAR ESTADOS
            $(document).on('click', '#editarMunicipioBtn', function() {
                event.preventDefault();
                var dataStr = $('#formularioModal').serialize(); // carga todos los campos para enviarlos
                var estadoID = $("#municipioID").val();
                if($("#claveEstado").val()==''){
                    $('#alertMunicipios').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + 'Debe seleccionar un Estado de la lista');
                    $('#alertMunicipios').removeClass('d-none');
                }
                else
                {
                    // AJAX
                    $.ajax({
                        method: "POST",
                        url: "{{ url('municipios/actualizar') }}"+'/'+municipioID,
                        data: dataStr,
                        dataType: "json",
                        success: function(data) {
                            if(data.errors){
                                $('#alertMunicipios').html('<i class="mdi mdi-block-helper me-2"></i><strong>¡Error!</strong> ' + data.errors[0]);
                                $('#alertMunicipios').removeClass('d-none');
                            }else{
                                $('#modalMunicipios').modal('hide');
                                $('#formularioModal')[0].reset();

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
                                
                                $('#municipiosList').DataTable().clear().destroy();
                                fill_datatable(filtroEstados);
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
                }
            });

            //ELIMINAR ESTADOS
            $(document).on('click','#deleteMunicipioBtn', function() {
                var municipioID = $(this).data('id'); //Obtener el id del boton al ser presionado
                var url = "{{ url('municipios/eliminar') }}"+'/'+municipioID;

                Swal.fire({
                    title: 'Eliminar Municipio',
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
                            data: {_token: "{{ csrf_token() }}",id: municipioID},
                            dataType: "json",
                            success: function(data) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El Municipio ha sido eliminado',
                                    'success'
                                ).then((result) => {
                                    $('#municipiosList').DataTable().clear().destroy();
                                    fill_datatable(filtroEstados);
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