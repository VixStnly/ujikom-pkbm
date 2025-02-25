
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
        
        // Check if the user has marked attendance for this meeting using Absensi model
        $hasAttended = $meeting->absensi()->where('user_id', $user->id)->exists();
    @endphp

    <div class="accordion accordion-without-arrow mb-0" id="accordionIcon">
        <div class="accordion-item card">
            <h2 class="accordion-header d-flex justify-between" id="heading-{{ $meeting->id }}">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#details-{{ $meeting->id }}" aria-controls="details-{{ $meeting->id }}">
                    <div class="mt-3 relative">
                        <h5 class="text-xl font-semibold">{{ $meeting->title }}</h5>
                        <h6 class="text-sm text-gray-500">{{ $meetingDate->translatedFormat('l, d F Y') }}</h6>
                        <p class="text-gray-600">{{ $meeting->description }}</p>
                        <!-- Status Badge -->
                        @if($isToday)
                            <span class="absolute top-0 right-0 m-4 bg-green-500 text-white text-sm px-2 py-1 rounded">Sedang Dimulai</span>
                        @elseif($isUpcoming)
                            <span class="absolute top-0 right-0 m-4 bg-yellow-500 text-white text-sm px-2 py-1 rounded">Akan Dimulai</span>
                        @endif
                    </div>
                </button>
            </h2>

            <div id="details-{{ $meeting->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                <div class="accordion-body" style="background-color: #f8f9fa; border-radius: 8px; padding: 16px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                    <!-- Tugas and Materi sections... -->
                    <h6 class="font-semibold mt-3" style="font-size: 1.25rem;">Tugas:</h6>
                            <ul class="list-none" style="padding: 0; margin: 0;">
                                @forelse ($meeting->tugas as $tugas)
                                    <li class="task-item" style="margin-bottom: 16px;">
                                        <div class="task-content">
                                            <strong>{{ $tugas->judul }}</strong>
                                            <span class="text-sm text-gray-500">(Dibuat oleh: {{ $tugas->user->name }})</span>
                                        </div>
                                        <span class="{{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->isPast() ? 'text-danger' : 'text-green-500' }} mr-3">
                                            {{ \Carbon\Carbon::parse($meeting->meeting_time)->isPast() ? 'Terlambat' : 'Sedang Dimulai' }}
                                        </span>
                                        <div class="button-container" style="display: flex; flex-direction: column; gap: 8px;">
                                            <div class="text-center">
                                                <button class="btn btn-outline-dark small-button" onclick="location.href='{{ route('submit.tugas.show', $tugas->id) }}'">Lihat Tugas</button>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="no-task">Tidak ada tugas tersedia.</li>
                                @endforelse
                            </ul>

                            <h6 class="font-semibold mt-4" style="font-size: 1.25rem;">Materi:</h6>
                            <ul class="list-none" style="padding: 0; margin: 0;">
                                @forelse ($meeting->materi as $materi)
                                    <li class="material-item" style="margin-bottom: 16px;">
                                        <div class="material-content">
                                            <strong>{{ $materi->judul }}</strong>
                                            <span class="text-sm text-gray-500">(Dibuat oleh: {{ $materi->user->name }})</span>
                                        </div>
                                        <div class="button-container" style="display: flex; justify-content: flex-end; gap: 8px;">
                                            <button class="btn btn-outline-dark small-button" onclick="location.href='{{ route('materi.show', $materi->id) }}'">Lihat Materi</button>
                                        </div>

                                        <style>
                                            @media (max-width: 768px) {
                                                .small-button {
                                                    width: 78%;
                                                    padding: 6px 10px; /* Smaller padding for mobile */
                                                    font-size: 0.875rem; /* Adjust font size for mobile */
                                                }
                                            }
                                        </style>

                                    </li>
                                @empty
                                    <li class="no-material">Tidak ada materi tersedia.</li>
                                @endforelse
                            </ul>

                    <!-- Absen Section -->
                    <div class="attendance-section">
    <h6 class="font-semibold" style="font-size: 1.25rem;">Absen:</h6>
    
    @php
        // Pastikan tanggal dan waktu pertemuan diparse dengan benar
        $meetingDate = \Carbon\Carbon::parse($meeting->meeting_time);
        $now = \Carbon\Carbon::now(); // Mendapatkan waktu sekarang
    @endphp

    @if ($hasAttended)
        <div class="alert alert-success bg-green-100 border border-green-500 rounded-lg p-4 mb-4" role="alert">
            Anda telah menghadiri pertemuan ini.
        </div>
    @elseif ($meetingDate->isPast())
        <div class="text-danger no-material">
            Anda terlambat absen:
            @include('content.html') <!-- Mengasumsikan content.html berisi informasi tambahan -->
        </div>
    @elseif ($meetingDate->isToday() && $now->isBefore($meetingDate))
        <!-- Meeting is today and hasn't started yet -->
        <div class="button-container" style="display: flex; flex-direction: column; gap: 8px;">
            <button onclick="location.href='{{ route('siswa.absensi', ['meeting' => $meeting->id]) }}'" class="btn-attend rounded">Absen</button>
        </div>
    @else
        <div class="text-warning no-material">
            Absen belum dimulai.
        </div>
    @endif
</div>


              

                        </div>
                    </div>

                    <style>
                        ul {
                            list-style-type: none; /* Removes bullet points from the list items */
                            padding: 0;
                            margin: 0;
                        }

                        .task-item, .material-item {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 12px;
                            background: #fff;
                            border: 1px solid #e0e0e0;
                            border-radius: 8px;
                            margin-bottom: 10px;
                            transition: box-shadow 0.3s;
                        }

                        .task-item:hover, .material-item:hover {
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        }

                        .btn-view-task, .btn-view-material, .btn-attend {
                            background: #007bff;
                            color: #fff;
                            padding: 8px 12px;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                            transition: background 0.2s;
                        }

                        .btn-view-task:hover, .btn-view-material:hover, .btn-attend:hover {
                            background: #0056b3;
                        }

                        .no-task, .no-material {
                            padding: 12px;
                            background: #f5f5f5;
                            border-radius: 8px;
                        }

                        .attendance-section {
                            margin-top: 16px;
                            padding-top: 8px;
                            border-top: 1px solid #e0e0e0;
                        }
                    </style>

                </div>
            </div>
        @endforeach

        <!-- Pagination Control -->
       
    @endif
</div>


                    <div class="col-lg-4">
                        <div class="page-separator">
                            <div class="page-separator__text">Lainnya</div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-xl font-semibold">Tata Cara </h3>
                                <div class="alert alert-primary" role="alert">
                                    <small class="text-black-100">Klik Pada Card / Box Pertemuan</small>
                                </div>
                                <div class="alert alert-primary" role="alert">
                                    <small class="text-black-100">Klik Lihat Tugas / Materi</small>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <small class="text-black-100">Absen Sebelum Mengerjakan Tugas</small>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <small class="text-black-100">Pengumuman</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Aside Section (Right) -->
        </div>
    </div>
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
        display: none; /* Initially hidden by default */
    }
</style>
</body>
</html>