@include ('content.html')
<head>
    <meta charset="utf-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('content.style')
</head>

<body class="layout-sticky-subnav layout-default bg-light">
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        @include('Page.Nav2')

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">

            <div class="page-section border-bottom-2" style="background-image: url('https://img.freepik.com/free-vector/memphis-blue-background-with-halftone-line-elements_1017-33622.jpg?t=st=1741747513~exp=1741751113~hmac=8ddd9c4d65fa1c745f8b2fe57de8f53c70794f1dd3a3be4cf92ec64fc4d024f4&w=2000'); background-size: cover; background-position: center; padding-bottom: 50px;">
                <div class="container page__container">
                    <div class="d-flex flex-column align-items-center text-center">
                        <h1 class="h2 measure-lead-max mb-16pt text-white">PAKET B SETARA SMP</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-white">Profile</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Kesetaraan Paket B</li>
                            </ol>
                        </nav>

                        <style>
                            .breadcrumb-item::before {
                                color: white !important;
                            }
                            .breadcrumb-item i {
                                color: white !important;
                            }
                        </style>
                        
                    </div>
                </div>
            </div>

            <div class="page-section border-bottom-2">
                    <div class="container page__container">

                        <div class="row">
                            <div class="col-lg-8">

                                <div class="mb-24pt">
                                    <a href=""
                                       class="chip chip-outline-secondary">Design</a>
                                    <a href=""
                                       class="chip chip-outline-secondary">Sketch</a>
                                </div>

                                <div class="text-center mb-4">
                                    <img src="https://i.imgur.com/e9tLRO1.jpg" alt="" style="width: 100%; max-width: 700px; height: 350px;">
                                </div>
                                <h4>Paket B Setara SMP</h4>

                                <div class="d-flex flex-column flex-md-row mb-32pt">
                                    <div class="flex mb-16pt mb-md-0 mr-md-16pt">
                                        <p class="lead text-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, accusamus culpa deserunt distinctio, eos expedita inventore labore laborum libero magnam nisi recusandae sapiente sunt unde, voluptatibus? Accusantium distinctio laborum nihil, nostrum possimus quos rem repellendus tenetur voluptatem! A, ad adipisci commodi doloribus id maxime provident quo suscipit. Itaque, recusandae ut.</p>

                                        <blockquote class="blockquote">
                                            <p class="text-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque debitis distinctio earum et fugiat id itaque officia provident quasi! Dolorem, fuga modi molestias natus non nulla optio porro praesentium provident quaerat.</p>
                                            <footer class="blockquote-footer">Someone famous in
                                                <cite title="Source Title">Source Title</cite>
                                            </footer>
                                        </blockquote>
                                    </div>
                                    <div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="col-lg-4">

                                <!-- Section: Author -->
                                <div class="page-separator">
                                    <div class="page-separator__text">Outher</div>
                                </div>

                                <!-- Search Widget -->
                                <div class="card search-widget mb-3 bg-gray" style="border-radius: 0; box-shadow: none;">
                                    <div class="card-body">
                                        <form action="#" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search..." name="query">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Latest Posts Widget -->
                                <div class="card post-widget" style="border-radius: 0; box-shadow: none;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Latest Posts</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled latest-posts">
                                            <li class="d-flex mb-3">
                                                <div class="post-thumb me-3">
                                                    <a href="/paketA-SD">
                                                        <img class="img-fluid rounded" src="https://penapijar.com/wp-content/uploads/2022/01/PKBM-Mawar.png" alt="" style="width: 90px; height: 60px;">
                                                    </a>
                                                </div>
                                                <div class="post-info">
                                                    <h6 class="mb-1">
                                                        <a href="/paketA-SD" class="text-decoration-none">Paket Kesetaraan A</a>
                                                    </h6>
                                                    <p class="text-muted small mb-0"><i class="far fa-calendar-alt"></i> 4 Dec 2019</p>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-3">
                                                <div class="post-thumb me-3">
                                                    <a href="/paketB-SMP">
                                                        <img class="img-fluid rounded" src="https://i.imgur.com/e9tLRO1.jpg" alt="" style="width: 90px; height: 60px;">
                                                    </a>
                                                </div>
                                                <div class="post-info">
                                                    <h6 class="mb-1">
                                                        <a href="/paketB-SMP" class="text-decoration-none">Paket Kesetaraan B</a>
                                                    </h6>
                                                    <p class="text-muted small mb-0"><i class="far fa-calendar-alt"></i> 4 Dec 2019</p>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-3">
                                                <div class="post-thumb me-3">
                                                <a href="/paketC-SMA">
                                                        <img class="img-fluid rounded" src="https://www.radarbogor.id/files/2020/08/PKBM.jpg" alt="" style="width: 90px; height: 60px;">
                                                    </a>
                                                </div>
                                                <div class="post-info">
                                                    <h6 class="mb-1">
                                                        <a href="/paketC-SMA" class="text-decoration-none">Paket Kesetaraan C</a>
                                                    </h6>
                                                    <p class="text-muted small mb-0"><i class="far fa-calendar-alt"></i> 4 Dec 2019</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Follow Button -->
                                <a href="teacher-profile.html" class="btn btn-outline-primary w-100 mt-3" style="border-radius: 0;">Informasi Pendaftaran</a>

                            </div>

                        </div>

                    </div>
                </div>
        </div>
        <!-- // END Header Layout Content -->

        <!-- Footer -->
        @include ('Page.footer')
    </div>

    <!-- Drawer -->
    @include('Page.NavMenu')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
</body>
