<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico')}}" />
</head>

<body class="layout-app ">
    @include('layouts.preloader')

    <!-- Drawer Layout -->

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')
            @include('guru.content')
            @include('guru.footer')
        </div>
        @include('layouts.sidebarGuru')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('frontend/vendor/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js')}}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js')}}"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('frontend/vendor/dom-factory.js')}}"></script>

    <!-- MDK -->
    <script src="{{ asset('frontend/vendor/material-design-kit.js')}}"></script>

    <!-- App JS -->
    <script src="{{asset('frontend/js/app.js')}}"></script>

    <!-- Preloader -->
    <script src="{{ asset('frontend/js/preloader.js')}}"></script>

    <!-- Global Settings -->
    <script src="{{ asset('frontend/js/settings.js')}}"></script>

    <!-- Moment.js -->
    <script src="{{ asset('frontend/vendor/moment.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js')}}"></script>

    <!-- Chart.js -->
    <script src="{{ asset('frontend/vendor/Chart.min.js')}}"></script>

    <!-- UI Charts Page JS -->
    <script src="{{ asset('frontend/js/chartjs-rounded-bar.js')}}"></script>
    <script src="{{ asset('frontend/js/chartjs.js')}}"></script>

    <!-- Chart.js Samples -->
    <script src="{{ asset('frontend/js/page.instructor-dashboard.js')}}"></script>

    <!-- List.js -->
    <script src="{{ asset('frontend/vendor/list.min.js')}}"></script>
    <script src="{{ asset('frontend/js/list.js')}}"></script>

</body>

</html>