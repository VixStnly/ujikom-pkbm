@include('content.html')

<head>
    @include('content.style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="layout-sticky-subnav layout-learnly">
    @include('layouts.NavSiswa')
    <div style="z-index: 100;">
    @include('content.sidemenu') 
    </div>
    @extends('content.js')

    <div class="mdk-header-layout__content page-content">
        <div class="page-section border-bottom-2">
            <div class="container page__container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Task Title and Video Player -->
                        <div class="page-separator">
                            <div class="page-separator__text">{{ $tugas->judul }}</div>
                        </div>

                        <div>
    @php
        $videoUrl = $tugas->link;
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches);
        $videoId = isset($matches[1]) ? $matches[1] : null;
    @endphp

    @if($videoId)
        <div class="js-player card bg-primary text-center embed-responsive embed-responsive-16by9 mb-6">
            <div class="player embed-responsive-item">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    @else
        <div class="alert alert-soft-secondary mb-24pt">
            <div class="d-flex flex-wrap align-items-start">
                <div class="mr-8pt">
                    <i class="material-icons">info</i>
                </div>
                <div class="flex" style="min-width: 180px">
                    <small class="text-black-100">
                        <strong>Link Tidak Tersedia</strong><br>
                        <span>Video atau file tidak muncul karena link yang tersedia belum dimasukkan.</span>
                    </small>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <a href="{{ $tugas->link }}" class="text-blue-600 hover:text-blue-800 font-bold" target="_blank">{{ $tugas->link }}</a>
        </div>
    @endif
</div>


                        <div class="mb-24pt">
                            <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                                <i class="material-icons icon--left">schedule</i>
                                2h 46m
                            </span>
                            <span class="chip chip-outline-secondary d-inline-flex align-items-center text-danger">
                                <i class="material-icons icon--left">assessment</i>
                                Deadline: {{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d M Y') }}
                            </span>
                        </div>

                        <div class="row mb-24pt">
                            <div class="col">
                                <div class="page-separator">
                                    <div class="page-separator__text">Detail Tugas</div>
                                </div>
                                <p class="text-70 tugas-deskripsi">{{ $tugas->deskripsi }}</p>
                                <style>
                                            .tugas-deskripsi {
                                                    max-width: 100%; /* Atur lebar maksimal sesuai kebutuhan */
                                                    overflow-wrap: break-word; /* Memastikan teks panjang akan terputus */
                                                    white-space: normal; /* Memungkinkan teks untuk membungkus ke baris berikutnya */
                                                    text-overflow: ellipsis; /* Menambahkan elipsis jika teks terlalu panjang */
                                                }
                                        </style>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="page-separator">
                            <div class="page-separator__text">Nama Guru</div>
                        </div>

                        <div class="media align-items-center mb-16pt">
                            <span class="media-left mr-16pt">
                                <span class="material-icons" style="font-size: 40px;">person</span>
                            </span>
                            <div class="media-body">
                                <a class="card-title m-0" href="teacher-profile.html">{{ $tugas->guru->name }}</a>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="card-title mb-1 text-center"><strong>Download Tugas</strong></h4>
                                @if($tugas->file_path)

                                <div class="text-center">
                                    <a href="{{ asset('storage/' . $tugas->file_path) }}" class="btn btn-outline-secondary mt-2" download>
                                        Download Tugas <i class="material-icons icon--right">file_download</i>
                                    </a>
                                </div>
                                @else
                                <p class="text-danger text-center mt-2">Tugas belum tersedia untuk diunduh.</p>
                            @endif
                            </div>
                        </div>

                        @if($submission)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title mb-1 text-center"><strong>Status Tugas</strong></h4>
                                    <p class="text-success text-center">Anda sudah mengumpulkan tugas.</p>

                                    <div class="text-center">
                                        <button class="btn btn-outline-secondary" id="toggleTableButton">Lihat Tugas Yang Anda Kumpulkan</button>
                                        <div id="submissionsTable" class="mt-4" style="display: none;">
                                            <h4 class="card-title mb-3 text-center"><strong>Tugas Yang Anda Kumpulkan</strong></h4>

                                            @if($submissions->count() > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>Judul Tugas</th>
                                                                <th>Download</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($submissions as $submission)
                                                                <tr>
                                                                    <td>{{ $submission->judul }}</td>
                                                                    <td class="text-center">
                                                                        <a href="{{ asset('storage/' . $submission->file) }}" class="btn btn-primary" download>
                                                                            Download <i class="material-icons icon--right">file_download</i>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            <button class="btn btn-outline-dark btn-block" onclick="showScore({{ $submission->id }})">Nilai</button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p>Tidak ada file yang diupload.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <script>
                            // JavaScript for toggle visibility of the submissions table
                            document.getElementById('toggleTableButton').addEventListener('click', function() {
                                const table = document.getElementById('submissionsTable');
                                const isVisible = table.style.display === 'block';
                                table.style.display = isVisible ? 'none' : 'block';
                                this.textContent = isVisible ? 'Lihat Tugas Yang Anda Kumpulkan' : 'Sembunyikan';
                            });
                        </script>

                        <div class="card">
                            <div class="card-body py-4">
                                @if($submission)
                                    <h4 class="card-title mb-1 text-center"><strong>Kumpulkan Ulang Tugas</strong></h4>
                                    <div class="text-center">
                                        <button class="btn btn-outline-primary btn-block mt-2" onclick="toggleForm()">Kumpulkan Tugas Ulang</button>
                                    </div>
                                    <div id="submissionForm" class="mt-4" style="display: none;">
                                        <form action="{{ route('submit.tugas.store', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="judul">Nama Tugas:</label>
                                                <input type="text" class="form-control" id="judul" name="judul" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="assignment-file">Upload File:</label>
                                                <div class="custom-file">
                                                    <input type="file" id="assignment-file" class="custom-file-input" name="file" required>
                                                    <label for="assignment-file" class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
    <label for="description">Link / Lainnya ( opsional ):</label>
    <textarea class="form-control" id="description" name="description"></textarea>
</div>
                                            <button type="submit" class="btn btn-primary">Submit Tugas</button>
                                        </form>
                                    </div>
                                @else
                                    <h4 class="card-title mb-1 text-center"><strong>Kumpulkan Tugas</strong></h4>
                                    <form action="{{ route('submit.tugas.store', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="judul">Nama Tugas:</label>
                                            <input type="text" class="form-control" id="judul" name="judul" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="assignment-file">Upload File:</label>
                                            <div class="custom-file">
                                                <input type="file" id="assignment-file" class="custom-file-input" name="file" required>
                                                <label for="assignment-file" class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                       <div class="form-group">
    <label for="description">Link / Lainnya ( opsional ):</label>
    <textarea class="form-control" id="description" name="description"></textarea>
</div>

                                        <button type="submit" class="btn btn-primary">Submit Tugas</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        @include('guru.footer')


        <script>
            function toggleForm() {
                const form = document.getElementById('submissionForm');
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }

            document.getElementById('assignment-file').addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'Choose file';
                this.nextElementSibling.textContent = fileName;
            });

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
        </script>

</body>
