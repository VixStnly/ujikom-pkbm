<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 20px 0;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .meeting-card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            margin-bottom: 25px;
            background-color: #fff;
        }
        
        .meeting-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        
        .meeting-header {
            border-radius: 8px 8px 0 0;
            padding: 15px 20px;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
        }
        
        /* Improved meeting button styles */
        .meetings-container {
            background-color: #edf2f7;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 15px;
        }
        
        .meeting-button {
            background-color: #fff;
            color: #495057;
            border: 1px solid #cdd4e0;
            border-radius: 6px;
            margin: 5px;
            padding: 10px 15px;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            font-weight: 500;
        }
        
        .meeting-button:hover {
            background-color: #e9ecef;
            border-color: #4e73df;
        }
        
        .meeting-button.active {
            background-color: #4e73df;
            color: white;
            border-color: #4e73df;
            box-shadow: 0 2px 6px rgba(78,115,223,0.3);
        }
        
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .material-section, .task-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #e9ecef;
        }
        
        .material-header {
            background-color: #36b9cc;
            color: white;
            border-radius: 6px;
            padding: 10px 15px;
        }
        
        .task-header {
            background-color: #1cc88a;
            color: white;
            border-radius: 6px;
            padding: 10px 15px;
        }
        
        .add-section {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .pagination {
            margin-top: 30px;
        }
        
        .btn-custom-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            color: white;
        }
        
        .btn-custom-success {
            background-color: #1cc88a;
            border-color: #1cc88a;
            color: white;
        }
        
        .btn-custom-info {
            background-color: #36b9cc;
            border-color: #36b9cc;
            color: white;
        }

        .item-list {
            list-style: none;
            padding-left: 0;
        }
        
        .item-list li {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .item-list li:last-child {
            border-bottom: none;
        }
        
        .meeting-details {
            display: none;
            padding: 20px;
            background-color: #fff;
            border-radius: 0 0 8px 8px;
            border-top: 1px solid #e9ecef;
        }
        
        .meeting-details.show {
            display: block;
        }
        
        .badge-date {
            background-color: #f8f9fa;
            color: #6c757d;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: normal;
        }
        
        /* Close button for meeting details */
        .close-details {
            cursor: pointer;
            float: right;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #6c757d;
            background-color: transparent;
            border: 0;
            padding: 0.25rem 0.5rem;
            margin: -1rem -0.5rem -1rem auto;
        }
        
        .close-details:hover {
            color: #4e73df;
        }
        
        /* Meeting label - show only when no meeting is selected */
        .no-meeting-selected {
            padding: 40px 20px;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Toast Notifications -->
    <div id="toast-container" class="position-fixed top-0 end-0 p-3"></div>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="mb-0">Manajemen Pertemuan</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Beranda</a></li>
                            <li class="breadcrumb-item active">Pertemuan</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('guru.meeting.create') }}" class="btn btn-custom-primary">
                        <i class='bx bx-plus-circle me-1'></i> Tambah Pertemuan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container pb-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <div class="border-bottom border-2 border-primary flex-grow-1"></div>
                    <h4 class="mx-3 mb-0">Daftar Mata Pelajaran Anda</h4>
                    <div class="border-bottom border-2 border-primary flex-grow-1"></div>
                </div>
            </div>
        </div>

        <!-- Subject List -->
        @foreach($subjects as $subject)
        <div class="meeting-card">
            <div class="meeting-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white" >{{ $subject->name }} - {{ $subject->kelas->name }}</h4>
                <span class="badge bg-light text-dark">{{ $subject->meetings->where('user_id', auth()->id())->count() }} Pertemuan</span>
            </div>
            
            <div class="p-4">
                <!-- Meeting Buttons with improved container -->
                <h5 class="mb-3">Daftar Pertemuan:</h5>
                <div class="meetings-container">
                    <div class="d-flex overflow-auto pb-2">
                        @foreach($subject->meetings as $meeting)
                            @if($meeting->user_id === auth()->id())
                                <button class="meeting-button" 
                                        onclick="toggleMeeting('meeting{{ $meeting->id }}', '{{ $subject->id }}')">
                                    {{ $meeting->title }}
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
                
                <!-- Default message when no meeting is selected -->
                <div id="noMeeting{{ $subject->id }}" class="no-meeting-selected">
                    <i class='bx bx-selection fs-1 text-muted'></i>
                    <h5 class="mt-3">Pilih pertemuan untuk melihat detail</h5>
                    <p class="text-muted">Klik pada salah satu pertemuan di atas untuk menampilkan materi dan tugas</p>
                </div>
                
                <!-- Meeting Details Sections -->
                @foreach($subject->meetings as $meeting)
                    @if($meeting->user_id === auth()->id())
                        <div id="meeting{{ $meeting->id }}" class="meeting-details">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="text-primary mb-2">{{ $meeting->title }}</h3>
                                    <span class="badge-date">
                                        <i class='bx bx-calendar me-1'></i>
                                        {{ \Carbon\Carbon::parse($meeting->formatted_meeting_time)->timezone('Asia/Jakarta')->translatedFormat('d M Y H:i') }}
                                    </span>
                                </div>
                                <button type="button" class="close-details" onclick="closeMeeting('{{ $subject->id }}')">
                                    <i class='bx bx-x'></i>
                                </button>
                            </div>
                            
                            <p>{{ $meeting->description }}</p>
                            
                            <div class="card-actions mb-4 d-flex gap-2">
    <a href="{{ route('guru.meeting.edit', $meeting->id) }}" 
       class="btn btn-primary d-flex align-items-center">
        <i class='bx bx-edit me-1'></i> Edit Pertemuan
    </a>
    <a href="{{ route('forum.index', $meeting->id) }}" 
       class="btn btn-info d-flex align-items-center">
        <i class='bx bx-message-square-dots me-1'></i> Forum Diskusi
    </a>
    <a href="{{ route('guru.kelas.siswa', ['kelas' => $subject->kelas->id, 'meetingId' => $meeting->id]) }}"
       class="btn btn-success d-flex align-items-center">
        <i class='bx bx-user-check me-1'></i> Lihat Siswa yang Hadir
    </a>
