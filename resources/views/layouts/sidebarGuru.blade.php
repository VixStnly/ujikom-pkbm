<!-- Drawer -->
@include('guru.header')
<div class="mdk-drawer js-mdk-drawer" style="z-index: 999;" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <a href="/dashboard" class="sidebar-brand ">
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-primary">
                        <img src="{{ asset('frontend/images/illustration/teacher/128/white.svg')}}" class="img-fluid"
                            alt="logo" />
                    </span>
                </span>
                <span>Guru</span>
            </a>

            <div class="sidebar-heading">Instructor</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('dashboard') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                        <span class="sidebar-menu-text">Dashboard Guru</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->is('guru/meeting*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('guru.meeting.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">event</span>
                        <span class="sidebar-menu-text">Pertemuan</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->is('guru/materi*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('guru.materi.pelajaran') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                        <span class="sidebar-menu-text">Materi</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->is('guru/tugas*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('guru.tugas.pelajaran') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment</span>
                        <span class="sidebar-menu-text">Tugas</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->is('guru/kelas*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('guru.kelas.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">widgets</span>
                        <span class="sidebar-menu-text">Kelas</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->is('guru/reports*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('guru.reports.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assessment</span>
                        <span class="sidebar-menu-text">Laporan</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->is('guru/history*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('guru.history.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">history</span>
                        <span class="sidebar-menu-text">Riwayat</span>
                    </a>
                </li>
                @if (session()->has('impersonate'))
                    <li class="sidebar-menu-item">
                        <form action="{{ route('imperson.leave') }}" method="POST" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-danger ml-4 mt-3">
                                Stop Monitoring
                            </button>
                        </form>
                    </li>
                @endif

                <!-- Tambah item menu lain sesuai kebutuhan -->
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>

<!-- // END Drawer -->