<!-- HTML -->
@include ('content.html')

    <head>
        <!-- Prevent the demo from appearing in search engines -->

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="{{ asset('frontend/vendor/spinkit.css')}}"
              rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="{{ asset('frontend/vendor/perfect-scrollbar.css')}}"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="{{ asset('frontend/css/material-icons.css')}}"
              rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css"
              href="{{ asset('frontend/css/fontawesome.css')}}"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="{{ asset('frontend/css/preloader.css')}}"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="{{ asset('frontend/css/app.css')}}"
              rel="stylesheet">
    </head>

    <body class="layout-sticky-subnav layout-learnly ">
    @include ('layouts.NavSiswa')    
    @include ('content.sidemenu')
    
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">

        <div class="page-section bg-alt border-bottom-2">
            <div class="container page__container">

                <div class="d-flex flex-column flex-lg-row align-items-center">
                    <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                        <h1 class="h2 mb-8pt">Tugas Saya</h1>
                       
                    </div>
                    <div class="ml-lg-16pt">
                        <a href="student-profile.html"
                        class="btn btn-light">My Profile</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="page-section">
            <div class="container page__container">

                <div class="row">
                    <div class="col-lg-8">

                        <div class="page-separator">
                            <div class="page-separator__text">Daftar Tugas @foreach($user->kelas as $kelas)
        {{ $kelas->name }}
    @endforeach </div>
                        </div>

                        <div class="card">
                            <img src="{{ asset('frontend/images/paths/typescript_892x286.png') }}"
                                alt="TypeScript"
                                class="card-img"
                                style="max-height: 100%; width: initial;">
                            <div class="fullbleed bg-primary"
                                style="opacity: .5;"></div>
                            <img src="{{ asset('frontend/images/paths/typescript_64x64.svg') }}"
                                width="64"
                                alt="Instruduction to TypeScript"
                                class="rounded position-absolute"
                                style="right: 1rem; top: 1rem;">
                            <div class="card-body d-flex align-items-center justify-content-center fullbleed">
                                <div>
                                    <h2 class="text-white mb-16pt">Selamat Mengerjakan Tugas :)</h2>
                                    <div class="d-flex align-items-center mb-16pt justify-content-center">
                                        <div class="d-flex align-items-center mr-16pt">
                                            <span class="material-icons icon-16pt text-white-50 mr-4pt">access_time</span>
                                            <p class="flex text-white-50 lh-1 mb-0">Kerjakan Tepat Waktu</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-white-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-white-50 lh-1 mb-0">Selalu Berdoa</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="student-take-lesson.html"
                                        class="btn btn-white mr-8pt">Resume</a>
                                        <a href="student-take-course.html"
                                        class="btn btn-outline-white ml-0">Start over</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                   

                        <div class="page-separator">
                            <div class="page-separator__text">Tugas Lain</div>
                        </div>
                        <div class="row card-group-row mb-lg-8pt">
    @if($tugass->isEmpty())
        <p>Tidak ada tugas untuk kelas Anda saat ini.</p>
    @else
        @foreach($tugass as $tugas)
        <div class="col-sm-6 card-group-row__col">
        <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
     data-toggle="popover" data-trigger="click">
    <div class="card-body d-flex flex-column">
        <div class="d-flex align-items-center">
            <div class="flex">
                <div class="d-flex align-items-center">
                    <div class="rounded mr-12pt z-0 o-hidden">
                        <div class="overlay">
                            <!-- Menggunakan ikon tugas -->
                            <span class="material-icons" style="font-size: 40px;">assignment</span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="card-title">{{ $tugas->judul }}</div>
                        <p class="mt-16pt text-70">
                            {{ implode(' ', array_slice(explode(' ', $tugas->deskripsi), 0, 5)) }}{{ strlen($tugas->deskripsi) > 5 ? '...' : '' }}
                        </p>
                    </div>
                </div>
            </div>

            <a href="/submit/tugas/{{$tugas->id}}" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary">Kumpulkan</a>
        </div>
    </div>
