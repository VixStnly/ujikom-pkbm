<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>

    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')

            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item active">Daftar Siswa</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a onclick="history.back()" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten utama -->
            <div class="container mx-auto py-6">
                <h2 class="text-2xl font-bold mb-4">Edit Tugas</h2>

                <form action="{{ route('guru.reports.laporan.update', $tugas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="score" class="block text-gray-700">Nilai:</label>
                        <input type="number" name="score" id="score" value="{{ $tugas->score }}"
                            class="border rounded p-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="feedback" class="block text-gray-700">Feedback:</label>
                        <textarea name="feedback" id="feedback"
                            class="border rounded p-2 w-full">{{ $tugas->feedback }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Simpan</button>
                </form>


                <!-- Pagination -->
                <div class="mb-32pt mt-6">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <li class="page-item {{ $tugas->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $tugas->previousPageUrl() }}" aria-label="Previous" {{ $tugas->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        @for ($i = 1; $i <= $tugas->lastPage(); $i++)
                            <li class="page-item {{ $i == $tugas->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $tugas->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <li class="page-item {{ $tugas->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $tugas->nextPageUrl() }}" aria-label="Next" {{ !$tugas->hasMorePages() ? 'tabindex="-1"' : '' }}>
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