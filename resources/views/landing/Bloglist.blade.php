@include ('content.html')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PKBM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @include ('Page.Styles')

</head>

<body class="layout-sticky-subnav layout-default ">
<div class="mdk-header-layout js-mdk-header-layout">

            <!-- Header -->

            <div id="header"
                 class="mdk-header mdk-header--bg-primary bg-dark js-mdk-header mb-0"
                 data-effects="parallax-background waterfall"
                 data-fixed
                 data-condenses>
                <div class="mdk-header__bg">
                    <div class="mdk-header__bg-front"
                         style="background-image: url({{ asset('frontend/images/bg-triwala.jpg') }});"></div>
                </div>
                <div class="mdk-header__content justify-content-center">

                <div class="navbar navbar-expand navbar-dark-pickled-bluewood bg-transparent will-fade-background"
                         id="default-navbar"
                         data-primary>

                        <!-- Navbar toggler -->
                        <button class="navbar-toggler w-auto mr-16pt d-block d-md-none rounded-0"
                                type="button"
                                data-toggle="sidebar">
                            <span class="material-icons">short_text</span>
                        </button>


                        <!-- Navbar Brand -->
                        <a href="{{ url('/') }}" class="navbar-brand mr-16pt">
                            <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                                <span class="rounded">
                                    <img src="{{ asset('images/logo-academia.png') }}" alt="logo" class="img-fluid" />
                                </span>
                            </span>
                            <span class="d-none d-lg-block">PKBM</span>
                        </a>


                        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-center ml-8pt">
                            <li class="nav-item active">
                                <a href="/"
                                   class="nav-link">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Profile</a>
                                <div class="dropdown-menu">
                                    <a href="/Visi&Misi"
                                       class="dropdown-item">Visi &amp; Misi</a>
                                    <a href="/Profile"
                                       class="dropdown-item">Fisologi Logo</a>
                              </div>
                           </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Program</a>
                                <div class="dropdown-menu">
                                    <a href="/paketA-SD"
                                       class="dropdown-item">Paket A</a>
                                    <a href="/paketB-SMP"
                                       class="dropdown-item">Paket B</a>
                                    <a href="/paketC-SMA"
                                       class="dropdown-item">Paket C</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="/gallery"
                                   class="nav-link">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a href="/pendaftaran"
                                   class="nav-link">Pendaftaran</a>
                            </li>
                            <li class="nav-item">
                                <a href="/bloglist"
                                   class="nav-link">Blog</a>
                            </li>

                        </ul>

                        <ul class="nav navbar-nav ml-auto mr-0">
                            <li class="nav-item">
                                <a href="kontak.html"
                                class="nav-link"
                                data-toggle="tooltip"
                                data-title="Kontak Kami"
                                data-placement="bottom"
                                data-boundary="window"><i class="material-icons">contact_mail</i></a>
                            </li>

                            <li class="nav-item">
                                <a href="/login"
                                   class="btn btn-outline-white">Login</a>
                            </li>
                        </ul>
                    </div>

                    <div class="hero container page__container text-center text-md-left py-112pt">
                    <h1 class="text-white text-shadow">Blog</h1>
                    <p class="lead measure-hero-lead mx-auto mx-md-0 text-white text-shadow mb-0">tempat sekumpulan berita yang bisa di akses melalui pkbm</p>
                    </div>
                </div>
            </div>

            <!-- // END Header -->

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="text-center d-flex align-items-center flex-wrap mb-32pt"
                 style="white-space: nowrap;">
                <h5 class="mr-24pt mb-md-0 d-md-inline-block">Popular topics</h5>
                <a href=""
                   class="chip mb-16pt mb-md-0 chip-secondary">Berita</a>
            </div>

            <div class="row card-group-row">

            @foreach ($blogs->sortByDesc('created_at') as $blog)
                <div class="col-md-4 card-group-row__col">
                        <div class="card card--elevated posts-card-popular overlay m-2" style="flex: 0 0 100%;">
                            @if ($blog->image)
                                <a href="{{ url('/blog/' . $blog->id) }}">
                                    <img src="{{ Storage::url('blog/' . $blog->image) }}"
                                         alt="{{ $blog->title }}"
                                         class="card-img-top"
                                         style="object-fit: cover; height: 200px; width: 100%;">
                                </a>
                            @endif

                            <div class="fullbleed bg-primary" style="opacity: .5;"></div>

                            <div class="posts-card-popular__content">
                                <div class="card-body d-flex justify-content-end align-items-center">
                                    <a href="{{ url('/blog/' . $blog->id) }}"
                                       class="d-flex align-items-center text-white text-decoration-none">
                                        <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i>
                                        <small>{{ $blog->views ?? '0' }}</small>
                                    </a>
                                </div>

                                <div class="posts-card-popular__title card-body">
                                    <small class="text-muted text-uppercase">{{ $blog->category->name ?? 'Kategori' }}</small>
                                    <a href="{{ url('/blog/' . $blog->id) }}" class="card-title text-white">{{ $blog->title }}</a>
                                </div>
                            </div>
                        </div>
                </div>
            @endforeach

            </div>

        </div>
    </div>
    <div class="page-section">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">

                    <div class="page-separator">
                        <div class="page-separator__text">Design Resources</div>
                    </div>

                    <div class="mb-24pt">

                    <div class="container">
                        @foreach ($blogs->sortByDesc('created_at') as $blog)
                            <div class="card mb-4">
                                @if ($blog->image)
                                    <a href="/blog/{{ $blog->id }}">
                                        <img src="{{ Storage::url('blog/' . $blog->image) }}" class="card-img-top mx-auto d-block p-3 mt-1" alt="{{ $blog->title }}" style="width: 100%; object-fit: cover; height: 350px;">
                                    </a>
                                @endif
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="{{ url('/blog/' . $blog->id) }}" class="text-decoration-none" style="font-size: 1.5rem;">{{ $blog->title }}</a>
                                    </h3>
                                    <div class="d-flex align-items-center mt-3" style="font-family: 'Poppins', sans-serif;">
                                        <span class="me-3"><i class="fa fa-user text-primary"></i> {{ $blog->user->name ?? 'Pengguna Tidak Diketahui' }}</span>
                                        <span class="me-3"><i class="far fa-clock text-primary"></i> {{ $blog->created_at->format('d F Y') }}</span>
                                        <span class="me-3"><i class="far fa-comments text-primary"></i> 12 Comments</span>
                                        <li class="list-inline-item"><i class="far fa-eye text-primary"></i> 123 Views</li>
                                    </div>
                                    <p class="card-text" style="font-family: 'Poppins', sans-serif;">{!! Str::limit($blog->description, 400) !!}</p>
                                    <a href="{{ url('/blog/' . $blog->id) }}" class="text-primary text-decoration-underline fw-bold">Read More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </div>

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

                <x-content.outher-landing>
                            <a href="teacher-profile.html" class="btn btn-outline-primary w-100 mt-3" style="border-radius: 0;">Informasi Pendaftaran</a>
                </x-content.outher-landing>

            </div>

        </div>
    </div>

