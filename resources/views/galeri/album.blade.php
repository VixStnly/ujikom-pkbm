@include ('content.html')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PKBM</title>
    @include ('Page.Styles')

</head>

<body class="layout-sticky-subnav layout-default ">
    <div class="mdk-header-layout js-mdk-header-layout">
        @include('Page.Nav2')
        <div class="mdk-header-layout__content page-content ">

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">{{ $category->name }}</h2>

                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                                <li class="breadcrumb-item active">

                                    Learning Paths

                                </li>

                            </ol>

                        </div>
                    </div>

                    <div class="row"
                        role="tablist">
                        <div class="col-auto">
                            <a href="/gallery"
                                class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container page__container page-section">
                <div class="page-separator">
                    <div class="page-separator__text">Album:</div>
                </div>

                <div class="row card-group-row mb-lg-8pt">
                    @foreach ($galleries as $gallery)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top gallery-image" alt="Gallery Image" data-toggle="modal" data-target="#imageModal" data-image="{{ asset('storage/' . $gallery->image) }}" data-description="{{ $gallery->description }}">
                        </div>
                    </div>
                    @endforeach
                </div>

                <style>
                    .gallery-image {
                        height: 200px;
                        /* Set a fixed height */
                        object-fit: cover;
                        /* Maintain aspect ratio */
                        width: 100%;
                        /* Make the image fill the card */
                    }

                    .card {
                        display: flex;
                        /* Use flex to align items */
                        justify-content: center;
                        /* Center the image in the card */
                        align-items: center;
                        /* Center the image vertically */
                        overflow: hidden;
                        /* Hide overflow */
                    }
                </style>

            </div>
            @include ('Page.footer')
        </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#gallery').masonry({
                    itemSelector: '.gallery-item',
                    columnWidth: '.gallery-item',
                    horizontalOrder: true
                });
            });
        </script>
</body>