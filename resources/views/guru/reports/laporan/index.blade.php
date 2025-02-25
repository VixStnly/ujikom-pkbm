<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="layout-app">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')

            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Laporan</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.reports.siswa', ['kelasId' => $kelasId]) }}}">Daftar Siswa</a></li>
                                <li class="breadcrumb-item active">Laporan</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('guru.reports.laporan.create', ['studentId' => $student->id, 'kelasId' => $kelasId]) }}"
                                class="btn btn-outline-secondary">Buat atau Edit Laporan</a>
                        </div>
                        <div class="col-auto">
                            <a onclick="history.back()" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold mb-4">Laporan Nilai - {{ $student->name }}</h1>

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Mata Pelajaran - Guru</th>
                            <th class="py-2 px-4 border-b">Pertemuan</th>
                            <th class="py-2 px-4 border-b">Nilai</th>
                            <th class="py-2 px-4 border-b">Feedback</th>
                            <th class="py-2 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td class="py-2 px-4 border-b"> {{ $report->subject->name }} - {{ $report->subject->user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $report->meeting_title }}</td>
                                <td class="py-2 px-4 border-b">{{ $report->score }}</td>
                                <td class="py-2 px-4 border-b">{{ $report->feedback }}</td>
                                <td class="py-2 px-4 border-b">
                                    <!-- Button to trigger modal with report ID -->
                                    <button class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded"
                                        onclick="openDeleteModal({{ $report->id }}, '{{ $student->id }}', '{{ $kelasId }}')">Hapus</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('guru.footer')
        </div>
        @include('layouts.sidebarGuru')
    </div>

    <!-- SweetAlert2 Modal Script -->
    <script>
        // Function to open the SweetAlert2 modal with slide-up animation
        function openDeleteModal(reportId, studentId, kelasId) {
            // SweetAlert2 modal with slide-up animation
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus laporan ini?",
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'animate__animated animate__slideInUp' // Add slide-in-up animation
                },
                // Execute delete logic when confirmed
                preConfirm: () => {
                    // Kirim permintaan AJAX untuk menghapus laporan
                    return fetch(`/guru/reports/${reportId}/destroy/${studentId}/${kelasId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal menghapus laporan');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Jika penghapusan berhasil, tampilkan pesan sukses dan refresh halaman
                            Swal.fire('Dihapus!', 'Laporan berhasil dihapus.', 'success')
                                .then(() => {
                                    location.reload();
                                });
                        })
                        .catch(error => {
                            // Jika terjadi error, tampilkan pesan error
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus laporan.', 'error');
                        });
                }
            });
        }
    </script>


    <!-- JavaScript -->
    <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/dom-factory.js') }}"></script>
    <script src="{{ asset('frontend/vendor/material-design-kit.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script src="{{ asset('frontend/js/preloader.js') }}"></script>
    <script src="{{ asset('frontend/js/settings.js') }}"></script>
    <script src="{{ asset('frontend/vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/flatpickr.js') }}"></script>
    <script src="{{ asset('frontend/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js') }}"></script>
    <script src="{{ asset('frontend/vendor/Chart.min.js') }}"></script>
    <script src="{{ asset('frontend/js/chartjs.js') }}"></script>
    <script src="{{ asset('frontend/js/page.student-dashboard.js') }}"></script>
    <script src="{{ asset('frontend/vendor/list.min.js') }}"></script>
    <script src="{{ asset('frontend/js/list.js') }}"></script>
    <script src="{{ asset('frontend/js/toggle-check-all.js') }}"></script>
    <script src="{{ asset('frontend/js/check-selected-row.js') }}"></script>
</body>

</html>