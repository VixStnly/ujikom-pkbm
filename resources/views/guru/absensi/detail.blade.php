<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Tambahkan meta untuk responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Siswa</title>
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

        .button-custom {
            background-color: #f56565;
            /* Warna merah khusus */
            color: white;
            border-radius: 8px;
            padding: 8px 16px;
            text-decoration: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .button-custom:hover {
            background-color: #c53030;
            /* Warna hover */
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
                            <h2 class="mb-0">Kehadiran</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item cursor-pointer"><a onclick="history.back()">Detail
                                        Pertemuan</a></li>
                                <li class="breadcrumb-item cursor-pointer"><a onclick="history.back()">Daftar Siswa</a>
                                </li>
                                <li class="breadcrumb-item active">Kehadiran Siswa</li>
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

            <div class="container mx-auto py-10">
                <div class="page-separator">
                    <div class="page-separator__text">Kehadiran {{ $siswa->name }}</div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-xl mb-6 border border-gray-300">
                        <thead class="bg-blue-500 text-slate-100 rounded-t-lg">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Nama Siswa</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal Absen</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Pertemuan</th>
                                <!-- Kolom baru untuk Meeting -->
                                <th class="px-6 py-3 text-left text-sm font-semibold">Status Kehadiran</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Foto</th>
<th class="px-6 py-3 text-left text-sm font-semibold">Lokasi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswa->absensi as $absen)
                                                    <tr class="hover:bg-gray-100 transition-colors duration-200 rounded-xl">
                                                        <td class="px-6 py-3 border-b border-gray-200 capitalize">{{ $siswa->name }}</td>
                                                        <td class="px-6 py-3 border-b border-gray-200">{{ $absen->tanggal_absen }}</td>
                                                        <td class="px-6 py-3 border-b border-gray-200">{{ $absen->meeting->title ?? 'N/A' }}
                                                        </td> <!-- Menampilkan nama meeting -->
                                                        <td class="px-6 py-3 border-b border-gray-200">
                                                            <span class="px-5 py-2 rounded-lg inline-block text-sm font-medium text-white 
                                            {{ 
                                                $absen->status == 'Hadir' ? 'border-green-500 bg-green-500' :
                                ($absen->status == 'Izin' ? 'border-yellow-500 bg-yellow-500' :
                                    ($absen->status == 'Tidak Hadir' ? 'border-red-500 bg-red-500' :
                                        ($absen->status == 'Sakit' ? 'border-blue-600 bg-blue-600' : '')))
                                            }}">
                                                                {{ $absen->status }}
                                                            </span>
                                                        </td>
                                                        <!-- Kolom Foto -->
                                                        <td class="px-6 py-3 border-b border-gray-200 text-sm">
    <button 
        onclick="showFotoModal('{{ asset('storage/' . $absen->foto) }}')" 
        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
        Foto
    </button>
</td>


<!-- Kolom Lokasi -->
<td class="px-6 py-3 border-b border-gray-200">
        <button onclick="showModal('{{ $absen->latitude }}', '{{ $absen->longitude }}', null)" class="button-custom text-sm">Lihat Lokasi</button>
    </td>

                                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-3 border-b border-gray-200 text-center">Belum ada data
                                        absensi.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mb-32pt">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $absensi->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $absensi->previousPageUrl() }}" aria-label="Previous" {{ $absensi->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $absensi->lastPage(); $i++)
                            <li class="page-item {{ $i == $absensi->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $absensi->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $absensi->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $absensi->nextPageUrl() }}" aria-label="Next" {{ !$absensi->hasMorePages() ? 'tabindex="-1"' : '' }}>
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
<!-- Modal -->
<!-- Modal -->
<div id="absenModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">✖</button>
        <div id="modalContent" class="space-y-4 text-center">
            <!-- Content diisi oleh JS -->
        </div>
    </div>
</div>
<!-- Modal Foto -->
<div id="fotoModal" class="fixed z-50 inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-5 rounded shadow-lg max-w-md w-full relative">
        <button onclick="closeFotoModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        <img id="fotoModalImage" src="" alt="Foto Absen" class="w-full rounded">
    </div>
</div>
<script>
      function showFotoModal(fotoUrl) {
        document.getElementById('fotoModalImage').src = fotoUrl;
        document.getElementById('fotoModal').classList.remove('hidden');
        document.getElementById('fotoModal').classList.add('flex');
    }

    function closeFotoModal() {
        document.getElementById('fotoModal').classList.add('hidden');
        document.getElementById('fotoModal').classList.remove('flex');
        document.getElementById('fotoModalImage').src = '';
    }
    function showModal(lat, lng, photoUrl) {
        const modal = document.getElementById("absenModal");
        const content = document.getElementById("modalContent");
        let html = '';

        if (photoUrl) {
            html += `
                <div>
                    <h2 class="text-lg font-semibold mb-2">Foto Absensi</h2>
                    <img src="${photoUrl}" alt="Foto Absensi" class="mx-auto max-h-64 rounded border border-gray-300 mb-4">
                </div>
            `;
        }

        if (lat && lng) {
            const mapEmbed = `https://www.google.com/maps?q=${lat},${lng}&output=embed`;
            html += `
                <div>
                    <h2 class="text-lg font-semibold mb-2">Lokasi</h2>
                    <iframe
                        width="100%"
                        height="300"
                        style="border:0"
                        loading="lazy"
                        allowfullscreen
                        src="${mapEmbed}">
                    </iframe>
                </div>
            `;
        }

        content.innerHTML = html;
        modal.classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("absenModal").classList.add("hidden");
    }
</script>


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