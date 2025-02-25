<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
</head>

<body class="layout-app ">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')
            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Tambah Tugas Baru</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item active">Tambah Tugas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Content -->
            <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Tambah Tugas</div>
                                </div>
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Judul Tugas"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="4"
                                            placeholder="Deskripsi Tugas" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tenggat Waktu</label>
                                        <input type="date" name="tanggal_deadline" class="form-control" required>
                                    </div>

                                    <!-- Menampilkan daftar pertemuan -->
                                    <div class="form-group">
                                        <label class="form-label">Pertemuan</label>

                                        <!-- Tampilkan pertemuan yang di-klik -->
                                        <input type="text" class="form-control" value="{{ $meeting->title }}" readonly>
                                        <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">

                                        <!-- Jika pertemuan tidak ditemukan, tampilkan pesan (opsional) -->
                                        @if(!$meeting)
                                            <p class="text-muted">Tidak ada pertemuan yang tersedia.</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="formFileMultiple" class="form-label">File (optional)</label>
                                        <input class="form-control" type="file" id="formFileMultiple" name="file" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <label class="form-label">Link (Opsional)</label>
                                        <input type="url" name="link" class="form-control" placeholder="Link Tugas">
                                        <small class="form-text text-muted">Tambahkan Link terkait materi ini.</small>
                                    </div>

                                    <div class="card-footer d-flex">
                                        <button type="submit" class="btn btn-primary ml-3">Tambah Tugas</button>
                                        <a href="{{ route('guru.meeting.index') }}"
                                            class="btn btn-secondary ml-3">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


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

    <script src="{{ asset('assets/js/form-basic-inputs.js')}}"></script>

</body>

</html>