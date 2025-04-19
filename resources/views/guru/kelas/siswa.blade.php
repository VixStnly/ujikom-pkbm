<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Tambahkan meta untuk responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa Kelas</title>
    <!-- Tambahkan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <style>
        /* Pastikan untuk menargetkan hanya tombol ini */
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
                            <h2 class="mb-0">Daftar Siswa - <span
                                    class="font-bold text-blue-700">{{ $kelas->name }}</span></h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item cursor-pointer"><a onclick="history.back()">Detail
                                        Pertemuan</a></li>
                                <li class="breadcrumb-item active">Daftar Siswa</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        
    <div class="col-auto flex ">
    <a href="{{ route('guru.siswa.export', ['kelas_id' => $kelas->id, 'meeting_id' => $meeting->id ?? 0]) }}"
            class="btn btn-success mr-4 ">
            Export Excel
        </a>
        <a onclick="history.back()" class="btn btn-outline-secondary ">Kembali</a>
    </div>
    
</div>
                  <div class="row" role="tablist">
  

                </div>
                </div>
            </div>

            <!-- Konten utama -->
            <div class="container mx-auto py-10">

                <!-- Tanggal Absen -->
                <div class="page-separator">
                    <div class="page-separator__text">Siswa Di Pertemuan {{ $meeting->title ?? 'N/A' }} </div>
                </div>

                <!-- Tabel siswa -->
                <!-- Tabel siswa -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mb-6">
                        <thead class="bg-blue-500 text-slate-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Nama Siswa</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Kehadiran</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Waktu Kehadiran</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Kelas</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $item)
                                <tr class="hover:bg-gray-100 transition-colors duration-200">
                                    <td class="px-6 py-3 border-b border-gray-200">{{ $item->name }}</td>
                                    <td class="px-6 py-3 border-b border-gray-200">{{ $item->email }}</td>

                                    <!-- Menampilkan Status Absensi -->
                                    <td class="px-6 py-3 border-b border-gray-200">
                                        @if($item->absensi->isNotEmpty())
                                            {{ $item->absensi->first()->status ?? 'Belum ada data' }}
                                        @else
                                            Belum ada data
                                        @endif
                                    </td>

                                    <!-- Menampilkan Tanggal Absensi -->
                                    <td class="px-6 py-3 border-b border-gray-200">
                                        @if($item->absensi->isNotEmpty())
                                            {{ $item->absensi->first()->tanggal_absen ?? 'Belum ada data' }}
                                        @else
                                            Belum ada data
                                        @endif
                                    </td>

                                    <td class="px-6 py-3 border-b border-gray-200">{{ $kelas->name }}</td>

                                    <!-- Tombol Lihat Detail Absensi -->
                                    <td class="px-6 py-2 border-b border-gray-200">
                                        <a href="{{ route('guru.absensi.detail', ['id' => $item->id]) }}"
                                            class="btn btn-warning text-xs py-2 px-2 rounded-lg">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="mb-32pt">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $siswa->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $siswa->previousPageUrl() }}" aria-label="Previous" {{ $siswa->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $siswa->lastPage(); $i++)
                            <li class="page-item {{ $i == $siswa->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $siswa->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $siswa->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $siswa->nextPageUrl() }}" aria-label="Next" {{ !$siswa->hasMorePages() ? 'tabindex="-1"' : '' }}>
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