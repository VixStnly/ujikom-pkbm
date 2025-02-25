<!-- Navbar -->
<div class="navbar navbar-expand pr-0 navbar-light border-bottom-2" id="default-navbar" data-primary>

    <!-- Navbar Toggler -->

    <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button" data-toggle="sidebar">
        <span class="material-icons">short_text</span>
    </button>

    <!-- // END Navbar Toggler -->

    <!-- Navbar Brand -->

    <a href="/dashboard" class="navbar-brand mr-16pt d-lg-none">
        <span class="d-none d-lg-block">PKBM</span>
    </a>

    <!-- // END Navbar Brand -->

    <span class="d-none d-md-flex align-items-center mr-16pt">
        <span class="avatar avatar-sm mr-12pt">
            <span class="avatar-title rounded navbar-avatar">
                <i class="material-icons">school</i>
            </span>
        </span>
        <small class="flex d-flex flex-column">
            <strong class="navbar-text-100">Guru</strong>
            <span class="navbar-text-50">{{$user->name}}</span>
        </small>
    </span>


    <div class="flex"></div>

    <!-- // END Switch Layout -->

    <!-- Navbar Menu -->

    <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">

        <!-- Notifications dropdown -->
       
        <!-- // END Notifications dropdown -->

        <!-- Notifications dropdown -->
     
        <!-- // END Notifications dropdown -->

        <div class="nav-item dropdown">
            <a href="" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                data-caret="false">
                <span class="avatar img-profile mr-8pt2" style="width: 42px; height: 42px;">
                    @if ($user->profile_image)
                        <img src="{{ Storage::url('profil/' . $user->profile_image) }}" alt="{{ $user->name }}"
                            class="rounded-circle w-100 h-100 object-cover" style="object-fit: cover;" />
                    @else
                        <span class="avatar-title rounded-circle bg-primary w-100 h-100 flex items-center justify-center"
                            style="width: 42px; height: 42px;">
                            <i class="material-icons text-white">account_box</i>
                        </span>
                    @endif
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header"><strong>Account</strong></div>

                <!-- Link Edit Account -->
                <a class="dropdown-item" href="{{route('profile.editGuru')}}">Edit Account</a>

                <!-- Form Logout (disembunyikan) -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <!-- Link Logout -->
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>

        </div>
    </div>

    <!-- // END Navbar Menu -->

</div>

<!-- // END Navbar -->