</div>


            <div class="popoverContainer d-none">
                <div class="media">
                    <div class="media-left mr-12pt">
                        <img src="{{ asset('frontend/images/paths/angular_40x40@2x.png') }}" width="40" height="40" alt="{{ $tugas->judul }}" class="rounded">
                    </div>
                    <div class="media-body">
                        <div class="card-title">{{ $tugas->judul }}</div>
                        <p class="text-50 d-flex lh-1 mb-0 small">{{ $tugas->deskripsi }}</p>
                    </div>
                </div>


                <div class="my-32pt">
    <div class="d-flex align-items-center mb-8pt justify-content-center">
        <div class="d-flex align-items-center mr-8pt">
            <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
            <p class="flex text-50 lh-1 mb-0">
                <small>{{ \Carbon\Carbon::parse($tugas->tenggat_waktu)->diffForHumans() }}</small>
            </p>
        </div>
    </div>

    @if (\Carbon\Carbon::now()->isBefore(\Carbon\Carbon::parse($tugas->tenggat_waktu)))
        <div class="d-flex align-items-center justify-content-center">
            <a href="/submit/tugas/{{$tugas->id}}" class="btn btn-primary mr-8pt">Kumpulkan</a>
            <a href="/review" class="btn btn-outline-secondary ml-0">Lihat Materi</a>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <strong>Peringatan:</strong> Anda terlambat mengumpulkan tugas!
        </div>
    @endif
</div>

            </div>
        </div>
        @endforeach
    @endif
