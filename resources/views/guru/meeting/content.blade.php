<head>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js')}}"></script>

    <!-- Toastr -->
    <link type="text/css" href="{{ asset('frontend/vendor/toastr.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{ asset('frontend/css/toastr.css')}}" rel="stylesheet">
</head>

<body>
    @if(session('success'))
        <script>
            $(document).ready(function () {
                toastr.success("{{ session('success') }}", "Well Done!", {
                    closeButton: true,
                    progressBar: true,
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            $(document).ready(function () {
                toastr.error("{{ session('error') }}", "Error!", {
                    closeButton: true,
                    progressBar: true,
                });
            });
        </script>
    @endif

    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Pertemuan</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Pertemuan</li>
                    </ol>
                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="{{ route('guru.meeting.create') }}" class="btn btn-outline-secondary">Tambah Pertemuan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Daftar Mata Pelajaran Anda</div>
        </div>

        @foreach($subjects as $subject)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <h5 class="card-header">                                                    {{ $subject->name }} - {{ $subject->kelas->name }}
</h5>
                       <div class="card-body">
                            <!-- Buttons for each meeting -->
                            <div class="scroll-container">
                                   @foreach($subject->meetings as $meeting)
        @if($meeting->user_id === auth()->id()) <!-- Memastikan hanya menampilkan meeting yang dibuat oleh pengguna yang sedang login -->
            <a class="btn btn-primary me-1 mt-3" data-bs-toggle="collapse"
                href="#collapseMeeting{{ $meeting->id }}" role="button" aria-expanded="false"
                aria-controls="collapseMeeting{{ $meeting->id }}">
                {{ $meeting->title }}
            </a>
        @endif
    @endforeach
         
</div>


                            <!-- Collapsible meeting sections -->
                            @foreach($subject->meetings as $meeting)
                                <div class="collapse mt-3" id="collapseMeeting{{ $meeting->id }}">
                                    <h2 class="text-primary mb-0">{{ $meeting->title }}</h2>
                                    <h6 class="text-muted mb-0">{{ \Carbon\Carbon::parse($meeting->formatted_meeting_time)->timezone('Asia/Jakarta')->translatedFormat('d M Y H:i') }}</h6>
                                    <p class="card-text">{{ $meeting->description }}</p>

                                    <!-- Check if there are tasks or materials -->
                                    <div class="mt-4">
                                        @if($meeting->tugas->isEmpty() && $meeting->materi->isEmpty())
                                            <p class="text-muted">Tidak ada tugas atau materi.</p>
                                        @else
                                            @if($meeting->materi->isNotEmpty())
                                                <h5 class="mb-2">Materi yang Ada:</h5>
                                                <div class="card mt-3 shadow-sm">
                                                    <div
                                                        class="card-header bg-info d-flex justify-content-between align-items-center text-white">
                                                        <h6 class="mb-0">Materi:</h6>
                                                        <a href="{{ route('guru.materi.index', ['meeting_id' => $meeting->id]) }}"
                                                            class="btn btn-sm btn-warning">Lihat Materi</a>
                                                    </div>
                                                    <div class="card-body mb-0 pb-0">
                                                        <ul class="list-unstyled">
                                                            @foreach ($meeting->materi as $materi)
                                                                <li
                                                                    class="mt-3 mb-2 pb-1 d-flex justify-content-between align-items-center">
                                                                    {{ $materi->judul }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-muted mt-3">Tidak ada materi.</p>
                                            @endif

                                            @if($meeting->tugas->isNotEmpty())
                                                <h5 class="mb-2">Tugas yang Ada:</h5>
                                                <div class="card mt-3 shadow-sm">
                                                    <div
                                                        class="card-header bg-success d-flex justify-content-between align-items-center text-white">
                                                        <h6 class="mb-0">Tugas:</h6>
                                                        <a href="{{ route('guru.tugas.index', ['meeting_id' => $meeting->id]) }}"
                                                            class="btn btn-sm btn-warning">Lihat Tugas</a>
                                                    </div>
                                                    <div class="card-body mb-0 pb-0">
                                                        <ul class="list-unstyled">
                                                            @foreach ($meeting->tugas as $tugas)
                                                                @if ($tugas->user_id == auth()->id())
                                                                    <li
                                                                        class="mt-3 mb-1 pb-1 d-flex justify-content-between align-items-center">
                                                                        {{ $tugas->judul }}
                                                                        <a href="{{ route('guru.tugas.review', $tugas->id) }}"
                                                                            class="btn btn-sm btn-info">Tinjau</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-muted mt-3">Tidak ada tugas.</p>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Form for adding Tasks and Materials -->
                                    <div class="mt-4">
                                        <h5 class="mb-2">Tambah Materi Dan Tugas</h5>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('guru.materi.createM', ['meeting_id' => $meeting->id]) }}"
                                                class="btn btn-outline-info btn-sm">Tambah Materi</a>
                                            <a href="{{ route('guru.tugas.createM', $meeting->id) }}"
                                                class="btn btn-outline-success btn-sm">Tambah Tugas</a>
                                        </div>
                                    </div>

                                    <!-- Button to go to Tasks and Materials Index -->
                                    <div class="d-flex justify-content">
                                        <a href="{{ route('guru.meeting.edit', $meeting->id) }}"
                                            class="btn btn-primary mt-2">Edit Pertemuan</a>
                                    </div>
                                    <!-- Thicker divider between meetings -->
                                    <div class="border-top border-3 mt-4"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination Links -->
        <div class="mb-32pt">
            <ul class="pagination justify-content-start pagination-xsm m-0">
                <!-- Previous Button -->
                <li class="page-item {{ $subjects->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $subjects->previousPageUrl() }}" aria-label="Previous" {{ $subjects->onFirstPage() ? 'tabindex="-1"' : '' }}>
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

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFve2DkPb3mI6Y9P+NqE7Ulh6eL7awh1Evi9WJ7SkVo5lGujoFIE6b7C1y"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            // Additional toastr settings (optional)
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000", // 5 seconds
            };
        });
    </script>
</body>