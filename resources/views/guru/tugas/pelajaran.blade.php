<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Pelajaran - Materi</title>
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
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Pelajaran - Tugas</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item active">Pelajaran</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container page__container page-section">
                <div class="row" id="subject-cards">
                    @foreach($subjects->chunk(4) as $subjectChunk)
                        <div class="row">
                            @foreach($subjectChunk as $subject)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subject-image mb-3">
                                                <img src="{{ asset('storage/pelajaran/' . $subject->image) }}"
                                                    alt="{{ $subject->name }}" class="img-fluid"
                                                    style="width: 100%; height: 150px; object-fit: cover;">
                                            </div>
                                            <h5 class="card-title mb-3 d-flex align-items-center">
                                                {{ $subject->name }}
                                                <span class="chip chip-outline-secondary ms-2 d-inline-flex align-items-center px-2 py-1 small text-capitalize">{{ $subject->kelas->name}}</span>
                                            </h5>
                                            <!-- Check if meetings exist for the subject -->
                                            @if($subject->meetings->isNotEmpty())
                                                @php
                                                    // Filter meetings based on user_id that is currently logged in
                                                    $userMeetings = $subject->meetings->filter(function ($meeting) {
                                                        return $meeting->user_id === auth()->id();
                                                    });
                                                @endphp

                                                @if($userMeetings->count() > 2)
                                                    <!-- Dropdown button if meetings exceed 2 -->
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-sm btn-warning dropdown-toggle" type="button"
                                                                id="dropdownMenuButton-{{ $subject->id }}" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-tasks mr-1"></i> Tugas - Pertemuan
                                                        </button>
                                                        <div class="dropdown-menu bg-warning" aria-labelledby="dropdownMenuButton-{{ $subject->id }}">
                                                            @foreach($userMeetings as $meeting)
                                                                <a class="dropdown-item text-white"
                                                                   href="{{ route('guru.tugas.index', ['meeting_id' => $meeting->id]) }}">
                                                                    <i class="fas fa-tasks mr-1"></i> {{ $meeting->title }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- Show individual buttons if 2 or fewer meetings -->
                                                    @foreach($userMeetings as $meeting)
                                                        <a href="{{ route('guru.tugas.index', ['meeting_id' => $meeting->id]) }}"
                                                           class="btn btn-sm btn-warning"><i class="fas fa-tasks mr-1"></i>{{ $meeting->title }}</a>
                                                    @endforeach
                                                @endif
                                            @else
                                                <!-- If no meetings, inform the user -->
                                                <p class="text-card">Pertemuan Belum Ada</p>
                                            @endif

                                            <!-- Always show the "Buat Pertemuan" button below the meetings section -->
                                            <a href="{{ route('guru.meeting.createS', ['subject_id' => $subject->id]) }}"
                                               class="btn btn-sm btn-primary d-inline-block">Buat Pertemuan</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="mb-32pt">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $subjects->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $subjects->previousPageUrl() }}" aria-label="Previous"
                                {{ $subjects->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $subjects->lastPage(); $i++)
                            <li class="page-item {{ $i == $subjects->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $subjects->url($i) }}" aria-label="Page {{ $i }}">
                                    <span>{{ $i }}</span>
                                </a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $subjects->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $subjects->nextPageUrl() }}" aria-label="Next" {{ $subjects->hasMorePages() ? '' : 'tabindex="-1"' }}>
                                <span>Next</span>
                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                            </a>
                        </li>
                    </ul>
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

</body>

</html>
