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
                        <li class="sidebar-menu-item {{ Request::is('visi-misi') ? 'active' : '' }}"><a class="sidebar-menu-button" href="visi-misi.html"><span class="sidebar-menu-text">Visi &amp; Misi</span></a></li>
                        <li class="sidebar-menu-item {{ Request::is('strategi-pengelolaan') ? 'active' : '' }}"><a class="sidebar-menu-button" href="strategi-pengelolaan.html"><span class="sidebar-menu-text">Strategi Pengelolaan</span></a></li>
                        <li class="sidebar-menu-item {{ Request::is('kalender-pendidikan') ? 'active' : '' }}"><a class="sidebar-menu-button" href="kalender-pendidikan.html"><span class="sidebar-menu-text">Kalender Pendidikan</span></a></li>
                        <li class="sidebar-menu-item {{ Request::is('sejarah-singkat') ? 'active' : '' }}"><a class="sidebar-menu-button" href="sejarah-singkat.html"><span class="sidebar-menu-text">Sejarah Singkat</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="reset-password.html"><span class="sidebar-menu-text">Sarana Prasarana</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="change-password.html"><span class="sidebar-menu-text">Struktur Organisasi</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account.html"><span class="sidebar-menu-text">Kepala PKBM</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account-profile.html"><span class="sidebar-menu-text">Guru PKBM</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account-notifications.html"><span class="sidebar-menu-text">Tenaga Kependidikan</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account-password.html"><span class="sidebar-menu-text">NaraSumber Teknis</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="billing.html"><span class="sidebar-menu-text">Komite</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="billing-upgrade.html"><span class="sidebar-menu-text">Prestasi</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="billing-payment.html"><span class="sidebar-menu-text">Agenda</span></a></li>
                        <li class="sidebar-menu-item {{ Request::is('gallery') ? 'active' : '' }}"><a class="sidebar-menu-button" href="{{ url('/gallery') }}"><span class="sidebar-menu-text">Galeri</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="billing-invoice.html"><span class="sidebar-menu-text">Kontak</span></a></li>
                        <!-- Add more submenu items with active check here -->
                    </ul>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#program_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">tune</span>
                        Program
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="program_menu">
                        <li class="sidebar-menu-item {{ Request::is('keaksaran') ? 'active' : '' }}"><a class="sidebar-menu-button" href="keaksaran.html"><span class="sidebar-menu-text">Keaksaran</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="login.html"><span class="sidebar-menu-text">Paud</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="signup.html"><span class="sidebar-menu-text">Paket A</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="signup-payment.html"><span class="sidebar-menu-text">Paket B</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="reset-password.html"><span class="sidebar-menu-text">Paket C IPA</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="change-password.html"><span class="sidebar-menu-text">Paket C IPS</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account.html"><span class="sidebar-menu-text">TBM IPA</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account-profile.html"><span class="sidebar-menu-text">Kursus Keterampilan</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account-notifications.html"><span class="sidebar-menu-text">Ekstrakulikuler</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="edit-account-password.html"><span class="sidebar-menu-text">NaraSumber Teknis</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="billing.html"><span class="sidebar-menu-text">Komite</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="billing-upgrade.html"><span class="sidebar-menu-text">Prestasi</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="billing-payment.html"><span class="sidebar-menu-text">Agenda</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" data-toggle="collapse" href="#kursus_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                        Kursus
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="kursus_menu">
                        <li class="sidebar-menu-item {{ Request::is('jenis-kursus') ? 'active' : '' }}"><a class="sidebar-menu-button" href="jenis-kursus.html"><span class="sidebar-menu-text">Jenis - Jenis Kursus</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="login.html"><span class="sidebar-menu-text">Kurikulum Tata Busana</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="signup.html"><span class="sidebar-menu-text">Kurikulum Tata Rias Pengantin</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="signup-payment.html"><span class="sidebar-menu-text">Kurikulum Bhs.Inggris</span></a></li>
                        <li class="sidebar-menu-item"><a class="sidebar-menu-button" href="reset-password.html"><span class="sidebar-menu-text">Pembiayaan</span></a></li>
                    </ul>
                </li>
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
<!-- // END Drawer -->
