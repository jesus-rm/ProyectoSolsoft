@extends('layouts.dashboard')

@section('title','Municipios')

@section('content')

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