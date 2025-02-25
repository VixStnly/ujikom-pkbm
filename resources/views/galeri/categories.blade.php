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
    @include ('galeri.navigasi')
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">

                <div class="text-center d-flex align-items-center flex-wrap mb-32pt"
                    style="white-space: nowrap;">
                    <h5 class="mr-24pt mb-md-0 d-md-inline-block">Album Galeri</h5>
                    <a href=""
                    class="chip mb-16pt mb-md-0 chip-secondary">Terbaru</a>
                    <a href=""
                    class="chip mb-16pt mb-md-0 chip-outline-secondary">2023</a>
                    <a href=""
                    class="chip mb-16pt mb-md-0 chip-outline-secondary">2022-2020</a>
                </div>

                <div class="row card-group-row">
                    @foreach ($categories as $category)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm" style="min-height: 140px;">
                                <div class="card-body text-center" style="padding: 2rem;">
                                    <h5 class="card-title text-lg font-weight-bold text-gray-800">{{ $category->name }}</h5>
                                    <p class="card-text text-gray-600">Klik tombol lihat album untuk melihat album dari {{ $category->name }}</p>
                                    <a href="{{ url('/gallery/album/' . $category->id) }}" class="btn btn-outline-secondary">Lihat Album</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

     

            </div>
        </div>
        </div>
<!-- // END Header Layout Content -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

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