<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>

<!-- Drawer -->

<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <div class="d-flex align-items-center navbar-height">
                <form action="index.html" class="search-form search-form--black mx-16pt pr-0 pl-16pt">
                    <input type="text" class="form-control pl-0" placeholder="Search">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                </form>
            </div>

            <a href="index.html" class="sidebar-brand ">

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                    <span class="avatar-title rounded bg-success"><img
                            src="{{ asset('frontend/images/illustration/student/128/academia.png') }}" class="img-fluid"
                            alt="logo" /></span>

                </span>

                <span>PKBM</span>
            </a>

            <div class="sidebar-heading">Super Admin</div>
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
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="/admin/pendaftaran">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                        <span class="sidebar-menu-text">Pendaftaran</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="/admin/guru">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                        <span class="sidebar-menu-text">Data Guru</span>
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
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">description</span>
                        <span class="sidebar-menu-text">Manage Blogs</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ Request::is('admin/gallery') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/admin/gallery') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">photo</span>
                        <span class="sidebar-menu-text">Manage Gallery</span>
                    </a>
                </li>


                <li class="sidebar-menu-item {{ Request::is('admin/announcements') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/admin/announcements') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">announcement</span>
                        <span class="sidebar-menu-text">Manage Pengumuman</span>
                    </a>
                </li>
            </ul>




            <!-- // END Sidebar Content -->

        </div>
    </div>
</div>

<!-- // END Drawer -->