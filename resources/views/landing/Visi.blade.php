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

            <x-content.banner-landing title="Visi dan Misi PKBM">
                <h1 class="h2 measure-lead-max mb-16pt text-white">Visi &amp; Misi</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">Profile</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Visi & Misi</li>
                    </ol>
                </nav>
            </x-content.banner-landing>

            <div class="page-section border-bottom-2">
                <div class="container page__container">

                    <div class="row">
                        <div class="col-lg-8">

                            <h4>VISI PKBM</h4>

                            <div class="d-flex flex-column flex-md-row mb-32pt">
                                <div class="flex mb-16pt mb-md-0 mr-md-16pt">
                                    <p class="lead text-70 measure-paragraph-max" style="text-align: justify;">Menjadi aplikasi pendidikan non-formal terpercaya yang memudahkan masyarakat dalam mengakses, memilih, dan mengikuti program pendidikan kesetaraan dengan cara yang mudah, terbuka untuk semua kalangan, dan didukung oleh sistem pembelajaran yang efektif.</p>

                                    <blockquote class="blockquote">
                                        <p class="text-50" style="text-align: justify;">
                                            1. Menjadi platform pendidikan non-formal digital yang terpercaya dan mudah diakses oleh seluruh lapisan masyarakat.<br>
                                            2. Meningkatkan kualitas dan pemerataan pendidikan kesetaraan melalui teknologi yang inovatif dan ramah pengguna.<br>
                                            3. Mendorong terciptanya masyarakat yang lebih cerdas dan mandiri melalui layanan pendidikan yang adaptif dan berkelanjutan.
                                        </p>
                                        <footer class="blockquote-footer">PKBM Vision and Mission</footer>
                                    </blockquote>
                                </div>
                                <div>
                                    <div class="rounded p-relative o-hidden overlay overlay--primary" style="width: 200px; height: 168px;">
                                        <img class="img-fluid rounded"
                                            src="https://murnajati.jatimprov.go.id/assets/img/profil-instansi/visimisi.png"
                                            alt="Image"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                        <div class="overlay__content"></div>
                                    </div>
                                </div>
                            </div>

                            <h4>MISI PKBM</h4>

                            <div class="d-flex flex-column flex-md-row mb-32pt">
                                <div class="flex mb-16pt mb-md-0 mr-md-16pt">
                                    <p class="lead text-70 measure-paragraph-max" style="text-align: justify;">Aplikasi ini hadir untuk memudahkan masyarakat dalam mengakses informasi dan mendaftar program Paket A, B, dan C secara praktis. Dengan tampilan yang ramah pengguna dan fitur interaktif, aplikasi ini mendukung proses belajar yang fleksibel dan efisien. Kami berkomitmen bekerja sama dengan PKBM dan para pendidik untuk menjaga kualitas layanan serta mendorong pemerataan pendidikan bagi semua kalangan, tanpa batasan usia atau lokasi.</p>

                                </div>
                                <div>
                                    <div class="rounded p-relative o-hidden overlay overlay--primary" style="width: 200px; height: 168px;">
                                        <img class="img-fluid rounded"
                                            src="{{ asset('images/MISI.png') }}"
                                            alt="Image"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                        <div class="overlay__content"></div>
                                    </div>
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