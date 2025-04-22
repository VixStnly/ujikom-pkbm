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
                <h1 class="h2 measure-lead-max mb-16pt text-white">Filosofi Logo</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">Profile</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Filosofi logo</li>
                    </ol>
                </nav>
            </x-content.banner-landing>

            <div class="page-section border-bottom-2">
                <div class="container page__container">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="text-center mb-4">
                                <img src="{{ asset('images/logo-academia.png') }}" alt="Logo Academia" style="width: 200px;">
                            </div>
                            <h4>Filosofi Logo</h4>

                            <div class="d-flex flex-column flex-md-row mb-32pt">
                                <div class="flex mb-16pt mb-md-0 mr-md-16pt">
                                    <p class="lead text-50">Filosofi logo ini mencerminkan semangat pendidikan yang inklusif, modern, dan berorientasi pada masa depan. Logo ini menggambarkan komitmen untuk membuka akses belajar seluas-luasnya melalui teknologi, dengan harapan setiap individu, dari mana pun latar belakangnya, tetap bisa mengejar ilmu dan meraih mimpi mereka. Semangat kolaborasi dan pencapaian menjadi fondasi utama dalam menciptakan lingkungan belajar yang inspiratif dan bermakna.</p>

                                    <blockquote class="blockquote">
                                        <p class="text-50">Selain itu, logo ini juga merepresentasikan pertumbuhan yang berkelanjutan—baik secara intelektual maupun karakter. Pendidikan dipandang sebagai proses yang hidup, terus berkembang, dan berdampak positif bagi lingkungan sekitar. Dengan filosofi ini, PKBM Academia hadir bukan sekadar sebagai tempat belajar, tetapi sebagai ruang bertumbuh bagi generasi masa depan.</p>
                                        <footer class="blockquote-footer">PKBM Academia
                                        </footer>
                                    </blockquote>
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