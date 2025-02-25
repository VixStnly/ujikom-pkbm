<head>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    
</head>

<!-- Navbar Layout -->
<div class="navbar navbar-expand pr-0 navbar-light border-bottom-2" id="default-navbar" data-primary>

    <!-- Navbar Toggler -->
    <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button" data-toggle="sidebar">
        <span class="material-icons">short_text</span>
    </button>
    <!-- // END Navbar Toggler -->

    <!-- Navbar Brand -->
    <a href="index.html" class="navbar-brand mr-16pt d-lg-none">
        <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
            <span class="avatar-title rounded bg-primary">
                <img src="../../public/images/illustration/student/128/white.svg" alt="logo" class="img-fluid" />
            </span>
        </span>
        <span class="d-none d-lg-block">Luma</span>
    </a>
    <!-- // END Navbar Brand -->

    <span class="d-none d-md-flex align-items-center mr-16pt">
        <span class="avatar avatar-sm mr-12pt">
            <span class="avatar-title rounded navbar-avatar">
                <i class="material-icons">supervised_user_circle</i>
            </span>
        </span>
        <small class="flex d-flex flex-column">
            <strong class="navbar-text-100">MODERATOR</strong>
            @if (auth()->check())
    <span class="navbar-text-50">{{ auth()->user()->name }}</span>
@else
    <span class="navbar-text-50">Guest</span> <!-- Or handle how you want to display it for guests -->
@endif
        </small>
    </span>

    <div class="flex"></div>

    <!-- Navbar Menu -->
    <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">

        <!-- Notifications Dropdown -->

        <!-- // END Notifications Dropdown -->

        
        <!-- // END Notifications Dropdown -->

        <!-- Account Dropdown -->
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
                <a class="dropdown-item" href="{{ url('/profileAdmin') }}">Edit Account</a>
                
                <!-- Form Logout (hidden) -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <!-- Link Logout -->
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
        </div>
        <!-- // END Account Dropdown -->

    </div>
</div>
<!-- // END Navbar -->
