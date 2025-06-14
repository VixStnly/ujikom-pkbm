<!-- HTML -->
@include('content.html')

<head>
    @include('content.style')
</head>

<body class="layout-sticky-subnav layout-learnly">
    @include('layouts.NavSiswa')
    @include('content.sidemenu')
    @extends('content.js')

    <!-- Header Layout -->

    <div class="mdk-header-layout js-mdk-header-layout">
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">

                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">Pembelajaran @foreach($user->kelas as $kelas)
                                {{ $kelas->name }}
                                @endforeach
                            </h1>
                        </div>
                        <div class="ml-lg-16pt mr-auto"> <!-- Added ml-auto to move the button to the right -->
                            <a href="/profile" class="btn btn-light">My Profile</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="page-section">
                <div class="container page__container">

                    <div class="row">
                        <div class="col-lg-8">

                            <div class="page-separator">
                                <div class="page-separator__text">Mata Pelajaran</div>
                            </div>

                            {{-- resources/views/siswa/Pembelajaran.blade.php --}}
                            <div class="row card-group-row">
                                @if($subjects->isEmpty())

                                <div class="flex justify-center align-items-center"
                                    style="max-width: 100%;">
                                    <div class="alert alert-primary w-100"
                                        role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="material-icons mr-2">access_time</i>
                                            <div>
                                                <strong class="d-block">Tidak Ada Pembelajaran</strong>
                                                <small class="text-muted">Belum ada pembelajaran yang tersedia saat ini. Silakan cek kembali nanti.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @else
                                @foreach($subjects as $subject)
                                <div class="col-12 col-sm-6 col-md-4"> <!-- Added responsive column classes -->
                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                        data-partial-height="44"
                                        data-toggle="popover"
                                        data-trigger="click">

                                        <a href="{{ route('meetings.index', $subject->id) }}" class="js-image" data-position="">
                                            @if($subject->image)
                                            <img src="{{ asset('storage/pelajaran/' . $subject->image) }}" class="card-img-top" alt="{{ $subject->name }}">
                                            @else
                                            <div class="position-relative">
                                                <img src="{{ asset('images/achievements/cover-pembelajaran.png') }}" class="card-img-top p-5" alt="{{ $subject->name }}">
                                                <div class="card-img-overlay d-flex justify-content-center align-items-center pt-4">
                                                    <h1 class="title-shadow text-center">{{ $subject->name }}</h1>
                                                </div>
                                            </div>
                                            @endif

                                            <!-- Image fallback -->
                                            <span class="overlay__content align-items-start justify-content-start">
                                                <span class="overlay__action card-body d-flex align-items-center">
                                                    <i class="material-icons mr-4pt">play_circle_outline</i>
                                                    <span class="card-title text-white">Preview</span>
                                                </span>
                                            </span>
                                        </a>

                                        <div class="mdk-reveal__content">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex">
                                                        <a class="card-title" href="{{ route('meetings.index', $subject->id) }}">{{ $subject->name }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>

                        </div>
                        <div class="col-lg-4">

                            <div id="carouselExampleFade" class="carousel carousel-card slide mb-24pt">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="card border-0 mb-0 shadow-sm" href="javascript:void(0);">
                                            <img src="{{ asset('frontend/images/achievements/banner-pembalajaran.gif') }}" alt="Flinto"
                                                class="card-img" style="max-height: 100%; width: initial;">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="page-separator">
                                <div class="page-separator__text">Pengumuman</div>
                            </div>

                            @foreach ($announcements as $announcement)
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="student-course.html" class="card-title mb-4pt">{{ $announcement->title }}</a>
                                        <p class="lh-1 mb-0">
                                            <small class="text-muted mr-8pt">
                                                {!! Str::limit(strip_tags($announcement->description), 35) !!}
                                            </small>
                                        </p>
                                    </div>
                                    <small class="text-muted ml-3">
                                        @if ($announcement->created_at)
                                        {{ $announcement->created_at->diffForHumans() }}
                                        @else
                                        Tanggal tidak tersedia
                                        @endif
                                    </small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            @include ('Page.footer')
        </div>

        <style>
            .title-shadow {
                font-family: 'Comic Sans MS', cursive, sans-serif;
                font-weight: bold;
                font-size: 2rem;
                color: #f1f1f1;
                text-shadow:
                    -2px -2px 0 #003366,
                    2px -2px 0 #003366,
                    -2px 2px 0 #003366,
                    2px 2px 0 #003366;
                padding: 10px;
                text-align: center;
                border-radius: 12px;
                line-height: 1.1;
                margin: 0;
                margin-top: 20px;
            }
        </style>

</body>