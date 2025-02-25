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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')

            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                        <h2 class="mb-0">Tambah Atau Edit Laporan</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('guru.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('guru.reports.siswa', ['kelasId' => $kelasId]) }}">Daftar
                                        Siswa</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('guru.reports.laporan.index', ['studentId' => $studentId, 'kelasId' => $kelasId]) }}">Laporan</a>
                                </li>
                                <li class="breadcrumb-item active">Buat</li>
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

            <!-- Konten utama -->
            <div class="container mx-auto py-6">
                <h1 class="text-2xl font-bold mb-2">Input Nilai Siswa per Pertemuan</h1>
                <form
                    action="{{ route('guru.reports.laporan.store', ['studentId' => $studentId, 'kelasId' => $kelasId]) }}"
                    method="POST">
                    @csrf
                    <!-- Input tersembunyi untuk student_id -->
                    <input type="hidden" name="student_id" value="{{ $studentId }}">

                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Mata Pelajaran</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="meeting" class="form-label">Pertemuan</label>
                        <select name="meeting" id="meeting" class="form-control" required>
                            @foreach($meetings as $meeting)
                                <option value="{{ $meeting->id }}">{{ $meeting->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="score" class="form-label">Nilai</label>
                        <input type="number" name="score" class="form-control" min="0" max="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="feedback" class="form-label">Masukan/Feedback</label>
                        <textarea name="feedback" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                </form>
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


    <script>
        document.getElementById('subject_id').addEventListener('change', function () {
            let subjectId = this.value;

            // Menggunakan AJAX untuk mengirimkan request ke server dan mendapatkan pertemuan
            fetch(`/guru/get-meetings/${subjectId}`)
                .then(response => response.json())
                .then(data => {
                    let meetingSelect = document.getElementById('meeting');
                    meetingSelect.innerHTML = ''; // Kosongkan dropdown pertemuan

                    data.forEach(meeting => {
                        let option = document.createElement('option');
                        option.value = meeting.id;
                        option.textContent = meeting.title;
                        meetingSelect.appendChild(option);
                    });
                });
        });

    </script>

</body>

</html>