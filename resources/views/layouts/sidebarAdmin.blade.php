<!-- Drawer -->
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <a href="index.html" class="sidebar-brand">
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-success">
                        <img src="{{ asset('frontend/images/illustration/student/128/triwala.png') }}" class="img-fluid" alt="logo" />
                    </span>
                </span>
                <span>PKBM</span>
            </a>

            <div class="sidebar-heading">Adminaa</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/dashboard') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dashboard</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="/admin/users">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                        <span class="sidebar-menu-text">Data User</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ Request::is('admin/courses') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/admin/courses') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                        <span class="sidebar-menu-text">Pembelajaran</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ Request::is('admin/kelas') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/admin/kelas') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                        <span class="sidebar-menu-text">Kelas</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ Request::is('admin/blogs') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/admin/blogs') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                        <span class="sidebar-menu-text">Manage Blog</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ Request::is('admin/announcements') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/admin/announcements') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                        <span class="sidebar-menu-text">Manage Pengumuman</span>
                    </a>
                </li>

            </ul>


            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
<!-- // END Drawer -->
