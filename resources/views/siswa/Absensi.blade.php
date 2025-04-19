@include('content.html')

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('content.style')
    <!-- Add Leaflet CSS for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
    <!-- Add Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

    <style>
        .text-bold {
            font-weight: bold;
        }
        #date, #clock {
            color: white;
        }
        .time-banner {
            background: linear-gradient(to right, #22c55e, #000);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    #map {
        width: 100%;
        height: 350px; /* Atur tinggi sesuai kebutuhan */
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .camera-preview {
        width: 100%;
        height: 350px; /* Samakan dengan map */
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
        
        // Initialize location tracking
        let userLatitude = null;
        let userLongitude = null;
        let map = null;
        let marker = null;

        document.addEventListener('DOMContentLoaded', function() {
            updateDateTime(); // Initial call
            
            // Initialize map when document is loaded
            initializeMap();
            
            // Get user's location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(updatePosition, handleLocationError, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
                
                // Watch position changes
                navigator.geolocation.watchPosition(updatePosition, handleLocationError, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
        
        function initializeMap() {
            // Create map with a default view
            map = L.map('map').setView([-6.2088, 106.8456], 13); // Default to Jakarta
            
            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        }
        
        function updatePosition(position) {
            userLatitude = position.coords.latitude;
            userLongitude = position.coords.longitude;
            
            // Update hidden form fields
            document.getElementById('latitude').value = userLatitude;
            document.getElementById('longitude').value = userLongitude;
            
            // Update accuracy display
            document.getElementById('accuracy').innerText = Math.round(position.coords.accuracy) + ' meter';
            
            // Update map position
            if (map) {
                map.setView([userLatitude, userLongitude], 16);
                
                // Add or update marker
                if (marker) {
                    marker.setLatLng([userLatitude, userLongitude]);
                } else {
                    marker = L.marker([userLatitude, userLongitude]).addTo(map);
                }
                
                // Add accuracy circle
                L.circle([userLatitude, userLongitude], {
                    color: 'blue',
                    fillColor: '#30f',
                    fillOpacity: 0.15,
                    radius: position.coords.accuracy
                }).addTo(map);
            }
        }
        
        function handleLocationError(error) {
            console.error("Error getting location:", error.message);
            alert("Tidak dapat mengakses lokasi Anda. Pastikan GPS diaktifkan.");
        }
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
                
                <!-- Time Banner (Full Width) --> 
                <div class="time-banner p-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg text-white">
    <div class="flex justify-between items-center">
        <!-- Date Section -->
        <div class="flex items-center">
            <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
</svg>
            </div>
            <div>
                <h4 class="mb-1 text-white text-lg font-bold opacity-80">TANGGAL</h4>
                <p id="date" class="m-0 text-xl font-semibold"></p>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="hidden md:block h-16 w-px bg-white bg-opacity-30"></div>
        
        <!-- Time Section -->
        <div class="flex items-center ">
            <div class="bg-white bg-opacity-20 p-3 rounded-full ml-4 mr-4">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
</svg>
            </div>
            <div>
                <h4 class="mb-1 text-white  text-lg font-bold opacity-80">JAM</h4>
                <p id="clock" class="m-0 text-2xl font-semibold"></p>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto mt-10">
    <!-- Success Message -->
    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>

<script>
    // Menghilangkan pesan sukses setelah 3 detik (3000 ms)
    setTimeout(function() {
        const alertBox = document.getElementById('success-alert');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
    }, 3000);
</script>

                <!-- Main Content Area -->
                <div class="row">
                    @if (!$user->face_photo)
                    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h1 class="text-2xl font-bold mb-4 text-center">Verifikasi Wajah</h1>
            
            <!-- Added information about one-time verification -->
            <div class="alert alert-info mb-4 text-center">
                <i class="fas fa-info-circle me-2"></i>
                Verifikasi wajah ini hanya dilakukan sekali untuk mencocokan absensi selanjutnya.
            </div>
            
            <div class="d-flex flex-column align-items-center">
                <video id="video" width="320" height="240" autoplay class="rounded border"></video>
                <button type="button" id="capture" onclick="capturePhoto()" class="btn btn-primary mt-3">Ambil Foto</button>
            
                <form id="verifyForm" action="{{ url('/verify-face') }}" method="POST" enctype="multipart/form-data" style="display:none;" class="mt-3 w-100 text-center">
                    @csrf
                    <input type="hidden" name="photo_data" id="photo_data">

                    <button type="submit" class="btn btn-success">Verifikasi Wajah</button>
                </form>
            </div>
        </div>
    </div>
</div>
                    <script>
                        const video = document.getElementById('video');
                        navigator.mediaDevices.getUserMedia({ video: true }).then((stream) => {
                            video.srcObject = stream;
                        });
                    
                        function capturePhoto() {
                            const canvas = document.createElement('canvas');
                            canvas.width = video.videoWidth;
                            canvas.height = video.videoHeight;
                            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                            const dataUrl = canvas.toDataURL('image/png');
                    
                            // Kirim gambar ke backend sebagai data base64
                            const form = document.getElementById('verifyForm');
                            document.getElementById('photo_data').value = dataUrl;
                            form.style.display = 'block';
                        }
                    </script>
                    @else
                    <!-- Replace the existing form section with this improved version -->
<div class="col-12">
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
                    width: 75px;
                    height: 75px;
                }
            </style>
            @else
            
            <!-- Attendance Type Selection Section -->
            <div id="attendance-type-selection" class="mb-4">
                <h4 class="mb-3 font-bold text-center">Pilih Status Kehadiran</h4>
                
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm h-100 attendance-option" onclick="selectAttendanceType('hadir')">
                            <div class="card-body text-center py-4">
                                <div class="bg-success bg-opacity-10 p-3 mx-auto mb-3 rounded-circle" style="width: 70px; height: 70px;">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8.032 12 1.984 1.984 4.96-4.96m4.55 5.272.893-.893a1.984 1.984 0 0 0 0-2.806l-.893-.893a1.984 1.984 0 0 1-.581-1.403V7.04a1.984 1.984 0 0 0-1.984-1.984h-1.262a1.983 1.983 0 0 1-1.403-.581l-.893-.893a1.984 1.984 0 0 0-2.806 0l-.893.893a1.984 1.984 0 0 1-1.403.581H7.04A1.984 1.984 0 0 0 5.055 7.04v1.262c0 .527-.209 1.031-.581 1.403l-.893.893a1.984 1.984 0 0 0 0 2.806l.893.893c.372.372.581.876.581 1.403v1.262a1.984 1.984 0 0 0 1.984 1.984h1.262c.527 0 1.031.209 1.403.581l.893.893a1.984 1.984 0 0 0 2.806 0l.893-.893a1.985 1.985 0 0 1 1.403-.581h1.262a1.984 1.984 0 0 0 1.984-1.984V15.7c0-.527.209-1.031.581-1.403Z"/>
</svg>

                                </div>
                                <h5 class="mb-0">Hadir</h5>
                                <p class="text-muted small mt-2">Absen dengan kamera dan lokasi</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm h-100 attendance-option" onclick="selectAttendanceType('tidak hadir')">
                            <div class="card-body text-center py-4">
                                <div class="bg-warning bg-opacity-10 p-3 mx-auto mb-3 rounded-circle" style="width: 70px; height: 70px;">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
</svg>

                                </div>
                                <h5 class="mb-0">tidak hadir</h5>
                                <p class="text-muted small mt-2">Kirim absen dengan status tidak hadir</p>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
        <!-- Additional Notes Section (For Sick or Permission) -->
<div id="attendance-notes" class="mb-4 d-none">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="font-bold mb-3">Status Absensi: <span id="attendance-type-label">tidak hadir/Izin</span></h5>
            
            <form id="sickPermissionForm" method="POST" action="{{ route('absence.process') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                <input type="hidden" name="status" id="status-input">
                <input type="hidden" id="tanggal_absen" name="tanggal_absen">
                
                <div class="alert alert-info mb-4">
                    <small>Anda akan mengirimkan absensi dengan status <span id="status-info">tidak hadir/Izin</span></small>
                </div>
                
                <div class="d-flex mt-4">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="backToSelection()">
                        Kembali
                    </button>
                    <button type="submit" class=" ml-4 btn btn-primary">
                        Kirim Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
            
            <!-- Camera and Location Section (For Present) -->
            <div id="camera-location-section" class="d-none">
                <div class="row">
                    <!-- Camera Section (Left Column) -->
                    <div class="col-md-6">
                        <h4 class="mb-3 font-bold">Absensi Wajah</h4>
                        <!-- Video Preview + Confidence Tag -->
                        <div class="position-relative mb-3">
                        <video id="video" class="camera-preview rounded-lg shadow border" autoplay></video>
                            
                            <!-- Confidence Bubble - Always centered at top -->
                            <div id="confidenceDisplay" class="position-absolute top-0 start-50 translate-middle-x mt-2 px-3 py-1 rounded-pill shadow-sm d-none">
                                Kemiripan: <span id="confidence">0</span>%
                            </div>

                            <!-- Loading Animation - Completely hidden until button click -->
                            <div id="loading" class="position-absolute top-0 start-0 w-100 h-100 d-none">
                                <!-- This is the semi-transparent overlay -->
                                <div class="w-100 h-100 bg-dark bg-opacity-30 d-flex align-items-center justify-content-center">
                                    <div class="bg-dark bg-opacity-60 px-4 py-3 rounded-lg">
                                        <div class="d-flex flex-column align-items-center">
                                            <!-- Loading Bar -->
                                            <div class="w-100 bg-secondary bg-opacity-50 rounded-pill overflow-hidden mb-2" style="height: 8px; min-width: 200px;">
                                                <div id="progressBar" class="h-100 bg-primary rounded-pill" style="width: 0%"></div>
                                            </div>
                                            <!-- Percentage Text -->
                                            <div class="text-white font-weight-bold"><span id="progressPercentage">0</span>% Memproses</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button onclick="capturePhoto()" class="btn btn-primary w-100 mb-3" id="captureBtn">
                            Ambil Foto & Cek Wajah
                        </button>

                        <!-- Hidden canvas -->
                        <canvas id="canvas" width="640" height="480" class="d-none"></canvas>
                    </div>

                    <!-- Location Section (Right Column) -->
                    <div class="col-md-6">
                        <h4 class="mb-3 font-bold">Lokasi Anda</h4>
                        <div class="position-relative">
                            <!-- Map container -->
                            <div id="map"></div>
                            
                            <div class="mt-4 d-flex justify-content-between">
                                <span class="badge bg-info text-white p-2">
                                    Akurasi: <span id="accuracy">Menunggu...</span>
                                </span>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="map.locate({setView: true, maxZoom: 16})">
                                    Perbarui Lokasi
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Submission -->
                    <div class="col-12 mt-4">
                        <form id="absenceForm" method="POST" action="{{ route('absence.process') }}">
                            @csrf
                            <input type="hidden" name="photo_data" id="photo_data">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                            <input type="hidden" name="status" value="hadir">
                            <input type="hidden" id="tanggal_absen_hadir" name="tanggal_absen">

                            <div class="alert alert-info">
                                <small>Pastikan foto wajah terlihat jelas dan lokasi Anda terdeteksi dengan akurat sebelum melakukan absensi</small>
                            </div>
                            
                            <div class="d-flex">
                                <button type="button" class="btn btn-outline-secondary me-2" onclick="backToSelection()">
                                    Kembali
                                </button>
                                <button type="submit" class="btn btn-success flex-grow-1 py-2 d-none" id="submitBtn">
                                    Submit Absensi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add JavaScript for handling attendance type selection -->
<script>
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photoInput = document.getElementById('photo_data');
const confidenceDisplay = document.getElementById('confidenceDisplay');
const confidenceText = document.getElementById('confidence');
const submitBtn = document.getElementById('submitBtn');
const loading = document.getElementById('loading');
const progressBar = document.getElementById('progressBar');
const progressPercentage = document.getElementById('progressPercentage');

// Container to hold video and captured image
const videoContainer = document.querySelector('.position-relative');

// Get current date and time function
function getCurrentDateTime() {
    const now = new Date();
    // Format: YYYY-MM-DD HH:mm:ss
    return now.getFullYear() + "-" +
        String(now.getMonth() + 1).padStart(2, '0') + "-" +
        String(now.getDate()).padStart(2, '0') + " " +
        String(now.getHours()).padStart(2, '0') + ":" +
        String(now.getMinutes()).padStart(2, '0') + ":" +
        String(now.getSeconds()).padStart(2, '0');
}

// Set form date on load
window.onload = function() {
    document.getElementById('tanggal_absen').value = getCurrentDateTime();
    if (document.getElementById('tanggal_absen_hadir')) {
        document.getElementById('tanggal_absen_hadir').value = getCurrentDateTime();
    }
};

// Function to select attendance type
function selectAttendanceType(type) {
    const selectionSection = document.getElementById('attendance-type-selection');
    const cameraLocationSection = document.getElementById('camera-location-section');
    const notesSection = document.getElementById('attendance-notes');
    
    // Hide selection section
    selectionSection.classList.add('d-none');
    
    if (type === 'hadir') {
        // Show camera and location section
        cameraLocationSection.classList.remove('d-none');
        
        // Initialize camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                video.srcObject = stream;
            });
    } else {
        // Show notes section for sick or permission
        notesSection.classList.remove('d-none');
        
        // Update labels and form
        const typeLabel = document.getElementById('attendance-type-label');
        const statusInfo = document.getElementById('status-info');
        const statusInput = document.getElementById('status-input');
        
        const statusText = type === 'tidak hadir' ? 'tidak hadir' : 'Izin';
        typeLabel.textContent = statusText;
        statusInfo.textContent = statusText;
        statusInput.value = type;
    }
}
// Function to go back to selection
function backToSelection() {
    // Hide all sections
    document.getElementById('camera-location-section').classList.add('d-none');
    document.getElementById('attendance-notes').classList.add('d-none');
    
    // Show selection section
    document.getElementById('attendance-type-selection').classList.remove('d-none');
    
    // Stop video stream if active
    if (video.srcObject) {
        const tracks = video.srcObject.getTracks();
        tracks.forEach(track => track.stop());
        video.srcObject = null;
    }
    
    // Reset forms
    document.getElementById('absenceForm').reset();
    document.getElementById('sickPermissionForm').reset();
    
    // Remove captured image if exists
    const capturedImage = document.getElementById('capturedImage');
    if (capturedImage) capturedImage.remove();
    
    // Remove retry button if exists
    const retakeButton = document.querySelector('.btn-outline-secondary.w-100.mt-2');
    if (retakeButton) retakeButton.remove();
    
    // Hide confidence display and submit button
    confidenceDisplay.classList.add('d-none');
    submitBtn.classList.add('d-none');
    
    // Show video element
    if (video) video.style.display = 'block';
}

function capturePhoto() {
    // Reset and show loading
    progressBar.style.width = '0%';
    progressPercentage.textContent = '0';
    loading.classList.remove('d-none');
    
    // Hide any previous confidence display
    confidenceDisplay.classList.add('d-none');
    
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    const dataURL = canvas.toDataURL('image/png');
    photoInput.value = dataURL;

    // Animate progress bar
    let progress = 0;
    let fakeProcessing = setInterval(() => {
        // Increment faster at first, then slow down
        if (progress < 50) {
            progress += 2;
        } else if (progress < 80) {
            progress += 1;
        } else if (progress < 90) {
            progress += 0.5;
        }
        
        // Cap at 90% until we get real results
        if (progress > 90) {
            progress = 90;
            clearInterval(fakeProcessing);
        }
        
        progressBar.style.width = progress + '%';
        progressPercentage.textContent = Math.round(progress);
    }, 30);

    // Kirim ke API untuk deteksi
    fetch("{{ route('api.face.compare') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({ photo_data: dataURL })
    })
    .then(res => res.json())
    .then(data => {
        // Clear the fake processing interval
        clearInterval(fakeProcessing);
        
        // Complete the progress bar to 100%
        let finalProgress = 90;
        let finalizing = setInterval(() => {
            finalProgress += 2;
            if (finalProgress >= 100) {
                finalProgress = 100;
                clearInterval(finalizing);
                
                // Hide loading and show result after a short delay
                setTimeout(() => {
                    loading.classList.add('d-none');
                    
                    // Show confidence result
                    const conf = parseFloat(data.confidence ?? 0);
                    confidenceText.textContent = conf.toFixed(2);
                    confidenceDisplay.classList.remove('d-none');

                    // Ubah warna bubble confidence
                    confidenceDisplay.className = 'position-absolute top-0 start-50 translate-middle-x mt-2 px-3 py-1 rounded-pill shadow-sm';
                    if (conf >= 90) {
                        confidenceDisplay.classList.add('bg-success', 'text-white');
                    } else if (conf >= 70) {
                        confidenceDisplay.classList.add('bg-warning', 'text-dark');
                    } else {
                        confidenceDisplay.classList.add('bg-danger', 'text-white');
                    }

                    // Tampilkan tombol submit jika valid
                    if (conf >= 80) {
                        submitBtn.classList.remove('d-none');
                    } else {
                        submitBtn.classList.add('d-none');
                    }
                    
                    // Stop the video stream
                    if (video.srcObject) {
                        const tracks = video.srcObject.getTracks();
                        tracks.forEach(track => track.stop());
                        video.srcObject = null;
                    }
                    
                    // Create a new image element to show the captured photo
                    const capturedImage = document.createElement('img');
                    capturedImage.src = dataURL;
                    capturedImage.className = 'rounded-lg shadow border w-100';
                    capturedImage.id = 'capturedImage';
                    
                    // Replace video with the captured image
                    video.style.display = 'none';
                    videoContainer.appendChild(capturedImage);
                    
                    // Add "Try Again" button under the image
                    const retakeButton = document.createElement('button');
                    retakeButton.className = 'btn btn-outline-secondary w-100 mt-2';
                    retakeButton.innerText = 'Ambil Foto Ulang';
                    retakeButton.onclick = function() {
                        // Remove captured image and "Try Again" button
                        document.getElementById('capturedImage').remove();
                        retakeButton.remove();
                        
                        // Hide confidence and submit button
                        confidenceDisplay.classList.add('d-none');
                        submitBtn.classList.add('d-none');
                        
                        // Show video again
                        video.style.display = 'block';
                        
                        // Restart camera
                        navigator.mediaDevices.getUserMedia({ video: true })
                            .then((stream) => {
                                video.srcObject = stream;
                            });
                    };
                    
                    // Add the retake button to the DOM after the image
                    videoContainer.appendChild(retakeButton);
                }, 300);
            }
            progressBar.style.width = finalProgress + '%';
            progressPercentage.textContent = Math.round(finalProgress);
        }, 30);
    })
    .catch(() => {
        // Clear intervals and hide loading
        clearInterval(fakeProcessing);
        loading.classList.add('d-none');
        
        // Show error
        confidenceText.textContent = 'Gagal';
        confidenceDisplay.className = 'position-absolute top-0 start-50 translate-middle-x mt-2 bg-danger text-white px-3 py-1 rounded-pill shadow-sm';
        confidenceDisplay.classList.remove('d-none');
        submitBtn.classList.add('d-none');
    });
}

// Add some styling for the attendance options
document.addEventListener('DOMContentLoaded', function() {
    const attendanceOptions = document.querySelectorAll('.attendance-option');
    
    attendanceOptions.forEach(option => {
        option.style.cursor = 'pointer';
        option.style.transition = 'transform 0.2s, box-shadow 0.2s';
        
        option.addEventListener('mouseover', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
        });
        
        option.addEventListener('mouseout', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
        });
    });
});
</script>

<style>
/* Enhanced styling for attendance selection cards */
.attendance-option {
    transition: all 0.3s ease;
    cursor: pointer;
}

.attendance-option:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.attendance-option .card-body {
    padding: 1.5rem;
}

/* Circle icons styling */
.rounded-circle {
    display: flex;
    align-items: center;
    justify-content: center;
}

.rounded-circle svg {
    width: 32px;
    height: 32px;
}
</style>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @include('guru.footer')

 
</body>