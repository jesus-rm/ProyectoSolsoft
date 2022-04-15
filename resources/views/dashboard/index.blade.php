@extends('layouts.dashboard')

@section('content')

<!-- Scripts -->
<script src="{{ asset('libs/morris-js/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('libs/jvmap/jquery.vmap.js') }}"></script>
<script src="{{ asset('libs/jvmap/jquery.vmap.mex.js') }}"></script>

<!-- Styles -->
<link href="{{ asset('libs/morris-js/morris.css') }}" type="text/css">
<link href="{{ asset('libs/jvmap/jqvmap.css') }}" type="text/css">


<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-4">Total Estados (México)</h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <i class="mdi mdi-map-search mapaIcon"></i>
                    </div>
                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1">{{ $totalEstados }}</h2>
                        <p class="text-muted mb-1 mapaTextIcon">Entidades municipales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-4">Total Municipios/Alcaldías</h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <i class="mdi mdi-map-marker-radius markerIcon"></i>
                    </div>
                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1">{{ $totalMunicipios }}</h2>
                        <p class="text-muted mb-1 markerTextIcon">Municipios y Alcaldías</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-4">Total Personas (Registradas)</h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <i class="mdi mdi-account-key personIcon"></i>
                    </div>
                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1">{{ $totalUsuarios }}</h2>
                        <p class="text-muted mb-1 personTextIcon">Usuarios registrados</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0">Cantidad de Municipios por Entidad</h4>
                <div class="widget-chart text-center">
                    <div id="morris-donut-example" style="height: 385px;" class="morris-chart morris-donut-example" data-replace="data-value"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0">Mapa de la República Mexicana</h4>
                <div id="vmap" style="height: 385px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // creando un gráfico circular de gráfico de anillos
    var $donutData = @json($data);
    var element = "morris-donut-example";
    var colors = [
        '#8c91ee',
        '#f6a1be',
        "#ff62a6",
        "#20dbd3",
        "#1a94af",
        "#08b2ff",
        "#fffa26",
        "#ffc823",
        "#9592eb",
        "#ff8200",
        "#0061bf",
        "#29b600"
    ];
    Morris.Donut({
        element: element,
        backgroundColor: false,
        data: $donutData,
        resize: true,
        colors: colors
    });

    jQuery('#vmap').vectorMap({
        map: 'mex_es',
        backgroundColor: null,
        color: '#ffffff',
        enableZoom: true,
        hoverColor: '#71b6f9',
        selectedColor: null,
        showTooltip: true,
        onRegionClick: function(event, code, region){
            event.preventDefault();
        }
    });
</script>

@endsection
