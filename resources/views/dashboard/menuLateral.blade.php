<div id="sidebar-menu">
    <ul id="side-menu">
        <li class="menu-title">Principal</li>
        <li>
            <a href="{{ route('dashboard.inicio') }}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span> Dashboard </span>
            </a>
        </li>
        <li class="menu-title">Secciones</li>
        <li>
            <a href="{{ route('dashboard.personas') }}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span> Personas </span>
            </a>
        </li>
        <li>
            <a href="{{ route('dashboard.estados') }}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span> Estados </span>
            </a>
        </li>
    </ul>
</div>