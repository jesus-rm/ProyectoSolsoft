@extends('layouts.dashboard')

@section('content')

<div class="col-xl-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mt-0 mb-4">Total Revenue</h4>
            <div class="widget-chart-1">
                <div class="widget-chart-box-1 float-start" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#f05050 " data-bgcolor="#F9B9B9" value="58" data-skin="tron" data-angleoffset="180" data-readonly="true" data-thickness=".15"/>
                </div>
                <div class="widget-detail-1 text-end">
                    <h2 class="fw-normal pt-2 mb-1"> 256 </h2>
                    <p class="text-muted mb-1">Revenue today</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
