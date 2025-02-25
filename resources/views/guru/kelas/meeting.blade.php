<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Tambahkan meta untuk responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pertemuan</title>
    <!-- Tambahkan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            @include('guru.navbar')

            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-2">Detail Pertemuan - <span
                                    class="font-bold text-blue-700">{{ $kelas->name }}</span></h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item active">Detail Pertemuan</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('guru.kelas.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten utama -->

            <div class="container mx-auto py-10">
                @if($meetings->isEmpty())
                <div class="alert alert-secondary mb-3" role="alert">
                    <div class="d-flex align-items-start">
                        <div class="me-2">
                            <i class="material-icons toggle-info">info</i>
                        </div>
                        <div class="flex" style="min-width: 180px; margin-top: 3px;">
                            <small class="text-black-100">
                                Tidak ada pertemuan yang tersedia untuk kelas ini.
                            </small>
                        </div>
                    </div>
                </div>
                @else
                <div class="page-separator">
                    <div class="page-separator__text">Pertemuan Di Kelas {{ $kelas->name }}</div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

                    @foreach ($meetings as $meeting)
                    <div class="bg-white shadow-lg rounded-lg p-4 mb-4 hover:shadow-xl transition-shadow duration-200">
                        <h3 class="text-lg font-semibold text-custom-blue">{{ $meeting->title }}</h3>
                        <p class=""><strong>Tanggal:</strong>
                            {{ \Carbon\Carbon::parse($meeting->meeting_time)->locale('id')->translatedFormat('d F Y') }}
                        </p>
                        <p class="mb-4"><strong>Waktu:</strong>
                            {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}
                        </p>

                        <!-- Tombol untuk melihat siswa yang hadir di pertemuan ini -->
                        <a href="{{ route('guru.kelas.siswa', ['kelas' => $kelas->id, 'meetingId' => $meeting->id]) }}"
                            class="py-2 px-4 rounded w-full text-center text-white bg-success hover:bg-green-500 transition duration-300">
                            Lihat Siswa yang Hadir
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Pagination -->
                <div class="mb-32pt">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $meetings->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $meetings->previousPageUrl() }}" aria-label="Previous" {{ $meetings->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $meetings->lastPage(); $i++)
                            <li class="page-item {{ $i == $meetings->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $meetings->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                            @endfor

                            <!-- Next Button -->
                            <li class="page-item {{ $meetings->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $meetings->nextPageUrl() }}" aria-label="Next" {{ !$meetings->hasMorePages() ? 'tabindex="-1"' : '' }}>
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

    <!-- JavaScript dependencies -->
    <script src="{{ asset('frontend/vendor/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/dom-factory.js')}}"></script>
    <script src="{{ asset('frontend/vendor/material-design-kit.js')}}"></script>
    <script src="{{ asset('frontend/js/app.js')}}"></script>
    <script src="{{ asset('frontend/js/preloader.js')}}"></script>
    <script src="{{ asset('frontend/js/settings.js')}}"></script>
    <script src="{{ asset('frontend/vendor/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('frontend/js/flatpickr.js')}}"></script>
    <script src="{{ asset('frontend/vendor/moment.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js')}}"></script>
    <script src="{{ asset('frontend/vendor/Chart.min.js')}}"></script>
    <script src="{{ asset('frontend/js/chartjs.js')}}"></script>
    <script src="{{ asset('frontend/js/page.student-dashboard.js')}}"></script>
    <script src="{{ asset('frontend/vendor/list.min.js')}}"></script>
    <script src="{{ asset('frontend/js/list.js')}}"></script>
    <script src="{{ asset('frontend/js/toggle-check-all.js')}}"></script>
    <script src="{{ asset('frontend/js/check-selected-row.js')}}"></script>

</body>

</html>