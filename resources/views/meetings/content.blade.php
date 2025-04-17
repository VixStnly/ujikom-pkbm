<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>


    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        <div class="mdk-header-layout__content page-content">
            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">{{ $subject->name }} - Pertemuan</h1>
                            <div>
                                <span class="chip chip-outline-secondary d-inline-flex align-items-center" data-toggle="tooltip" data-title="Experience IQ" data-placement="bottom">
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
                            <a href="/subjects" class="btn btn-light">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 font-sans leading-normal tracking-normal">
        <div class="container mx-auto px-4 py-6">
            <!-- Notification Message -->
            <div class="rounded mb-4 mt-3">
                <div class="alert alert-soft-warning alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex flex-wrap align-items-start">
                        <div class="mr-8pt">
                            <i class="material-icons">access_time</i>
                        </div>
                        <div class="flex" style="min-width: 180px">
                            <small class="text-black-100">
                                <strong>Informasi</strong> Klik pada judul pertemuan untuk melihat detailnya!
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Pertemuan Section (Left) -->
                <div class="lg:col-span-2">
                    <div class="row mb-8pt">

                    <div class="col-lg-8">
                            <div class="page-separator">
                                <div class="page-separator__text">Pertemuan</div>
                            </div>
                            @if($meetings->isEmpty())
                            <div class="alert bg-primary text-white border-0" role="alert">
                                <div class="d-flex flex-wrap align-items-start">
                                    <div class="mr-8pt">
                                        <i class="material-icons">access_time</i>
                                    </div>
                                    <div class="flex" style="min-width: 180px">
                                        <small>Tidak ada pertemuan yang dijadwalkan untuk pelajaran ini.</small>
                                    </div>
                                </div>
                            </div>
                            @else<!-- Inside the meeting loop -->
                            @foreach($meetings as $meeting)
                            @php
                            // Parse tanggal pertemuan
                            $meetingDate = \Carbon\Carbon::parse($meeting->meeting_time);
                            $meetingDate->locale('id'); // Mengatur locale ke bahasa Indonesia
                            $today = \Carbon\Carbon::today();
                            $isToday = $meetingDate->isSameDay($today);
                            $isUpcoming = $meetingDate->isAfter($today);
                            // Check if the user has marked attendance for this meeting using Absensi model
                            $hasAttended = $meeting->absensi()->where('user_id', $user->id)->exists();
                            $isPast = $meetingDate->isBefore($today); // Cek apakah meeting sudah lewat

                            @endphp

                            <div class="col-md-13 mx-auto">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-1">
                                            <div>
                                                <h5 class="card-title fw-bold mb-0" style="font-size: 1.2rem;">📁 {{ $meeting->title }}</h5>
                                                <small class="text-muted">{{ $meetingDate->translatedFormat('l, d F Y') }}</small>
                                            </div>

                                            @if($isToday)
                                            <span class="alert alert-info py-1 px-2 mt-2 mt-sm-0 mb-0" role="alert" style="font-size: 0.75rem;">
                                                Sedang Dimulai
                                            </span>
                                            @elseif($isUpcoming)
                                            <span class="alert alert-warning py-1 px-2 mt-2 mt-sm-0 mb-0" role="alert" style="font-size: 0.75rem;">
                                                Akan Dimulai
                                            </span>
                                            @elseif($isPast)
                                            <span class="alert alert-warning py-1 px-2 mt-2 mt-sm-0 mb-0" role="alert" style="font-size: 0.75rem;">
                                                Akan Dimulai
                                            </span>
                                            @endif

                                        </div>

                                        <p class="card-text text-muted mt-3">
                                            {{ $meeting->description }}
                                        </p>

                                        <div class="nav-align-top">
                                            <ul class="nav nav-tabs gap-1" role="tablist">
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#task-{{ $meeting->id }}">
                                                        <i class='bx bx-book'></i> Tugas
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#absen-forum-{{ $meeting->id }}" aria-controls="absen-forum-{{ $meeting->id }}">
                                                        <i class='bx bx-user-check'></i> Absen & Forum
                                                    </button>
                                                </li>
                                            </ul>

                                            <div class="tab-content pt-4">
                                                <!-- Tab: Tugas -->
                                                <div class="tab-pane fade show active" id="task-{{ $meeting->id }}">
                                                    <div class="card mb-3 border-0 bg-light p-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">

                                                        @forelse ($meeting->tugas as $tugas)

                                                            <h6 class="fw-bold mb-0">
                                                                <i class='bx bx-task'></i> Tugas
                                                            </h6>

                                                            
                                                            @php
                                                            $isLate = \Carbon\Carbon::parse($tugas->tanggal_deadline)->isPast();
                                                            @endphp

                                                            <div class="btn btn-sm btn-light border d-flex align-items-center gap-1 mb-2">
                                                                <i class='bx {{ $isLate ? "bx-error-circle text-danger" : "bx-time-five text-success" }}'></i>
                                                                <span class="{{ $isLate ? 'text-danger' : 'text-success' }}">
                                                                    {{ $isLate ? 'Terlambat' : 'Sedang Dimulai' }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <h6 class="text-base font-semibold text-gray-800 mb-1">
                                                                {{ $tugas->judul }}
                                                            </h6>
                                                            <span class="text-sm text-gray-500">Dibuat oleh: {{ $tugas->user->name }}</span>
                                                        </div>


                                                        <div class="d-flex gap-2">
                                                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" onclick="location.href='{{ route('submit.tugas.show', $tugas->id) }}'">
                                                                <i class='tf-icons bx bx-show'></i>&nbsp; Lihat Tugas
                                                            </button>

                                                            @forelse ($meeting->materi as $materi)
                                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" onclick="location.href='{{ route('materi.show', $materi->id) }}'">
                                                                <i class='tf-icons bx bx-book-open'></i>&nbsp; Lihat Materi
                                                            </button>
                                                            @empty
                                                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" disabled>
                                                                <i class='tf-icons bx bx-book-open'></i>&nbsp; Tidak ada materi
                                                            </button>
                                                            @endforelse

                                                            @empty
                                                            <div class="text-center w-100 py-2">
                                                                <i class='bx bx-info-circle fs-4 mb-1 d-block'></i>
                                                                <p class="mb-0">Belum ada tugas untuk pertemuan ini.</p>
                                                            </div>
                                                            @endforelse

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tab: Absen & Forum -->
                                                <div class="tab-pane fade" id="absen-forum-{{ $meeting->id }}">
                                                    <div class="card mb-3 border-0 bg-light p-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="fw-bold mb-0">
                                                                <i class='bx bx-calendar-check'></i> Absen
                                                            </h6>

                                                            @php
                                                            $meetingDate = \Carbon\Carbon::parse($meeting->meeting_time);
                                                            $now = \Carbon\Carbon::now();
                                                            $isLate = !$hasAttended && $meetingDate->isPast();
                                                            @endphp

                                                            @if ($hasAttended)
                                                            <div class="btn btn-sm btn-light border d-flex align-items-center gap-1">
                                                                <i class='bx bx-check-circle text-success'></i>
                                                                <span class="text-success">Sudah Absen</span>
                                                            </div>
                                                            @elseif ($isLate)
                                                            @elseif ($meetingDate->isToday() && $now->isBefore($meetingDate))
                                                            <div class="btn btn-sm btn-light border d-flex align-items-center gap-1">
                                                                <i class='bx bx-time-five text-warning'></i>
                                                                <span class="text-warning">Belum Absen</span>
                                                            </div>
                                                            @else
                                                            <div class="btn btn-sm btn-light border d-flex align-items-center gap-1">
                                                                <i class='bx bx-error-circle text-danger'></i>
                                                                <span class="text-danger">Absen belum dimulai</span>
                                                            </div>
                                                            @endif
                                                        </div>

                                                        <p class="mb-2">Klik tombol di bawah untuk melakukan absen:</p>
                                                        @if ($isLate)
                                                        <button class="btn btn-outline-danger btn-sm opacity-50 cursor-not-allowed" disabled>
                                                            <i class='bx bx-time text-danger'></i>&nbsp; Terlambat
                                                        </button>
                                                        @else
                                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" onclick="location.href='{{ route('siswa.absensi', ['meeting' => $meeting->id]) }}'">
                                                            <i class='bx bx-check text-info'></i>&nbsp; Isi Absen
                                                        </button>
                                                        @endif

                                                    </div>

                                                    <div class="card border-0 bg-light p-3">
                                                        <h6 class="fw-bold"><i class='bx bx-conversation'></i> Forum Diskusi</h6>
                                                        <p class="mb-2">Topik: Apa manfaat belajar HTML bagi karier kamu?</p>
                                                        <a href="{{ route('forum.index', $meeting->id) }}" class="btn btn-dark btn-sm" data-bs-toggle="tooltip">
                                                            <i class='bx bx-message-square-dots'></i>&nbsp; Buka Forum
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Tooltip Bootstrap init -->
                            <script>
                                const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                                tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el))
                            </script>
                            @endforeach
                            @endif

                            <style>
                                .nav-tabs .nav-link,
                                .tab-content {
                                    box-shadow: none !important;
                                }
                            </style>

                    </div>


                        <div class="col-lg-4">
    <div class="page-separator">
        <div class="page-separator__text">Lainnya</div>
    </div>

    <!-- Statistik Kehadiran -->
    <div class="card mb-4 shadow-sm rounded-3">
        <div class="card-body">
            <h5 class="card-title mb-3">📊 Statistik Kehadiran</h5>
            <p class="mb-1">Total Pertemuan: <strong>12</strong></p>
            <p class="mb-1">Rata-rata Kehadiran: <strong>87%</strong></p>
            <p class="mb-0">Pertemuan Terbanyak: <strong>17 siswa</strong></p>
        </div>
    </div>

    <!-- Pertemuan Selanjutnya -->
    <div class="card mb-4 shadow-sm rounded-3 bg-light border-0">
        <div class="card-body">
            <h5 class="card-title mb-3">📅 Pertemuan Selanjutnya</h5>
            <p class="mb-1">🗓️ Senin, 21 April 2025</p>
            <p class="mb-1">⏰ Jam 10:00 WIB</p>
            <p class="mb-0">📍 Ruang Lab 2</p>
        </div>
    </div>

    <!-- Pengumuman -->
    <div class="card mb-4 shadow-sm rounded-3 border-start border-primary border-3">
        <div class="card-body">
            <h5 class="card-title mb-3">📢 Pengumuman</h5>
            <ul class="list-unstyled mb-0">
                <li>✅ Tugas minggu ini dikumpulkan Jumat</li>
                <li>📎 Link materi terbaru ada di Google Drive</li>
                <li>📝 Absensi ditutup jam 12.00 siang</li>
            </ul>
        </div>
    </div>
</div>

                    </div>
                </div>
                <!-- Aside Section (Right) -->
            </div>
        </div>

        @include ('Page.footer')
    </div>

    <script>
        function toggleDetail(detailId) {
            const detailSection = document.getElementById(detailId);
            // Toggle visibility
            detailSection.classList.toggle("hidden");
            detailSection.style.display = detailSection.classList.contains("hidden") ? "none" : "block";
        }
    </script>

    <style>
        .meeting-details {
            display: none;
            /* Initially hidden by default */
        }
    </style>
</body>

</html>