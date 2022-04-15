<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('libs/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/feather-icons/feather.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="loading" data-layout-color="dark"  data-layout-mode="default" data-layout-size="fluid" data-topbar-color="dark" data-leftbar-position="fixed" data-leftbar-color="dark" data-leftbar-size='default' data-sidebar-user='true'>
    <div id="wrapper">
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-end mb-0">
                
                <li class="d-none d-lg-block">
                    <form class="app-search">
                        @csrf
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar..." id="top-search">
                                <button class="btn input-group-text" type="submit">
                                    <i class="fe-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>

                <li class="dropdown d-inline-block d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-search noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                        <form class="p-3">
                            <input type="text" class="form-control" placeholder="Buscar ..." aria-label="Recipient's username">
                        </form>
                    </div>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('img/Avatars/user-1.jpg') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ Auth::user()->nombre }}
                            {{ Auth::user()->apellidoPaterno }}
                            {{ Auth::user()->apellidoMaterno }}
                            <i class="mdi mdi-chevron-down"></i> 
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">¡Bienvenid@!</h6>
                        </div>
                        <a href="#" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>Mi Perfil</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fe-log-out"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>

            <div class="logo-box">
                <a href="{{ route('dashboard.inicio') }}" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('img/Logo/logo-sm.svg') }}" alt="" height="29">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('img/Logo/logo-light.svg') }}" alt="" height="23">
                    </span>
                </a>
                <a href="{{ route('dashboard.inicio') }}" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('img/Logo/logo-sm.svg') }}" alt="" height="29">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('img/Logo/logo-dark.svg') }}" alt="" height="23">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>
                <li>
                    <h4 class="page-title-main">Dashboard</h4>
                </li>
            </ul>

            <div class="clearfix"></div>
        </div>

        <div class="left-side-menu">
            <div class="h-100" data-simplebar>

                <div class="user-box text-center">
                    <img src="{{ asset('img/Avatars/user-1.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                    <p class="text-muted left-user-info">
                        {{ Auth::user()->nombre }}
                        {{ Auth::user()->apellidoPaterno }}
                        {{ Auth::user()->apellidoMaterno }}</p>
                </div>
                @include('dashboard.menuLateral')
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
