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
                                <div class="alert alert-info text-center" style="margin-top: 20px;">
                                    <h4 class="alert-heading">Belum Ada Pelajaran</h4>
                                    <p>Anda belum memiliki pelajaran atau tugas. Silakan hubungi guru untuk informasi lebih lanjut.</p>
                                    <a href="" class="btn btn-primary">Lihat Kursus Tersedia</a>
                                </div>
                                @else
                                @foreach($subjects as $subject)
                                <div class="col-12 col-sm-6 col-md-4"> <!-- Added responsive column classes -->
                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                        data-partial-height="44"
                                        data-toggle="popover"
                                        data-trigger="click">

                                        <a href="{{ route('meetings.index', $subject->id) }}" class="js-image" data-position="">
                                            <img src="{{ $subject->image ? asset('storage/pelajaran/'.$subject->image) : asset('frontend/images/paths/mailchimp_430x168.png') }}"
                                                alt="{{ $subject->name }}"
                                                class="img-fluid"
                                                style="width: 100%; height: 150px; object-fit: cover;">
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

                            <div class="page-separator">
                                <div class="page-separator__text">-</div>
                            </div>

                            <div id="carouselExampleFade" class="carousel carousel-card slide mb-24pt">
                                <div class="carousel-inner">

                                    <div class="carousel-item active">

                                        <a class="card border-0 mb-0" href="">
                                            <img src="{{ asset('frontend/images/achievements/gif.gif') }}" alt="Flinto"
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

</body>