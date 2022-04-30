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
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-dashboard text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'dashboard') active @endif" href="{{route('dashboard')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-dashboard text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'import') active @endif" href="{{route('import')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-csv text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Import CSV</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'servers') active @endif" href="{{route('servers')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-server text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Servers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'sites') active @endif" href="{{route('sites')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-globe-americas text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sites</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(strpos($route, 'events') !== false) active @endif" href="{{route('events')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-calendar-alt text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(strpos($route, 'patches') !== false) active @endif" href="{{route('patches')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-calendar text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Patch Scheduler</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(strpos($route, 'capsule_servers') !== false) active @endif" href="{{route('capsule_servers')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-capsules text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Capsule Servers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(strpos($route, 'site_code_subnets') !== false) active @endif" href="{{route('site_code_subnets')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-ethernet text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Site Codes Subnets</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#cveData" class="nav-link @if(strpos($route, 'cve') !== false) active @endif" aria-controls="cveData" role="button">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-list text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">CVE Data</span>
                </a>
                <div class="collapse @if(strpos($route, 'cve') !== false) show @endif " id="cveData">
                    <ul class="nav ms-4">
                        <li class="nav-item @if($route == 'cve.rpm') active @endif">
                            <a class="nav-link @if($route == 'cve.rpm') active @endif" href="{{route('cve.rpm')}}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal"> RPM </span>
                            </a>
                        </li>
                        <li class="nav-item @if($route == 'cve.patch_installed_dates') active @endif">
                            <a class="nav-link @if($route == 'cve.patch_installed_dates') active @endif" href="{{route('cve.patch_installed_dates')}}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Patch Installed Dates </span>
                            </a>
                        </li>
                        <li class="nav-item @if($route == 'cve') active @endif">
                            <a class="nav-link @if($route == 'cve') active @endif" href="{{route('cve')}}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> CVE </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(strpos($route, 'cbd') !== false) active @endif" href="{{route('cbd')}}">
                    <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-list text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">CBD</span>
                </a>
            </li>
        </ul>
    </div>
</aside>