</div>
<!-- // END Header Layout Content -->

@include('Page.footer')

</div>


    @include ('Page.NavMenu')
            <!-- jQuery -->
            <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('frontend/vendor/popper.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap.min.js') }}"></script>

<!-- Perfect Scrollbar -->
<script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js') }}"></script>

<!-- DOM Factory -->
<script src="{{ asset('frontend/vendor/dom-factory.js') }}"></script>

<!-- MDK -->
<script src="{{ asset('frontend/vendor/material-design-kit.js') }}"></script>

<!-- App JS -->
<script src="{{ asset('frontend/js/app.js') }}"></script>

<!-- Preloader -->
<script src="{{ asset('frontend/js/preloader.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    (function() {
        'use strict';
        var headerNode = document.querySelector('.mdk-header')
        var layoutNode = document.querySelector('.mdk-header-layout')
        var componentNode = layoutNode ? layoutNode : headerNode
        componentNode.addEventListener('domfactory-component-upgraded', function() {
            headerNode.mdkHeader.eventTarget.addEventListener('scroll', function() {
                var progress = headerNode.mdkHeader.getScrollState().progress
                var navbarNode = headerNode.querySelector('#default-navbar')
                navbarNode.classList.toggle('bg-transparent', progress <= 0.2)
            })
        })
    })()
</script>
</body>