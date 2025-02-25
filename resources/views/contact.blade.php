<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>PKBM</title>

    @include('Page.Styles')
</head>

<body class="layout-sticky-subnav layout-default bg-light">
    @include('layouts.preloader')
    @include('Page.navContact')

    <div class="container py-5" style="margin-top: 40px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="h4 font-weight-bold text-success mb-3">Hubungi Kami</h1>
                        <p class="text-muted mb-4">Kami terbuka untuk saran atau sekadar mengobrol.</p>

                        <!-- Check for success message -->
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Form to send a message -->
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Anda</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Anda</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subjek</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Pesan Anda</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm mt-4 mt-md-0">
                    <div class="card-body">
                        <h1 class="h4 font-weight-bold text-success mb-3">Alamat Kami</h1>
                        <p class="text-muted mb-4">Kunjungi kami di kantor kami.</p>
                        <p class="mb-2">Komplek Pesona Ancaran B10, Ancaran, Kuningan - Jawa Barat</p>
                        <p class="mb-2">Telepon: +62 813 8904 0141</p>
                        <p>Email: <a href="mailto:admin@pkbmtriwala.sch.id" class="text-success">admin@pkbmtriwala.sch.id</a></p>
                    </div>
                </div>

                <!-- Map Card -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h1 class="h4 font-weight-bold text-success mb-3">Lokasi Kami</h1>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.378544370483!2d108.51235777365014!3d-6.96459276818869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f179d2edee8c7%3A0x8218444f7afe14cb!2sTK%20Triwala!5e0!3m2!1sen!2sid!4v1730441931716!5m2!1sen!2sid"
                            width="100%" 
                            height="250" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('Page.footer')

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

    <script>
        (function () {
            'use strict';
            var headerNode = document.querySelector('.mdk-header')
            var layoutNode = document.querySelector('.mdk-header-layout')
            var componentNode = layoutNode ? layoutNode : headerNode
            componentNode.addEventListener('domfactory-component-upgraded', function () {
                headerNode.mdkHeader.eventTarget.addEventListener('scroll', function () {
                    var progress = headerNode.mdkHeader.getScrollState().progress
                    var navbarNode = headerNode.querySelector('#default-navbar')
                    navbarNode.classList.toggle('bg-transparent', progress <= 0.2)
                })
            })
        })()
    </script>

</body>

</html>
