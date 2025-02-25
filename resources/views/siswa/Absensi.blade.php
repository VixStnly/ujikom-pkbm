@include('content.html')

<head>
    @include('content.style')

    <style>
    .text-bold {
        font-weight: bold;
    }
    #date {
    color: white; /* Mengubah warna teks menjadi putih */
}

</style>

    <script>
        // Update the clock with date and time
        function updateDateTime() {
            const now = new Date();
            
            // Format date as YYYY-MM-DD
            const currentDate = now.toLocaleDateString([], { year: 'numeric', month: 'long', day: 'numeric' });
            // Format time as HH:MM:SS
            const currentTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            
            // Display date and time
            document.getElementById('date').innerText = currentDate;
            document.getElementById('clock').innerText = currentTime;
        }

        // Update every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call
    </script>
</head>

<body class="layout-sticky-subnav layout-learnly">
    <div style="z-index: 100;">
        @include('content.sidemenu')
    </div>

    @include('layouts.NavSiswa')
    @extends('content.js')

    <!-- Main Content -->
    <div class="mdk-header-layout__content page-content">
        <div class="page-section border-bottom-2">
            <div class="container page__container">
                <div class="row mb-8pt">

                <div class="col-lg-6">
                    <div class="page-separator">
                        <div class="page-separator__text"><strong>Waktu</strong></div>
                    </div>

                    <div class="card card-group-row__card text-center o-hidden border-0" style="background: linear-gradient(to right, #22c55e, #000); color: white;">
                        <div class="card-body d-flex flex-column">
                            <div class="flex-grow mb-16pt">
                                <span class="w-64 h-64 icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-16pt" style="color: white !important;">
                                    <i class="material-icons">access_time</i>
                                </span>
                                <h4 class="mb-8pt text-white text-bold" style="font-size: 24px;"><strong>Tanggal dan Jam</strong></h4>
                                <p class="text-70 text-xl mb-0 text-bold" id="date" style="font-size: 15px; color: white !important;"></p>
                            </div>
                            <p class="lh-1 text-muted mb-0 text-bold mb-4" id="clock" style="font-size: 24px; color: white !important;"></p>
                        </div>
                    </div>
                </div>

                    <!-- Announcements Section -->
                    <div class="col-lg-6">
                        <div class="page-separator">
                            <div class="page-separator__text">Form Absensi</div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Check if the user has already attended the meeting -->
                                @if ($hasAttended)
                                <div class="d-flex flex-column align-items-center justify-content-center border border-soft rounded-lg p-4 mb-4" style="background-color: rgba(220, 252, 231, 1);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-small text-success mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="h5 text-center mb-4">
                                        Terimakasih Kamu sudah melakukan absen pada pertemuan kali ini.
                                    </p>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-light mr-2 ml-0" onclick="window.location='{{ url('subjects/' . $meeting->subject_id . '/meetings') }}'">
                                        Kembali
                                    </button>
                                    <button class="btn btn-light" onclick="window.location='{{ url('/histori/absen') }}'">
                                        Riwayat Absen
                                    </button>
                                </div>

                                <style>
                                    .svg-small {
                                        width: 75px; /* Adjust width */
                                        height: 75px; /* Adjust height */
                                    }
                                </style>


                                @else
                                    <!-- Absensi Form -->
                                    <form action="{{ route('siswa.absensi.store', ['meeting' => $meeting->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">

                                        <!-- Automatically set the date here -->
                                        <div class="form-group mb-24pt" style="display: none;">
                                            <label for="tanggal_absen">Waktu Pertemuan</label>
                                            <input type="datetime-local" name="tanggal_absen" id="tanggal_absen" class="form-control" required>
                                            @error('tanggal_absen')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <script>
                                            // Set the attendance date and time to the current date and time in Indonesian timezone (WIB)
                                            const now = new Date();
                                            const jakartaOffset = 7 * 60; // Offset in minutes
                                            const jakartaTime = new Date(now.getTime() + (jakartaOffset * 60 * 1000));
                                            
                                            // Format: YYYY-MM-DDTHH:MM
                                            const formattedDateTime = jakartaTime.toISOString().slice(0, 16);
                                            document.getElementById('tanggal_absen').value = formattedDateTime;
                                        </script>

                                        <div class="form-group mb-4">
                                            <label for="status" class="block font-semibold mb-2">Status</label>
                                            <select name="status" class="form-control border rounded p-2 w-full" required>
                                                <option value="Hadir">Hadir</option>
                                                <option value="Izin">Izin</option>
                                                <option value="Sakit">Sakit</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary bg-blue-500">
                                            Submit Absensi
                                        </button>
                                        <a href="{{ url('subjects/' . $meeting->subject_id . '/meetings') }}" class="btn btn-secondary bg-blue-500">
                                            Kembali
                                        </a>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('guru.footer')

    <div class="container mx-auto mt-10">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
</body>
