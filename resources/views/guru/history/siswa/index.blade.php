<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="layout-app">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')
            <div class="pt-8">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Riwayat - {{ $student->name }}</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.history.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('guru.history.siswa', ['kelasId' => $kelasId]) }}">Daftar
                                        Siswa</a></li>
                                <li class="breadcrumb-item active">Riwayat</li>
                            </ol>
                        </div>
                    </div>

                    <div class="ml-auto">
                        <button onclick="history.back()" class="btn btn-outline-secondary">Kembali</button>
                    </div>
                </div>
            </div>

            <!-- Konten utama -->
            <div class="container mx-auto py-6">
                <div class="page-separator">
                    <div class="page-separator__text">Riwayat Pengumpulan Tugas {{ $student->name }}</div>
                </div>
                <table class="min-w-full bg-white border border-gray-600 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 rounded-lg">
                            <th class="py-3 px-6 border-b text-left">Mata Pelajaran</th>
                            <th class="py-3 px-6 border-b text-left">Pertemuan</th>
                            <th class="py-3 px-6 border-b text-left">Tugas</th>
                            <th class="py-3 px-6 border-b text-left">Judul Tugas Siswa</th>
                            <th class="py-3 px-6 border-b text-left">Nilai</th>
                            <th class="py-3 px-6 border-b text-left">Tanggal Diserahkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historyData as $data)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-6 border-b text-gray-800">
                                    {{ $data->submission->tugas->meeting->subject->name ?? 'N/A' }}
                                </td>
                                <td class="py-3 px-6 border-b text-gray-800">
                                    {{ $data->submission->tugas->meeting->title ?? 'N/A' }}</td>
                                <td class="py-3 px-6 border-b text-gray-800">{{ $data->submission->tugas->judul ?? 'N/A' }}
                                </td>
                                <td class="py-3 px-6 border-b text-gray-800">{{ $data->submission->judul ?? 'N/A' }}</td>
                                <td class="py-3 px-6 border-b text-gray-800">{{ $data->nilai }}</td>
                                <td class="py-3 px-6 border-b text-gray-800">
                                    {{ \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-gray-100">
                                <td colspan="6" class="py-3 px-6 text-center text-gray-500">Tidak ada data untuk siswa ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="mb-32pt mt-6">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $historyData->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $historyData->previousPageUrl() }}" aria-label="Previous" {{ $historyData->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $historyData->lastPage(); $i++)
                            <li class="page-item {{ $i == $historyData->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $historyData->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $historyData->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $historyData->nextPageUrl() }}" aria-label="Next" {{ $historyData->hasMorePages() ? '' : 'tabindex="-1"' }}>
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

    <!-- JavaScript -->
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