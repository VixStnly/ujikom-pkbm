<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Kelas - Pelajaran</title>
</head>

<body class="layout-app">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Mata Pelajaran</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item active">Mata Pelajaran</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container page__container page-section">
                <div class="page-separator">
                    <div class="page-separator__text">Mata Pelajaran di Kelas {{ $kelas->name }}</div>
                </div>

                @if($subjects->isEmpty())
                    <div class="text-center text-gray-600">
                        <p>Belum ada mata pelajaran yang tersedia.</p>
                    </div>
                @else
                    <div class="row">
                        @foreach($subjects as $subject)
                            <div class="col-md-4 mb-4"> <!-- Ubah dari col-md-6 menjadi col-md-4 -->
                                <div
                                    class="bg-white shadow-lg rounded-lg p-3 transition-transform transform hover:scale-105 border border-gray-300">
                                    <!-- Ganti p-4 menjadi p-3 untuk ukuran lebih kecil -->
                                    <img src="{{ asset('storage/pelajaran/' . $subject->image) }}" alt="{{ $subject->name }}"
                                        class="img-fluid rounded-top" style="height: 150px; object-fit: cover;">
                                    <!-- Ubah height dari 200px menjadi 150px -->
                                    <div class="p-2"> <!-- Ganti p-3 menjadi p-2 untuk ukuran lebih kecil -->
                                        <h3 class="text-md font-bold text-gray-800">{{ $subject->name }}</h3>
                                        <!-- Ubah text-lg menjadi text-md -->
                                        <p class="text-gray-600 mb-4">Deskripsi: <span
                                                class="text-gray-800">{{ $subject->description }}</span></p>
                                        <!-- Tombol untuk halaman meeting -->
                                        <a href="{{ route('guru.kelas.meeting', ['kelas' => $kelas->id, 'subject' => $subject->id]) }}"
                                            class="btn btn-success btn-sm"> <!-- Tambahkan btn-sm untuk tombol lebih kecil -->
                                            Lihat Pertemuan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="mb-32pt">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $subjects->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $subjects->previousPageUrl() }}" aria-label="Previous" {{ $subjects->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $subjects->lastPage(); $i++)
                            <li class="page-item {{ $i == $subjects->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $subjects->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $subjects->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $subjects->nextPageUrl() }}" aria-label="Next" {{ !$subjects->hasMorePages() ? 'tabindex="-1"' : '' }}>
                                <span>Next</span>
                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @include('guru.footer')
        </div>
        @include('layouts.sidebarGuru')
    </div>

    <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/dom-factory.js') }}"></script>
    <script src="{{ asset('frontend/vendor/material-design-kit.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script src="{{ asset('frontend/js/preloader.js') }}"></script>
    <script src="{{ asset('frontend/js/settings.js') }}"></script>
    <script src="{{ asset('frontend/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js') }}"></script>
    <script src="{{ asset('frontend/vendor/Chart.min.js') }}"></script>
    <script src="{{ asset('frontend/js/chartjs-rounded-bar.js') }}"></script>
    <script src="{{ asset('frontend/js/chartjs.js') }}"></script>
    <script src="{{ asset('frontend/js/page.instructor-dashboard.js') }}"></script>
    <script src="{{ asset('frontend/vendor/list.min.js') }}"></script>
    <script src="{{ asset('frontend/js/list.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>