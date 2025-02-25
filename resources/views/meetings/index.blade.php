<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
</head>

<body class="layout-sticky-subnav layout-learnly">
    @include('layouts.preloader')
    <nav class="navbar">
    @include('layouts.NavSiswa')
</nav>

<style>
    .navbar {
    z-index: 10; /* or higher, depending on your layout */
}
    .sidemenu {
    z-index: 11; /* or higher, depending on your layout */
}

</style>
<div class="sidemenu">
    @include('content.sidemenu') <!-- Include this -->
</div>
    @include('meetings.content')
    @include('content.js')

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset(path: 'assets/vendor/js/menu.js')}}"></script>

</body>

</html>
