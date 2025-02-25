<script src="https://cdn.tailwindcss.com"></script>
<!-- Include FullCalendar's CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.js"></script>

<!-- Header Selamat Datang -->
<div class="pt-16">
    <div class="container mx-auto text-center md:text-left">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-2">
            Selamat datang, <span class="text-blue-600">{{ $user->name }}</span>
        </h2>
        <p class="text-lg text-gray-500">Siap untuk kelas hari ini?</p>
    </div>

    <!-- Jam Real-Time -->
    <div class="container mx-auto md:text-left text-center mb-4">
        <div
            class="bg-gradient-to-r from-blue-500 to-purple-500 shadow-lg rounded-lg p-6 transition-transform duration-300 transform hover:scale-105">
            <h3 class="text-2xl font-bold mb-2 text-white">Waktu Sekarang</h3>
            <p id="clock" class="text-4xl font-semibold text-white"></p>
        </div>
    </div>
</div>

<!-- Informasi Statistik -->
<div class="container mx-auto mt-8 mb-8 grid grid-cols-1 md:grid-cols-5 gap-6">
    <!-- Kartu Statistik -->
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <div class="flex items-center justify-center">
            <div class="text-blue-500 text-4xl mr-3 mb-3">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <h4 class="text-xl font-semibold">{{ $user->kelas->count() }}</h4>
        </div>
        <p class="text-gray-500">Jumlah Kelas</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <div class="flex items-center justify-center">
            <div class="text-green-500 text-4xl mr-3 mb-3">
                <i class="fas fa-users"></i>
            </div>
            <h4 class="text-xl font-semibold">{{ $meetingCount ?? 0 }}</h4>
        </div>
        <p class="text-gray-500">Jumlah Pertemuan</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <div class="flex items-center justify-center">
            <div class="text-purple-500 text-4xl mr-3 mb-3">
                <i class="fas fa-book"></i>
            </div>
            <h4 class="text-xl font-semibold">{{ $enrolledSubjectsCount }}</h4>
        </div>
        <p class="text-gray-500">Mata Pelajaran</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <div class="flex items-center justify-center">
            <div class="text-red-500 text-4xl mr-3 mb-3">
                <i class="fas fa-tasks"></i>
            </div>
            <h4 class="text-xl font-semibold">{{ $tugasCount ?? 0 }}</h4>
        </div>
        <p class="text-gray-500">Tugas Diberikan</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <div class="flex items-center justify-center">
            <div class="text-yellow-500 text-4xl mr-3 mb-3">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h4 class="text-xl font-semibold">{{ $ungradedSubmissionsCount }}</h4>
        </div>
        <p class="text-gray-500">Tugas Siswa Belum Dinilai</p>
        <!-- Button to Show Table -->
        <button class="hidden mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none" onclick="toggleCollapse()">
            Lihat Daftar Tugas Siswa
        </button>
    </div>
</div>

<!-- Tambahkan Kartu Baru untuk Submission yang Belum Dinilai -->


<!-- Initialize FullCalendar -->
<script>
    // Update the clock
    function updateClock() {
        const now = new Date();
        const currentTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('clock').innerText = currentTime;
    }

    // Update clock every second
    setInterval(updateClock, 1000);
    // Initialize the clock immediately
    updateClock();

    function toggleCollapse() {
        const container = document.getElementById("collapseContainer");
        container.style.maxHeight = container.style.maxHeight === "0px" ? "300px" : "0px";
    }
</script>