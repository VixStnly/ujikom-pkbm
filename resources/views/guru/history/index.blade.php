<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="layout-app ">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')

            @if(session('message'))
                <div class="alert alert-info">{{ session('message') }}</div>
            @endif


            <div class="pt-8">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Riwayat</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item active">Kelas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container mx-auto py-6">
                <div class="page-separator">
                    <div class="page-separator__text">Daftar Kelas</div>
                </div>
                @if(isset($kelas) && $kelas->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($kelas as $kelasItem)
                            <div class="bg-white shadow-md rounded-lg p-4">
                                <h3 class="text-xl font-semibold mb-2">{{ $kelasItem->name }}</h3>
                                <p class="text-gray-700">Jumlah Siswa: {{ $kelasItem->users->count() }}</p>
                                <a href="{{ route('guru.history.siswa', ['kelasId' => $kelasItem->id]) }}"
                                    class="text-blue-500 hover:underline">Lihat Siswa</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Tidak ada kelas yang tersedia.</p>
                @endif
            </div>
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


</body>

</html>