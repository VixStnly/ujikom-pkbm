<head>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <style>
        /* Ensure rounded avatar images */
        .img-profile img {
            border-radius: 50%; /* Round shape */
            width: 32px; /* Set width */
            height: 32px; /* Set height */
            object-fit: cover; /* Maintain aspect ratio */
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
                    <a href="index.html" class="navbar-brand mr-16pt d-none d-lg-flex align-items-center">
                        <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                            <span class="avatar-title rounded bg-success">
                                <img src="{{ asset('frontend/images/illustration/student/128/triwala.png') }}"
                                    alt="logo" class="img-fluid" />
                            </span>
                        </span>
                        <span class="d-none d-lg-block">Elearning</span>
                    </a>

                    <!-- Navbar toggler -->
                    <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button" data-toggle="sidebar">
                        <span class="material-icons">short_text</span>
                    </button>

                    <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt"></ul>

                    <div class="profile-info ml-16pt ml-auto">
                        <p class="user-name mb-4pt">{{ Str::limit($user->name, 8) }}</p>
                    </div>

                    <!-- Account dropdown -->
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-caret="false">
                            <div class="flex items-center">
                                <span class="avatar img-profile mr-2" style="width: 32px; height: 42px;">
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
                </div>
            </div>
        </div>
    </div>
    <!-- // END Header -->
</body>
