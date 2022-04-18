@extends('layouts.dashboard')

@section('title','Personas')

@section('content')
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