</div>

                        <div class="mb-32pt">

                            <ul class="pagination justify-content-start pagination-xsm m-0">
                                <li class="page-item disabled">
                                    <a class="page-link"
                                    href="#"
                                    aria-label="Previous">
                                        <span aria-hidden="true"
                                            class="material-icons">chevron_left</span>
                                        <span>Prev</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link"
                                    href="#"
                                    aria-label="Page 1">
                                        <span>1</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link"
                                    href="#"
                                    aria-label="Page 2">
                                        <span>2</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link"
                                    href="#"
                                    aria-label="Next">
                                        <span>Next</span>
                                        <span aria-hidden="true"
                                            class="material-icons">chevron_right</span>
                                    </a>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div class="col-lg-4">

                        <div class="page-separator">
                            <div class="page-separator__text">Achievements</div>
                        </div>

                        <div id="carouselExampleFade"
                            class="carousel carousel-card slide mb-24pt">
                            <div class="carousel-inner">

                                <div class="carousel-item active">

                                    <a class="card border-0 mb-0"
                                    href="">
                                        <img src="{{ asset('frontend/images/achievements/flinto.png') }}"
                                            alt="Flinto"
                                            class="card-img"
                                            style="max-height: 100%; width: initial;">
                                        <div class="fullbleed bg-primary"
                                            style="opacity: .5;"></div>
                                        <span class="card-body d-flex flex-column align-items-center justify-content-center fullbleed">
                                            <span class="row flex-nowrap">
                                                <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                    <span class="h5 text-white text-uppercase font-weight-normal m-0 d-block">Achievement</span>
                                                    <span class="text-white-60 d-block mb-24pt">Jun 5, 2018</span>
                                                </span>
                                                <span class="col d-flex flex-column">
                                                    <span class="text-right flex mb-16pt">
                                                        <img src="{{ asset('frontend/images/paths/flinto_40x40@2x.png') }}"
                                                            width="64"
                                                            alt="Flinto"
                                                            class="rounded">
                                                    </span>
                                                </span>
                                            </span>
                                            <span class="row flex-nowrap">
                                                <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                    <img src="{{ asset('frontend/images/illustration/achievement/128/white.png') }}"
                                                        width="64"
                                                        alt="achievement">
                                                </span>
                                                <span class="col d-flex flex-column">
                                                    <span>
                                                        <span class="card-title text-white mb-4pt d-block">Flinto</span>
                                                        <span class="text-white-60">Introduction to The App Design Application</span>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                    </a>

                                </div>

                                <div class="carousel-item">

                                    <a class="card border-0 mb-0"
                                    href="">
                                        <img src="{{ asset('frontend/images/achievements/angular.png') }}"
                                            alt="Angular fundamentals"
                                            class="card-img"
                                            style="max-height: 100%; width: initial;">
                                        <div class="fullbleed bg-primary"
                                            style="opacity: .5;"></div>
                                        <span class="card-body d-flex flex-column align-items-center justify-content-center fullbleed">
                                            <span class="row flex-nowrap">
                                                <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                    <span class="h5 text-white text-uppercase font-weight-normal m-0 d-block">Achievement</span>
                                                    <span class="text-white-60 d-block mb-24pt">Jun 5, 2018</span>
                                                </span>
                                                <span class="col d-flex flex-column">
                                                    <span class="text-right flex mb-16pt">
                                                        <img src="{{ asset('frontend/images/paths/angular_64x64.png') }}"
                                                            width="64"
                                                            alt="Angular fundamentals"
                                                            class="rounded">
                                                    </span>
                                                </span>
                                            </span>
                                            <span class="row flex-nowrap">
                                                <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                    <img src="{{ asset('frontend/images/illustration/achievement/128/white.png') }}"
                                                        width="64"
                                                        alt="achievement">
                                                </span>
                                                <span class="col d-flex flex-column">
                                                    <span>
                                                        <span class="card-title text-white mb-4pt d-block">Angular fundamentals</span>
                                                        <span class="text-white-60">Creating and Communicating Between Angular Components</span>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                    </a>

                                </div>

                            </div>

                            <a class="carousel-control-next"
                            href="#carouselExampleFade"
                            role="button"
                            data-slide="next">
                                <span class="carousel-control-icon material-icons"
                                    aria-hidden="true">keyboard_arrow_right</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <div class="page-separator">
                            <div class="page-separator__text">Recommended</div>
                        </div>

                        <div class="mb-8pt d-flex align-items-center">
                            <a href="student-course.html"
                            class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                <img src="{{ asset('frontend/images/paths/angular_routing_200x168.png') }}"
                                    alt="Angular Routing In-Depth"
                                    class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt"
                                href="student-course.html">Angular Routing In-Depth</a>
                            </div>
                        </div>
                        <div class="mb-16pt d-flex align-items-center">
                            <a href="student-course.html"
                            class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                <img src="{{ asset('frontend/images/paths/angular_testing_200x168.png') }}"
                                    alt="Angular Unit Testing"
                                    class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt"
                                href="student-course.html">Angular Unit Testing</a>
                            </div>
                        </div>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0">
                                <a href="student-course.html"
                                class="card-title mb-4pt">Angular Best Practices</a>
                                <p class="lh-1 mb-0">
                                    <small class="text-muted mr-8pt">6h 40m</small>
                                    <small class="text-muted mr-8pt">13,876 Views</small>
                                    <small class="text-muted">13 May 2018</small>
                                </p>
                            </div>
                            <div class="list-group-item px-0">
                                <a href="student-course.html"
                                class="card-title mb-4pt">Unit Testing in Angular</a>
                                <p class="lh-1 mb-0">
                                    <small class="text-muted mr-8pt">6h 40m</small>
                                    <small class="text-muted mr-8pt">13,876 Views</small>
                                    <small class="text-muted">13 May 2018</small>
                                </p>
                            </div>
                            <div class="list-group-item px-0">
                                <a href="student-course.html"
                                class="card-title mb-4pt">Migrating Applications from AngularJS to Angular</a>
                                <p class="lh-1 mb-0">
                                    <small class="text-muted mr-8pt">6h 40m</small>
                                    <small class="text-muted mr-8pt">13,876 Views</small>
                                    <small class="text-muted">13 May 2018</small>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- // END Header Layout Content -->

    @extends ('content.js')

    </body>