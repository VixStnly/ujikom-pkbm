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

            <div class="pt-8">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Riwayat</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.history.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item active">Daftar Siswa</li>
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
                    <div class="page-separator__text">Daftar Siswa</div>
                </div>
                @if(isset($students) && count($students) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white text-gray-700 border border-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-3 px-4 text-left font-medium">Nama</th>
                                    <th class="py-3 px-4 text-left font-medium">Email</th>
                                    <th class="py-3 px-4 text-left font-medium">NISN</th>
                                    <th class="py-3 px-4 text-left font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 border-b">{{ $student->name }}</td>
                                        <td class="py-3 px-4 border-b">{{ $student->email }}</td>
                                        <td class="py-3 px-4 border-b">{{ $student->nisn_nip ?? 'Tidak tersedia' }}</td>
                                        <td class="py-3 px-4 border-b">
                                            <a href="{{ route('guru.history.siswa.index', ['studentId' => $student->id, 'kelasId' => $kelasId]) }}"
                                                class="text-indigo-600 hover:text-indigo-800">Lihat Histori</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Belum ada siswa yang terdaftar di kelas ini.</p>
                @endif

                <!-- Pagination -->
                <div class="mb-32pt mt-6">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $students->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $students->previousPageUrl() }}" aria-label="Previous" {{ $students->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $students->lastPage(); $i++)
                            <li class="page-item {{ $i == $students->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $students->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $students->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $students->nextPageUrl() }}" aria-label="Next" {{ $students->hasMorePages() ? '' : 'tabindex="-1"' }}>
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