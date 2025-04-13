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

            <x-content.banner-landing>
                <h1 class="h2 measure-lead-max mb-16pt text-white">PAKET A SETARA SD</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">Profile</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Kesetaraan Paket C</li>
                    </ol>
                </nav>
            </x-content.banner-landing>

            <div class="page-section border-bottom-2">
                <div class="container page__container">

                    <div class="row">
                        <div class="col-lg-8">

                        <div class="page-separator">
                            <div class="page-separator__text">Informasi</div>
                        </div>

                            <div class="text-center mb-4">
                                <img src="https://penapijar.com/wp-content/uploads/2022/01/PKBM-Mawar.png" alt="" style="width: 100%; max-width: 700px; height: 350px;">
                            </div>
                            <h4>Paket A Setara SD</h4>

                            <div class="d-flex flex-column flex-md-row mb-32pt">
                                <div class="flex mb-16pt mb-md-0 mr-md-16pt">
                                    <p class="lead text-50">Paket A adalah program pendidikan kesetaraan yang setara dengan Sekolah Dasar (SD). Program ini ditujukan bagi warga negara yang tidak sempat menyelesaikan pendidikan dasar, baik karena keterbatasan ekonomi, lokasi, atau alasan lainnya.</p>
                                    <p class="lead text-50">Dengan mengikuti Paket A, peserta akan mendapatkan pengetahuan dasar yang diperlukan untuk melanjutkan pendidikan ke jenjang yang lebih tinggi. Program ini juga memberikan kesempatan bagi peserta untuk belajar secara mandiri dengan bimbingan dari tenaga pendidik yang berpengalaman.</p>
                                    <h5 class="mt-4 text-30">Keunggulan Program:</h5>
                                    <blockquote class="blockquote">
                                    <ul class="list-unstyled text-50">
                                        <li class="mb-2"><span>•</span> Materi pembelajaran fleksibel</li>
                                        <li class="mb-2"><span>•</span> Dapat diikuti oleh semua usia</li>
                                        <li class="mb-2"><span>•</span> Mendapatkan ijazah setara SD</li>
                                        <li class="mb-2"><span>•</span> Bimbingan oleh tenaga pendidik profesional</li>
                                    </ul>
                                        <footer class="blockquote-footer mt-0">PKBM 
                                            <cite title="Source Title">Suka Cita</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                                <div>
                                </div>
                            </div>

                        </div>

                        <x-content.outher-landing>
                            <a href="teacher-profile.html" class="btn btn-outline-primary w-100 mt-3" style="border-radius: 0;">Informasi Pendaftaran</a>
                        </x-content.outher-landing>

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