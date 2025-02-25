<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @include('content.style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .table-responsive {
            overflow: hidden; /* Prevents scrolling */
        }
            /* Custom dropdown positioning */
        .dropdown-above .dropdown-menu {
            bottom: 100%; /* Position above the button */
            transform: translateY(-10px); /* Adjust as needed */
            display: block; /* Ensure it's displayed properly */
        }
    </style>
</head>

<body class="layout-sticky-subnav layout-learnly">
    @include('layouts.preloader')
    @include('layouts.NavSiswa')
    @include('content.sidemenu')

    <!-- Content -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">Histori Absen Anda</h1>
                            <div>
                                <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                    data-toggle="tooltip" data-title="Experience IQ" data-placement="bottom">
                                    <i class="material-icons icon--left">class</i>
                                    @if($user->kelas->isEmpty())
                                        <span>Tidak memiliki kelas</span>
                                    @else
                                        @foreach($user->kelas as $kelas)
                                            {{ $kelas->name }}
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="ml-lg-16pt">
                            <a href="/profile" class="btn btn-light">My Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-section">
                <div class="container page__container">
                    <!-- Basic Bootstrap Table -->
                    <div class="card">
                        <h5 class="card-header">Tabel Informasi</h5>
                        <div class="table-responsive text-nowrap">
                        <table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelajaran</th>
            <th>Pertemuan</th>
            <th>Status</th>
            <th>Tanggal Absen</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($absensi as $absen)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                <strong>{{ optional(optional($absen->meeting)->subject)->name ?? 'Mata pelajaran tidak ditemukan' }}</strong>
                </td>
                <td><strong>{{ $absen->meeting->title ?? 'Meeting tidak ditemukan' }}</strong></td>
                <td>{{ $absen->status }}</td>
                <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d-m-Y | H:i:s') }}</td>
                </tr>
        @endforeach
    </tbody>
</table>

                        </div>
                    </div>
                    <!--/ Basic Bootstrap Table -->
                </div>
            </div>

        </div>
        <!-- // END Header Layout Content -->
        @include('Page.footer')
    </div>
    <!-- End Content -->

    @include('content.js')

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
