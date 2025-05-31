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
                        <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#usernav"
                        aria-expanded="false" aria-controls="usernav">
                        <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i> Users
                    </a>
                    <div id="usernav" class="collapse {{ Route::is('v1.user.client.index') ? 'show' : '' }} " data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link has-arrow  {{ Route::is('v1.user.client.index') ? 'active' : '' }} " href="{{ route('v1.user.client.index') }}">
                                    Clients
                                </a>
                            </li>
                        </ul>
                    </div>
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
