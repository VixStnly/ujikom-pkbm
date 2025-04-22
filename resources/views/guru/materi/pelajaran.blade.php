<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Pelajaran - Materi</title>
    <style>
        /* Custom styles to improve user experience */
        .subject-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
        }
        
        .subject-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .subject-thumbnail {
            height: 160px;
            object-fit: cover;
            width: 100%;
            border-radius: 8px;
        }
        
        .subject-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .class-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 30px;
            background-color: #f8f9fa;
            color: #6c757d;
            margin-left: 8px;
            border: 1px solid #dee2e6;
        }
        
        .meeting-container {
            margin-bottom: 15px;
        }
        
        .meeting-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .breadcrumb {
            background: none;
            padding: 0;
        }
        
        .page-header {
            padding: 20px 0;
            background-color: #f8f9fa;
            margin-bottom: 30px;
        }
        
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .btn-meeting {
            transition: all 0.2s;
        }
        
        .btn-meeting:hover {
            transform: scale(1.05);
        }
        
        /* Meeting modal specific styles */
        .meeting-count-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            margin-left: 5px;
            display: inline-block;
            min-width: 20px;
            text-align: center;
        }
        
        /* Fixed modal styles to ensure visibility */
        .meetings-modal {
            z-index: 1050;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .meetings-modal .modal-content {
            background-color: #fff;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }
        
        .meeting-list-item {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
            cursor: pointer;
        }
        
        .meeting-list-item:hover {
            background-color: #f8f9fa;
        }
        
        .meeting-list-item:last-child {
            border-bottom: none;
        }
        
        /* Maintain original styles required for sidebar */
        .layout-app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>

<body class="layout-app">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')

            <!-- Notifications -->
            @if (session('success'))
            <div class="container alert alert-success">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="container alert alert-danger">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
            @endif

            <!-- Page Header -->
            <div class="page-header">
                <div class="container page__container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-0">Pelajaran - Materi</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mr-1"></i>Beranda</a></li>
                                <li class="breadcrumb-item active">Pelajaran</li>
                            </ol>
                        </div>
                        <div class="col-md-4 text-md-right">
                            <button class="btn btn-primary" id="helpBtn">
                                <i class="fas fa-question-circle mr-1"></i> Bantuan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="container page__container page-section">
                <div class="row" id="subject-cards">
                    @foreach($subjects as $subject)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card subject-card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="subject-image mb-3">
                                    <img src="{{ asset('storage/pelajaran/' . $subject->image) }}"
                                        alt="{{ $subject->name }}" class="subject-thumbnail">
                                </div>
                                
                                <div class="subject-header">
                                    <h5 class="card-title mb-0">{{ $subject->name }}</h5>
                                    <span class="class-badge">
                                        <i class="fas fa-users mr-1"></i>{{ $subject->kelas->name }}
                                    </span>
                                </div>

                                @php
                                $userMeetings = $subject->meetings->where('user_id', auth()->id());
                                @endphp

                                <div class="meeting-container">
                                    <h6 class="text-muted mb-2"><i class="fas fa-calendar-alt mr-1"></i> Pertemuan</h6>
                                    
                                    @if($userMeetings->isEmpty())
                                    <p class="text-muted small">Belum ada pertemuan untuk mata pelajaran ini.</p>
                                    @else
                                        <div class="meeting-buttons">
                                            @if($userMeetings->count() > 1)
                                            <!-- Use Sweet Alert instead of Bootstrap modal -->
                                            <button type="button" class="btn btn-outline-primary btn-block show-meetings-btn" 
                                                    data-subject-id="{{ $subject->id }}"
                                                    data-subject-name="{{ $subject->name }}">
                                                <i class="fas fa-list-ul mr-1"></i>Lihat Pertemuan
                                                <span class="meeting-count-badge">{{ $userMeetings->count() }}</span>
                                            </button>
                                            <!-- Hidden data for meetings -->
                                            <div id="meetings-data-{{ $subject->id }}" style="display: none;">
                                                @foreach($userMeetings as $meeting)
                                                <div class="meeting-data" 
                                                     data-title="{{ $meeting->title }}" 
                                                     data-url="{{ route('guru.materi.index', ['meeting_id' => $meeting->id]) }}">
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                                @foreach($userMeetings as $meeting)
                                                <a href="{{ route('guru.materi.index', ['meeting_id' => $meeting->id]) }}"
                                                    class="btn btn-outline-primary btn-meeting">
                                                    <i class="fas fa-file-alt mr-1"></i>{{ $meeting->title }}
                                                </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('guru.meeting.createS', ['subject_id' => $subject->id]) }}"
                                        class="btn btn-primary btn-block">
                                        <i class="fas fa-plus-circle mr-1"></i>Buat Pertemuan Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($subjects->lastPage() > 1)
                <div class="mb-32pt">
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item {{ $subjects->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $subjects->previousPageUrl() }}" aria-label="Previous"
                                {{ $subjects->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <i class="fas fa-chevron-left mr-1"></i>
                                <span>Sebelumnya</span>
                            </a>
                        </li>

                        @foreach(range(1, $subjects->lastPage()) as $i)
                            @if($i == 1 || $i == $subjects->lastPage() || abs($i - $subjects->currentPage()) < 2)
                            <li class="page-item {{ $i == $subjects->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $subjects->url($i) }}">{{ $i }}</a>
                            </li>
                            @elseif(abs($i - $subjects->currentPage()) == 2)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                            @endif
                        @endforeach

                        <li class="page-item {{ $subjects->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $subjects->nextPageUrl() }}" aria-label="Next"
                                {{ $subjects->hasMorePages() ? '' : 'tabindex="-1"' }}>
                                <span>Selanjutnya</span>
                                <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                @endif

            </div>
            @include('guru.footer')
        </div>
        @include('layouts.sidebarGuru')
    </div>

    <!-- Original Scripts -->
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
    
    <!-- Script for meetings modal and help button -->
    <script>
        $(document).ready(function() {
            // Help button functionality
            $('#helpBtn').on('click', function() {
                Swal.fire({
                    title: 'Bantuan Halaman Pelajaran',
                    html: `
                        <div class="text-left">
                            <p><b>Di halaman ini, Anda dapat:</b></p>
                            <ul>
                                <li>Melihat semua mata pelajaran yang tersedia</li>
                                <li>Mengakses pertemuan yang sudah ada</li>
                                <li>Membuat pertemuan baru untuk setiap mata pelajaran</li>
                            </ul>
                            <p><b>Petunjuk penggunaan:</b></p>
                            <ol>
                                <li>Klik tombol "Lihat Pertemuan" untuk melihat daftar pertemuan</li>
                                <li>Pilih salah satu pertemuan untuk melihat materi yang tersedia</li>
                                <li>Klik "Buat Pertemuan Baru" untuk menambahkan pertemuan baru</li>
                            </ol>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Mengerti'
                });
            });
            
            // Using SweetAlert2 for meetings list instead of Bootstrap modal
            $('.show-meetings-btn').on('click', function() {
                const subjectId = $(this).data('subject-id');
                const subjectName = $(this).data('subject-name');
                
                // Get meeting data
                const meetingsData = [];
                $(`#meetings-data-${subjectId} .meeting-data`).each(function() {
                    meetingsData.push({
                        title: $(this).data('title'),
                        url: $(this).data('url')
                    });
                });
                
                // Generate HTML for meeting list
                let meetingsHtml = '';
                meetingsData.forEach(meeting => {
                    meetingsHtml += `
                    <div class="meeting-list-item" onclick="window.location.href='${meeting.url}'">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file-alt mr-2"></i>
                                <span>${meeting.title}</span>
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </div>
                    </div>`;
                });
                
                // Show SweetAlert with meetings list
                Swal.fire({
                    title: `Pertemuan untuk ${subjectName}`,
                    html: `<div class="text-left">${meetingsHtml}</div>`,
                    width: '500px',
                    showCloseButton: true,
                    showConfirmButton: false,
                    focusConfirm: false,
                    customClass: {
                        container: 'meetings-modal-container',
                        popup: 'meetings-modal-popup',
                        content: 'meetings-modal-content'
                    }
                });
            });
            
            // Add hover effect for better UX
            $('.subject-card').hover(
                function() { $(this).addClass('shadow-lg'); },
                function() { $(this).removeClass('shadow-lg'); }
            );
        });
    </script>
</body>

</html>