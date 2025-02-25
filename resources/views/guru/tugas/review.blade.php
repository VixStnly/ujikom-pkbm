<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Review dan Penilaian Tugas</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-size: 0.875rem;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn-custom {
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }
    </style>
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
                            <h2 class="mb-0">Tinjau dan Penilaian Tugas - <span
                                    class="font-bold text-blue-700">{{ $tugas->judul }}</span></h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.tugas.index') }}">Tugas</a></li>
                                <li class="breadcrumb-item active">Tinjau dan Penilaian</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container page__container page-section">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Judul Tugas</th>
                                <th>Siswa</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Tanggal Dikirim</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tugas->submissionsTugas as $submission)
                                <tr>
                                    <td>{{ $submission->judul ?? 'N/A' }}</td>
                                    <td>{{ $submission->siswa->name ?? 'N/A' }}</td>
                                    <td>{{ $submission->deskripsi ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $submission->file) }}"
                                            class="btn btn-primary btn-sm btn-custom" download>
                                            <i class="fas fa-download"></i> Unduh
                                        </a>
                                    </td>
                                    <td>{{ $submission->created_at->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        @if ($submission->score)
                                            {{ $submission->score->nilai }} / 100
                                        @else
                                            <span class="text-muted">Belum Dinilai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-custom btn-sm"
                                            onclick="showModal({{ $submission->id }}, '{{ $submission->siswa->name }}', '{{ $submission->score->nilai ?? '' }}', '{{ $submission->score->keterangan ?? '' }}')">
                                            @if ($submission->score)
                                                <i class="fas fa-edit"></i> Edit Nilai
                                            @else
                                                <i class="fas fa-check"></i> Beri Nilai
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mb-32pt">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $submissions->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $submissions->previousPageUrl() }}" aria-label="Previous" {{ $submissions->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $submissions->lastPage(); $i++)
                            <li class="page-item {{ $i == $submissions->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $submissions->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $submissions->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $submissions->nextPageUrl() }}" aria-label="Next" {{ !$submissions->hasMorePages() ? 'tabindex="-1"' : '' }}>
                                <span>Next</span>
                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mt-3">
                    <a onclick="history.back()" class="btn btn-outline-secondary">Kembali</a>
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
    <script>
        function showModal(id, siswaName, nilai, keterangan) {
            Swal.fire({
                title: (nilai ? 'Edit Nilai untuk ' : 'Beri Nilai untuk ') + siswaName,
                html: `
        <form id="nilaiForm" method="POST" action="{{ url('tugas/beriNilai') }}/${id}">
            @csrf
            <div class="form-group">
                <label for="nilai">Nilai</label>
                <input type="number" name="nilai" class="form-control" min="0" max="100" value="${nilai}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">${keterangan}</textarea>
            </div>
            <input type="hidden" name="submission_id" value="${id}">
        </form>
        `,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Tutup',
                preConfirm: () => {
                    document.getElementById('nilaiForm').submit();
                }
            });
        }
    </script>

</body>

</html>