</div>
                            
                            <div class="row">
                                <!-- Materials Section -->
                                <div class="col-md-6">
                                    <div class="material-section">
                                        <div class="material-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Materi Pertemuan</h5>
                                            <a href="{{ route('guru.materi.index', ['meeting_id' => $meeting->id]) }}" class="btn btn-sm btn-light">
                                                <i class='bx bx-book-open me-1'></i> Lihat Semua
                                            </a>
                                        </div>
                                        
                                        <div class="mt-3">
                                            @if($meeting->materi->isNotEmpty())
                                                <ul class="item-list">
                                                    @foreach ($meeting->materi as $materi)
                                                        <li>
                                                            <span>{{ $materi->judul }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <div class="text-center py-4">
                                                    <i class='bx bx-info-circle fs-1 text-muted'></i>
                                                    <p class="text-muted mt-2">Belum ada materi</p>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="text-center mt-3">
                                            <a href="{{ route('guru.materi.createM', ['meeting_id' => $meeting->id]) }}" class="btn btn-custom-info w-100">
                                                <i class='bx bx-plus-circle me-1'></i> Tambah Materi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Tasks Section -->
                                <div class="col-md-6">
                                    <div class="task-section">
                                        <div class="task-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Tugas Pertemuan</h5>
                                            <a href="{{ route('guru.tugas.index', ['meeting_id' => $meeting->id]) }}" class="btn btn-sm btn-light">
                                                <i class='bx bx-task me-1'></i> Lihat Semua
                                            </a>
                                        </div>
                                        
                                        <div class="mt-3">
                                            @if($meeting->tugas->where('user_id', auth()->id())->isNotEmpty())
                                                <ul class="item-list">
                                                    @foreach ($meeting->tugas as $tugas)
                                                        @if ($tugas->user_id == auth()->id())
                                                            <li>
                                                                <span>{{ $tugas->judul }}</span>
                                                                <a href="{{ route('guru.tugas.review', $tugas->id) }}" class="btn btn-sm btn-custom-primary">
                                                                    <i class='bx bx-check-circle me-1'></i> Tinjau
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @else
                                                <div class="text-center py-4">
                                                    <i class='bx bx-task-x fs-1 text-muted'></i>
                                                    <p class="text-muted mt-2">Belum ada tugas</p>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="text-center mt-3">
                                            <a href="{{ route('guru.tugas.createM', $meeting->id) }}" class="btn btn-custom-success w-100">
                                                <i class='bx bx-plus-circle me-1'></i> Tambah Tugas
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endforeach

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $subjects->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $subjects->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                
                @for ($i = 1; $i <= $subjects->lastPage(); $i++)
                    <li class="page-item {{ $i == $subjects->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $subjects->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                
                <li class="page-item {{ $subjects->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $subjects->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/vendor/toastr.min.js') }}"></script>
    
    <script>
        // Show success and error notifications
        $(document).ready(function() {
            @if(session('success'))
                toastr.success("{{ session('success') }}", "Berhasil!", {
                    closeButton: true,
                    progressBar: true,
                });
            @endif
            
            @if(session('error'))
                toastr.error("{{ session('error') }}", "Error!", {
                    closeButton: true,
                    progressBar: true,
                });
            @endif
            
            // Show the default "no meeting selected" message for each subject
            document.querySelectorAll('.no-meeting-selected').forEach(el => {
                el.style.display = 'block';
            });
        });
        
        // Toggle meeting details
        function toggleMeeting(id, subjectId) {
            // Hide the "no meeting selected" message
            document.getElementById('noMeeting' + subjectId).style.display = 'none';
            
            // Hide all meeting details for this subject
            document.querySelectorAll('.meeting-details').forEach(el => {
                el.classList.remove('show');
            });
            
            // Show the selected meeting details
            document.getElementById(id).classList.add('show');
            
            // Update button styles - make the clicked button active
            document.querySelectorAll('.meeting-button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('onclick').includes(id)) {
                    btn.classList.add('active');
                }
            });
        }
        
        // Close meeting details
        function closeMeeting(subjectId) {
            // Hide all meeting details
            document.querySelectorAll('.meeting-details').forEach(el => {
                el.classList.remove('show');
            });
            
            // Reset all button styles
            document.querySelectorAll('.meeting-button').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show the "no meeting selected" message
            document.getElementById('noMeeting' + subjectId).style.display = 'block';
        }
    </script>
</body>
</html>