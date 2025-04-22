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

            <a href="index.html" class="sidebar-brand">
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-success">
                        <img src="{{ asset('frontend/images/illustration/student/128/triwala.png') }}" class="img-fluid" alt="logo" />
                    </span>
                </span>
                <span>Triwala</span>
            </a>

            <div class="sidebar-heading">Menu</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ url('/') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Home</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#account_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                        Profile
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="account_menu">
                        <li class="sidebar-menu-item {{ Request::is('visi-misi') ? 'active' : '' }}"><a class="sidebar-menu-button" href="/Visi&Misi"><span class="sidebar-menu-text">Visi &amp; Misi</span></a></li>
                        <li class="sidebar-menu-item {{ Request::is('strategi-pengelolaan') ? 'active' : '' }}"><a class="sidebar-menu-button" href="/Profile"><span class="sidebar-menu-text">Fisologi Logo</span></a></li>
                        <li class="sidebar-menu-item {{ Request::is('gallery') ? 'active' : '' }}"><a class="sidebar-menu-button" href="{{ url('/gallery') }}"><span class="sidebar-menu-text">Galeri</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#program_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">tune</span>
                        Program
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="program_menu">
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="signup.html"><span class="sidebar-menu-text">Paket A</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="signup-payment.html"><span class="sidebar-menu-text">Paket B</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="reset-password.html"><span class="sidebar-menu-text">Paket C</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button"
                        href="courses.html">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">photo_album</span>
                        <span class="sidebar-menu-text">Gallery</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button"
                        href="courses.html">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">person_add</span>
                        <span class="sidebar-menu-text">Pendaftaran</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button"
                        href="courses.html">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                        <span class="sidebar-menu-text">Blog</span>
                    </a>
                </li>


            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
<!-- // END Drawer -->