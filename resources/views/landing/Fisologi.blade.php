@include ('content.html')
<head>
    <meta charset="utf-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                        <h1 class="h2 measure-lead-max mb-16pt text-white">Fisologi Logo</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-white">Profile</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Fisologi logo</li>
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
                                    <img src="https://murnajati.jatimprov.go.id/assets/img/profil-instansi/visimisi.png" alt="Visi PKBM" style="width: 500px;">
                                </div>
                                <h4>Fisiologi Logo</h4>

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

                                <div class="page-separator">
                                    <div class="page-separator__text">Author</div>
                                </div>

                                <p class="text-70">Fueled by my passion for understanding the nuances of cross-cultural advertising, I consider myself a forever student, eager to both build on my academic foundations in psychology and sociology and stay in tune with the latest digital marketing strategies through continued coursework.</p>

                                <a href="teacher-profile.html"
                                   class="btn btn-white mb-24pt">Follow</a>

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
