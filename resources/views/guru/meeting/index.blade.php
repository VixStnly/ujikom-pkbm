<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <style>
        .toast-success {
            background-color: #28a745 !important; /* Success color */
            color: white !important; /* Text color */
        }
        .toast-error {
            background-color: #dc3545 !important; /* Error color */
            color: white !important; /* Text color */
        }
        .toast-warning {
            background-color: #ffc107 !important; /* Warning color */
            color: black !important; /* Text color */
        }
        .toast-info {
            background-color: #17a2b8 !important; /* Info color */
            color: white !important; /* Text color */
        }

        .scroll-container {
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent wrapping of inline elements */
            padding: 0 10px; /* Add padding to avoid touching the edges */
        }
    </style>
</head>

<body class="layout-app ">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')
            @include('guru.meeting.content')
            @include('guru.footer')
        </div>
        @include('layouts.sidebarGuru')

    </div>

    <!-- JavaScript -->
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
    <script src="{{ asset('frontend/js/app.js')}}"></script>

    <!-- Preloader -->
    <script src="{{ asset('frontend/js/preloader.js')}}"></script>

    <!-- Global Settings -->
    <script src="{{ asset('frontend/js/settings.js')}}"></script>

    <!-- Flatpickr -->
    <script src="{{ asset('frontend/vendor/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('frontend/js/flatpickr.js')}}"></script>

    <!-- Moment.js -->
    <script src="{{ asset('frontend/vendor/moment.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js')}}"></script>

    <!-- Chart.js -->
    <script src="{{ asset('frontend/vendor/Chart.min.js')}}"></script>
    <script src="{{ asset('frontend/js/chartjs.js')}}"></script>

    <!-- Chart.js Samples -->
    <script src="{{ asset('frontend/js/page.student-dashboard.js')}}"></script>

    <!-- List.js -->
    <script src="{{ asset('frontend/vendor/list.min.js')}}"></script>
    <script src="{{ asset('frontend/js/list.js')}}"></script>

    <!-- Tables -->
    <script src="{{ asset('frontend/js/toggle-check-all.js')}}"></script>
    <script src="{{ asset('frontend/js/check-selected-row.js')}}"></script>

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

                    <!-- Toastr -->
                    <script src="{{ asset('frontend/vendor/toastr.min.js')}}"></script>
        <script src="{{ asset('frontend/js/toastr.js')}}"></script>


</body>

</html>