<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @include('content.style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <style>
        .table-responsive {
            overflow: hidden; /* Prevents scrolling */
        }

        /* Optional custom styling to align items vertically within each cell */
        .table td {
            vertical-align: middle;
        }

        .table .cell-content {
            display: flex;
            flex-direction: column; /* Stack items vertically */
            align-items: flex-start; /* Align to the start of the cell */
            gap: 4px; /* Space between elements */
        }

        .btn-small {
            font-size: 12px;
            padding: 4px 8px; /* Small padding to fit better */
        }

        .btn-outline-dark {
            color: #343a40; /* Default text color */
        }

        .btn-outline-dark:hover {
            background-color: #343a40; /* Change background on hover */
            color: white; /* Change text color on hover */
        }

        .btn-outline-dark:focus,
        .btn-outline-dark:active {
            color: #343a40; /* Text color when button is active */
            background-color: transparent; /* Set background when active */
        }
    </style>
</head>

<body class="layout-sticky-subnav layout-learnly">
    @include('layouts.preloader')
    @include('layouts.NavSiswa')
    @include('content.sidemenu')

    <!-- Content -->
    <div class="mdk-header-layout js-mdk-header-layout">
        <div class="mdk-header-layout__content page-content">
            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">Histori Tugas Anda</h1>
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
                    <!-- Tugas Yang Telah Anda Kumpulkan -->
                    <div class="card">
                        <h5 class="card-header">
                            Tugas Yang Telah Anda Kumpulkan
                            <button class="btn btn-light float-right" id="view-all-tasks-btn" onclick="toggleAllTasks()">
                                Lihat Semua Tugas
                            </button>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;">Pelajaran</th>
                                        <th style="width: 15%;">Pertemuan</th>
                                        <th style="width: 20%;">Nama Tugas</th>
                                        <th style="width: 20%;">Tugas Anda</th>
                                        <th style="width: 15%;">Status</th>
                                        <th style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach($submissions as $submission)
                                        <tr>
                                            <td>
                                                <div class="cell-content">{{ optional(optional($submission->tugas)->meeting)->subject->name ?? 'Mata pelajaran tidak ditemukan' }}</div>
                                            </td>
                                            <td>
                                                <div class="cell-content">
                                                    <strong>{{ optional($submission->tugas)->judul ?? 'Tugas tidak ditemukan' }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cell-content">{{ $submission->judul }}</div>
                                            </td>
                                            <td>
                                                <div class="cell-content">
                                                    @if($submission->file && file_exists(storage_path('app/public/' . $submission->file)))
                                                        <a href="{{ asset('storage/' . $submission->file) }}" class="badge bg-label-primary me-1" download>Download File</a>
                                                    @else
                                                        <span class="badge bg-label-danger">File tidak ditemukan</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cell-content">
                                                    <span class="badge bg-label-{{ $submission->file ? 'success' : 'warning' }}">
                                                        {{ $submission->file ? 'Sudah Dikerjakan' : 'Belum Dikerjakan' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cell-content">
                                                    <button class="btn btn-outline-dark btn-small" onclick="showScore({{ $submission->id }})">Lihat Nilai</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tugas Semua -->
                    <div class="card collapse" id="all-tugas">
                        <h5 class="card-header">Semua Tugas</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Pelajaran</th>
                                        <th style="width: 20%;">Nama Tugas</th>
                                        <th style="width: 15%;">Status</th>
                                        <th style="width: 20%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach($tugas as $task)
                                        <tr>
                                            <td>
                                                <div class="cell-content">{{ optional($task->meeting)->subject->name ?? 'Mata pelajaran tidak ditemukan' }}</div>
                                            </td>
                                            <td>
                                                <div class="cell-content">{{ $task->judul }}</div>
                                            </td>
                                            <td>
                                                <div class="cell-content">
                                                    <span class="badge bg-label-{{ $task->submissions()->where('user_id', $user->id)->exists() ? 'success' : 'warning' }}">
                                                        {{ $task->submissions()->where('user_id', $user->id)->exists() ? 'Sudah Dikerjakan' : 'Belum Dikerjakan' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cell-content">
                                                    <a href="/submit/tugas/{{ $task->id }}" class="btn btn-outline-primary btn-small">Submit</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('Page.footer')
    </div>

    @include('content.js')
    <script>
        function showScore(submissionId) {
                fetch(`/submission/${submissionId}/score`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Nilai Anda',
                                html: `<p style="font-size: 2rem; font-weight: bold;">${data.score.nilai}</p>
                                       <p><strong>Keterangan:</strong> ${data.score.keterangan || 'Tidak ada keterangan'}</p>`,
                                icon: 'success',
                                confirmButtonText: 'Tutup'
                            });
                        } else {
                            Swal.fire({
                                title: 'Informasi',
                                html: `<p>${data.message}</p>`,
                                icon: 'info',
                                confirmButtonText: 'Tutup'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching score:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengambil nilai.',
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    });
            }

        function toggleAllTasks() {
            const allTugas = document.getElementById('all-tugas');
            allTugas.classList.toggle('collapse');
        }
    </script>
</body>

</html>
