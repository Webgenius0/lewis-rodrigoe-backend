<div class="app-menu">
    <!-- Sidebar -->

    <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar>
            <!-- Brand logo -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/backend/images/brand/logo/logo-2.svg') }}"
                    alt="dash ui - bootstrap 5 admin dashboard template">
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">

                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i data-feather="layout" class="nav-icon me-2 icon-xxs"></i>Dashboard
                    </a>
                </li>
                {{-- users --}}
                <li class="nav-item">
                    <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#usernav"
                        aria-expanded="false" aria-controls="usernav">
                        <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i> Users
                    </a>
                    <div id="usernav" class="collapse {{ Route::is('v1.user.*') ? 'show' : '' }} "
                        data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link has-arrow  {{ Route::is('v1.user.client.index') ? 'active' : '' }} "
                                    href="{{ route('v1.user.client.index') }}">
                                    Clients
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link has-arrow  {{ Route::is('v1.user.engineer.index') ? 'active' : '' }} "
                                    href="{{ route('v1.user.engineer.index') }}">
                                    Engineer
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- location --}}
                <li class="nav-item">
                    <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#location"
                        aria-expanded="false" aria-controls="location">
                        <svg viewBox="-4 0 32 32" width="20px" style="padding-right: 5px;" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>location</title>
                                <desc>Created with Sketch Beta.</desc>
                                <defs> </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    sketch:type="MSPage">
                                    <g id="Icon-Set" sketch:type="MSLayerGroup"
                                        transform="translate(-104.000000, -411.000000)" fill="{{ Route::is('v1.location.*') ? '#624bff' : '#a5acb6' }}">
                                        <path
                                            d="M116,426 C114.343,426 113,424.657 113,423 C113,421.343 114.343,420 116,420 C117.657,420 119,421.343 119,423 C119,424.657 117.657,426 116,426 L116,426 Z M116,418 C113.239,418 111,420.238 111,423 C111,425.762 113.239,428 116,428 C118.761,428 121,425.762 121,423 C121,420.238 118.761,418 116,418 L116,418 Z M116,440 C114.337,440.009 106,427.181 106,423 C106,417.478 110.477,413 116,413 C121.523,413 126,417.478 126,423 C126,427.125 117.637,440.009 116,440 L116,440 Z M116,411 C109.373,411 104,416.373 104,423 C104,428.018 114.005,443.011 116,443 C117.964,443.011 128,427.95 128,423 C128,416.373 122.627,411 116,411 L116,411 Z"
                                            id="location" sketch:type="MSShapeGroup"> </path>
                                    </g>
                                </g>
                            </g>
                        </svg> Location
                    </a>
                    <div id="location" class="collapse {{ Route::is('location.*') ? 'show' : '' }} "
                        data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link has-arrow  {{ Route::is('location.country.index') ? 'active' : '' }} "
                                    href="{{ route('location.country.index') }}">
                                    Country
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link has-arrow  {{ Route::is('location.state.index') ? 'active' : '' }} "
                                    href="{{ route('location.state.index') }}">
                                    State
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ Route::is('v1.property.index') ? 'active' : '' }}"
                        href="{{ route('v1.property.index') }}">
                        <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>Properties
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('v1.setting.mail.show') ? 'active' : '' }}"
                        href="{{ route('v1.setting.mail.show') }}">
                        <i data-feather="mail" class="nav-icon me-2 icon-xxs"></i> Email Setting
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>
