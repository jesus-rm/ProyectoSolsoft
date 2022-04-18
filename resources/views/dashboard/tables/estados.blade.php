@extends('layouts.dashboard')

@section('title','Estados')

@section('content')

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