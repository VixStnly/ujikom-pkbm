<!-- Drawer -->
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->
            <a href="index.html" class="sidebar-brand">
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-primary">
                        <img src="{{ asset('frontend/images/illustration/student/128/logo-academia.png') }}" class="img-fluid" alt="logo" />
                    </span>
                </span>
                <span>PKBM</span>
            </a>

            <div class="sidebar-heading">Siswa</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/dashboard') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dashboard</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ Request::is('subjects') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/subjects') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                        <span class="sidebar-menu-text">Pembelajaran</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/profile') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">person</span>
                        <span class="sidebar-menu-text">My Profile</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#pembelajaran_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">history</span>
                        Histori
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="pembelajaran_menu">
                        <li class="sidebar-menu-item {{ Request::is('histori/tugas') ? 'active' : '' }}">
                            <a class="sidebar-menu-button" href="{{ url('/histori/tugas') }}">
                                <span class="sidebar-menu-text">Histori Tugas</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item {{ Request::is('histori/absen') ? 'active' : '' }}">
                            <a class="sidebar-menu-button" href="{{ url('/histori/absen') }}">
                                <span class="sidebar-menu-text">Histori Absen</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
<!-- // END Drawer -->
