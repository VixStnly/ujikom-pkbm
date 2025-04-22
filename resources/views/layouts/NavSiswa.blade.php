<head>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <style>
        .img-profile img {
            border-radius: 50%;
            width: 32px;
            height: 32px;
            object-fit: cover;
        }
    </style>
</head>

<body class="layout-sticky-subnav layout-learnly">
    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>

    <!-- Header Layout -->
    <div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
        <div class="mdk-header__content">
            <div class="navbar navbar-expand navbar-light bg-white border-bottom" id="default-navbar" data-primary>
                <div class="container page__container">

                    <!-- Navbar Brand -->
                    <a href="index.html" class="navbar-brand mr-16pt">
                        <span class="avatar avatar-lg navbar-brand-icon mr-lg-8pt">
                            <span class="avatar-title rounded bg-transparent">
                                <img src="{{ asset('frontend/images/illustration/student/128/logo-academia.png') }}"
                                    alt="logo" class="img-fluid" style="width: 55px; height: 55px;" />
                            </span>
                        </span>
                        <span class="d-none d-lg-block">Elearning</span>
                    </a>

                    <!-- Navbar toggler -->
                    <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button" data-toggle="sidebar">
                        <span class="material-icons">short_text</span>
                    </button>

                    <x-notification-siswa :notifications="$notifications" :unreadCount="$unreadCount" />




                    <!-- Account dropdown -->
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-caret="false">
                            <div class="flex items-center">
                                <span class="avatar img-profile avatar-sm mr-8pt2" style="width: 32px; height: 42px;">
                                    @if ($user->profile_image)
                                    <img src="{{ Storage::url('profil/' . $user->profile_image) }}" alt="{{ $user->name }}" class="rounded-full w-8 h-8 object-cover" style="width: 42px; height: 42px;" />
                                    @else
                                    <span class="avatar avatar-sm mr-1pt2 ">
                                        <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header"><strong>Account</strong></div>

                            <!-- Link Edit Account -->
                            <a class="dropdown-item" href="/profile">Edit Account</a>

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

                    <div class="profile-info d-none d-md-flex flex-column align-items-start text-end ms-auto"
                        style="max-width: 100%;">
                        <span class="user-name fw-bold text-dark text-truncate" style="font-size: 14px; max-width: 150px;">
                            {{ Str::limit($user->name, 7) }}
                        </span>
                        <span class="text-muted" style="font-size: 12px;">Online</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- // END Header -->
</body>