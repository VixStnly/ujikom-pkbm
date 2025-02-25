<!-- Include Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
<!-- Toastr -->
<link type="text/css" href="{{ asset('frontend/vendor/toastr.min.css')}}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/toastr.css')}}" rel="stylesheet">

@if(session('success'))
<script>
    $(document).ready(function() {
        toastr.success("{{ session('success') }}", "Well Done!", {
            closeButton: true,
            progressBar: true,
        });
    });
</script>
@endif

@if(session('error'))
<script>
    $(document).ready(function() {
        toastr.error("{{ session('error') }}", "Error!", {
            closeButton: true,
            progressBar: true,
        });
    });
</script>
@endif

<div class="pt-5">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-3 mb-md-0">
            <div class="mb-sm-0 me-sm-4">
                <h2 class="mb-0">Materi</h2>
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('guru.materi.pelajaran') }}">pelajaran</a></li>
                    <li class="breadcrumb-item active">Materi</li>
                </ol>
            </div>
        </div>

        <div class="row" role="tablist">
            <div class="col-auto">
                <a href="{{ route('guru.materi.create') }}" class="btn btn-outline-secondary">Tambah Materi</a>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container page__container page-section">

    <div class="page-separator">
        <div class="page-separator__text">Materi Anda</div>
    </div>

    <div class="alert alert-secondary mb-3" role="alert">
        <div class="d-flex align-items-start">
            <div class="me-2">
                <i class="material-icons toggle-info">info</i>
            </div>
            <div class="flex" style="min-width: 180px; margin-top: 3px;">
                <small class="text-black-100">
                    Gambar akan muncul ketika Tugas terhubung dengan Pertemuan.
                </small>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($materis as $materi)
        @if(!$selectedMeetingId || $materi->meeting_id == $selectedMeetingId)
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card card-sm card--elevated position-relative overflow-hidden overlay overlay--secondary js-overlay mdk-reveal js-mdk-reveal"
                data-partial-height="44" data-toggle="popover" data-trigger="click" data-html="true" data-content=" <!-- Popover content -->
                                                                                            <div class='popoverContainer'>
                                                                                                <div class='media'>
                                                                                                    <div class='media-left mr-12pt'>
                                                                                                        @if($materi->meeting && $materi->meeting->subject && $materi->meeting->subject->image)
                                                                                                            <img src='{{ asset('storage/pelajaran/' . $materi->meeting->subject->image) }}'
                                                                                                                width='40' height='40' alt='{{ $materi->meeting->subject->title }}' class='rounded'>
                                                                                                        @else
                                                                                                            <svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' fill='currentColor' class='bi bi-file-earmark' viewBox='0 0 16 16'>
                                                                                                                <path d='M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13.5 4H9a1 1 0 0 1-1-1V.5H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z'/>
                                                                                                            </svg>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class='media-body'>
                                                                                                        <div class='card-title mb-0'>{{ $materi->judul }}</div>
                                                                                                        <p class='lh-1 mb-0'>
                                                                                                            <span class='text-50 small'>by</span>
                                                                                                            <span class='text-50 small font-weight-bold'>{{ $materi->guru->name }}</span>
                                                                                                        </p>
                                                                                                        @if($materi->meeting && $materi->meeting->subject && $materi->meeting->subject->image)
                                                                                                            <span class='text-50 small'>Kelas: {{ $materi->meeting->subject->kelas_id ? $materi->meeting->subject->kelas_id : 'Belum ada kelas' }}</span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class='row align-items-center'>
                                                                                                    <div class='col-auto'>
                                                                                                        <div class='d-flex align-items-center mb-4pt'>
                                                                                                            <span class='material-icons icon-16pt text-50 mr-4pt'>access_time</span>
                                                                                                           <p class='flex text-50 lh-1 mb-0'>
                                                                                                                <small>
                                                                                                                    @if ($materi->created_at->diffInWeeks(now()) >= 2)
                                                                                                                        {{ $materi->created_at->locale('id')->translatedFormat('d M Y') }}
                                                                                                                    @else
                                                                                                                        {{ $materi->created_at->locale('id')->diffForHumans() }}
                                                                                                                    @endif
                                                                                                                </small>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class='col text-right'>
                                                                                                        <a href='{{ route('guru.materi.edit', $materi->id) }}' class='btn btn-primary'>Edit Materi</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>">
                <a href="javascript:void(0);" class="js-image">
                    @if($materi->meeting && $materi->meeting->subject && $materi->meeting->subject->image)
                    <img src="{{ asset('storage/pelajaran/' . $materi->meeting->subject->image) }}"
                        alt="{{ $materi->judul }}" class="img-fluid"
                        style="width: 208px; height: 168px; object-fit: cover;">
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="208" height="168" fill="currentColor"
                        class="bi bi-file-earmark" viewBox="0 0 16 16">
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5z" />
                    </svg>
                    @endif
                    <span class="overlay__content align-items-start justify-content-start">
                        <span class="overlay__action card-body d-flex align-items-center">
                            <i class="material-icons me-2">edit</i>
                            <span class="card-title text-white">Edit</span>
                        </span>
                    </span>
                </a>
                <div class="mdk-reveal__content">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title mb-4pt" href="{{ route('guru.materi.edit', $materi->id) }}">
                                    {{ $materi->judul }}
                                </a>
                            </div>
                            <a href="{{ route('guru.materi.edit', $materi->id) }}"
                                class="ms-4 material-icons text-20 card-subject__icon-favorite">edit</a>
                        </div>
                        <div class="d-flex">
                            <small class="text-50">{{ $materi->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mb-32pt">
        <ul class="pagination justify-content-start pagination-xsm m-0">
            <!-- Previous Button -->
            <li class="page-item {{ $materis->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $materis->previousPageUrl() }}" aria-label="Previous" {{ $materis->onFirstPage() ? 'tabindex="-1"' : '' }}>
                    <span aria-hidden="true" class="material-icons">chevron_left</span>
                    <span>Prev</span>
                </a>
            </li>

            <!-- Page Numbers -->
            @for ($i = 1; $i <= $materis->lastPage(); $i++)
                <li class="page-item {{ $i == $materis->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $materis->url($i) }}" aria-label="Page {{ $i }}">
                        <span>{{ $i }}</span>
                    </a>
                </li>
                @endfor

                <!-- Next Button -->
                <li class="page-item {{ $materis->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $materis->nextPageUrl() }}" aria-label="Next" {{ $materis->hasMorePages() ? '' : 'tabindex="-1"' }}>
                        <span>Next</span>
                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                    </a>
                </li>
        </ul>
    </div>
    <div class="mt-3">
        <a href="{{ route('guru.materi.pelajaran') }}"
            class="btn btn-danger py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300">
            Kembali
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Additional toastr settings (optional)
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000", // 5 seconds
        };
    });

    function filterMateri() {
        const meetingFilter = document.getElementById('meeting-filter');
        const meetingId = meetingFilter.value;

        // Redirect ke halaman dengan meeting_id yang dipilih
        if (meetingId) {
            window.location.href = "{{ route('guru.materi.index') }}?meeting_id=" + meetingId;
        } else {
            window.location.href = "{{ route('guru.materi.index') }}"; // Kembali ke semua materi jika tidak ada filter
        }
    }
</script>