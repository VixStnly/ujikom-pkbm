<!-- HTML -->
@include ('content.html')

<head>
    <!-- Style Css -->
    @include ('content.style')
</head>
<body class="layout-sticky-subnav layout-learnly">
    @include ('layouts.NavSiswa')  
    <div style="z-index: 100;">
    @include('content.sidemenu') 
    </div>
    @extends ('content.js')

    <!-- ISI KONTEN DISINI -->
    <!-- ISI KONTEN DISINI -->
<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

                <div class="page-section bg-alt border-bottom-2">
                    <div class="container page__container">

                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                                <div class="flex">
                                    <h1 class="h2 m-0">MATERI : {{ $materi->judul }}</h1>
                                </div>
                            </div>
                            <div class="ml-lg-16pt">
                                <a href="#"
                                   class="btn btn-light">Kembali</a>
                            </div>
                        </div>

                    </div>
                </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">
                   <!-- YouTube Video Player -->
<div>
    @php
        $videoUrl = $materi->link;
        // Memeriksa apakah URL adalah link YouTube
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches);
        $videoId = isset($matches[1]) ? $matches[1] : null;
    @endphp

    @if($videoId)
        <!-- Menampilkan video jika link adalah link YouTube -->
        <div class="js-player card bg-primary text-center embed-responsive embed-responsive-16by9 mb-24pt">
            <div class="player embed-responsive-item">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    @else
        <!-- Menampilkan satu card jika link bukan link YouTube -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-24pt">
            <h3 class="text-xl font-semibold mb-4">Link Materi Tersedia</h3>
            <p class="text-gray-600 mb-4">Klik link di bawah untuk melihat materi yang disediakan:</p>
            <a href="{{ $materi->link }}" class="text-blue-600 hover:text-blue-800 font-bold" target="_blank">
                {{ $materi->link }}
            </a>
        </div>
    @endif
</div>


                    <!-- Display creation date -->
                    <div class="mb-24pt">
                        <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                            <i class="material-icons icon--left">schedule</i>
                            @if ($materi->created_at)
                                {{ $materi->created_at->format('d M Y') }}
                            @else
                                <span>Tanggal tidak tersedia</span>
                            @endif
                        </span>
                    </div>

                    <!-- Description of the content -->
                    <p class="lead measure-lead text-70 mb-4">{{ $materi->konten }}</p>

                </div>
                <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-16pt">
                            <span class="media-left mr-16pt">
                                <span class="material-icons" style="font-size: 40px;">person</span>
                            </span>
                            <div class="media-body">
                                <a class="card-title m-0" href="teacher-profile.html">{{ $materi->user->name }}</a>
                                <p class="text-50 lh-1 mb-0">{{ $materi->user->role->name }}</p> <!-- Display the user's role -->
                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Button to download the file -->
                        <div class="text-center mt-4">
                            @if($materi->file_path)
                                <p class="text-muted mb-2">Download materi di sini:</p>
                                <a href="{{ Storage::url($materi->file_path) }}" class="btn btn-outline-light" style="width: 80%;" download>
                                    <i class="material-icons mr-1">file_download</i> Download Materi
                                </a>
                            @else
                                <p class="text-danger mt-2">Materi belum tersedia untuk diunduh.</p>
                            @endif
                        </div>

                    </div>
                </div>

                </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- // END Header Layout Content -->

</body>
