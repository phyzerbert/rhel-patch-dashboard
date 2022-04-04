@php
    $route = request()->route()->getName();
@endphp
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <img src="{{asset('assets/img/logo-ct-dark.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">{{config('app.name')}}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if($route == 'home') active @endif" href="{{route('home')}}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-dashboard text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'import') active @endif" href="{{route('import')}}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-csv text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Import CSV</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'servers') active @endif" href="{{route('servers')}}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-server text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Servers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'sites') active @endif" href="{{route('sites')}}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-globe-americas text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sites</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(strpos($route, 'events') !== false) active @endif" href="{{route('events')}}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-calendar-alt text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(strpos($route, 'patches') !== false) active @endif" href="{{route('patches')}}">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-calendar text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Patche Scheduler</span>
                </a>
            </li>
        </ul>
    </div>
</aside>