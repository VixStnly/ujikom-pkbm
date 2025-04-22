<!-- HTML -->
@include ('content.html')

<head>
    @include ('content.style')
    <style>
        .card-header {
            height: 110px;
        }

        @media (max-width: 768px) {
            .card-header {
                height: auto;
                min-height: 110px;
            }
        }
    </style>
</head>

<body class="layout-sticky-subnav layout-learnly ">
    @include ('layouts.NavSiswa')
    @include ('content.sidemenu')
    @extends ('content.js')

    <div class="mdk-header-layout js-mdk-header-layout">
        <div class="mdk-header-layout__content page-content ">

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">

                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div
                            class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">Selamat Datang Di Dashboard , {{$user->name}}</h1>
                            <div>

                                <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                    data-toggle="tooltip" data-title="Experience IQ" data-placement="bottom">
                                    <i class="material-icons icon--left">class</i> <!-- Changed icon here -->
                                    @if($user->kelas->isEmpty())
                                    <span>Tidak memiliki kelas</span>
                                    @else
                                    @foreach($user->kelas as $kelas)
                                    {{ $kelas->name }}
                                    @endforeach
                                    @endif
                                </span>


                            </div>
                        </div>
                        <div class="ml-lg-16pt">
                            <a href="/profile" class="btn btn-light">My Profile</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="page-section">
                <div class="container page__container">

                    <div class="row">
                        <div class="col-lg-7">

                            <div class="row card-group-row mb-lg-8pt">
                                <!-- Kartu Tugas yang Dikumpulkan -->
                                <div class="col-md-4">
                                    <a href="/histori/tugas" class="card rounded text-decoration-none">
                                        <div class="card-header d-flex align-items-center rounded" style="height: 110px; border: none;">
                                            <div class="h2 mb-0 mr-3">{{ $submissionCount }}</div> <!-- Jumlah Tugas -->
                                            <div class="flex">
                                                <p class="card-title">Tugas Yang Di Kumpulkan</p>
                                                <p class="card-subtitle text-50">Jumlah Tugas </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="/histori/absen" class="card rounded text-decoration-none">
                                        <div class="card-header d-flex align-items-center rounded" style="border: none;">
                                            <div class="h2 mb-0 mr-3">{{ $absenCount }}</div>
                                            <div class="flex">
                                                <p class="card-title">Absen Yang Di Lakukan</p>
                                                <p class="card-subtitle text-50">Jumlah Absen Pertemuan</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Kartu Jumlah pembelajaran -->
                                <div class="col-md-4">
                                    <a href="{{ url('/subjects') }}" class="card rounded text-decoration-none">
                                        <div class="card-header d-flex align-items-center rounded" style="height: 110px; border: none;">
                                            <div class="h2 mb-0 mr-3">{{ $subjectCount }}</div>
                                            <!-- Jumlah Mata Pelajaran -->
                                            <div class="flex">
                                                <p class="card-title">Mata Pelajaran</p>
                                                <p class="card-subtitle text-50">Jumlah mata pelajaran</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-8pt">

                                <div class="col">
                                    <!-- Comments Section -->
                                    <div class="page-separator">
                                        <div class="page-separator__text">Laporan Admin</div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            @forelse ($comments as $comment)
                                            <div class="media mb-4">
                                                <div class="media-left mr-3">
                                                    <a href="#" class="avatar avatar-sm">
                                                        <span class="avatar-title rounded-circle">{{ $comment->user->initials }}
                                                            @if ($user->profile_image)
                                                            <img src="{{ Storage::url('profil/' . $user->profile_image) }}" alt="{{ $user->name }}" class="rounded-circle w-8 h-8 object-cover" style="width: 48px; height: 48px;" />
                                                            @else
                                                            <span class="avatar avatar-sm mr-1pt2 ">
                                                                <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>
                                                            </span>
                                                            @endif
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" class="card-title font-weight-bold">{{ $comment->user->name }}</a>
                                                        <small class="ml-auto text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="mt-1 mb-2 text-70 comment-text">{{ $comment->comment }}</p>

                                                    <!-- Reply button -->
                                                    @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                                    <button class="btn btn-link text-primary reply-btn" data-comment-id="{{ $comment->id }}">Reply</button>
                                                    @endif

                                                    <!-- Delete button -->
                                                    @if (Auth::check() && Auth::user()->id === $comment->user_id)
                                                    <button class="btn btn-link text-danger delete-btn" data-comment-id="{{ $comment->id }}">Delete</button>
                                                    @endif

                                                    <!-- Replies form -->
                                                    @if (Auth::check())
                                                    <div class="reply-form" id="reply-form-{{ $comment->id }}" style="display: none; margin-top: 10px;">
                                                        <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                                                            @csrf
                                                            <div class="input-group">
                                                                <input type="text" name="comment" class="form-control" required placeholder="Reply..." style="margin-right: 5px;">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-primary" type="submit">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    @endif

                                                    <!-- Display replies -->
                                                    @if ($comment->replies->isNotEmpty())
                                                    <div class="mt-3">
                                                        @foreach ($comment->replies as $reply)
                                                        <div class="media mb-2 ml-5">
                                                            <div class="media-left mr-3">
                                                                <a href="#" class="avatar avatar-sm">
                                                                    <span class="avatar-title rounded-circle bg-gray-300 text-white">{{ $reply->user->initials }}</span>
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="d-flex align-items-center">
                                                                    <a href="#" class="font-weight-bold">{{ $reply->user->name }}</a>
                                                                    <small class="ml-auto text-gray-500 text-xs">{{ $reply->created_at->diffForHumans() }}</small>
                                                                </div>
                                                                <p class="mt-1 text-gray-700">{{ $reply->comment }}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="my-3"> <!-- Clear separator between comments -->
                                            @empty
                                            <p>No comments available.</p>
                                            @endforelse
                                        </div>

                                        <!-- Comment Input Section -->
                                        <div class="card-footer">
                                            @if (Auth::check())
                                            <form action="{{ route('comments.store') }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" name="comment" class="form-control" required placeholder="Write a comment..." style="margin-right: 5px;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- JavaScript to toggle reply form and delete comment -->
                                    <script>
                                        document.querySelectorAll('.delete-btn').forEach(button => {
                                            button.addEventListener('click', function() {
                                                const commentId = this.getAttribute('data-comment-id');
                                                if (confirm('Are you sure you want to delete this comment?')) {
                                                    fetch(`/comments/${commentId}`, {
                                                            method: 'DELETE',
                                                            headers: {
                                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                                'Content-Type': 'application/json',
                                                            },
                                                        })
                                                        .then(response => {
                                                            if (response.ok) {
                                                                return response.json(); // Dapatkan response dari server
                                                            } else {
                                                                throw new Error('Error deleting comment.');
                                                            }
                                                        })
                                                        .then(data => {
                                                            alert(data.message);
                                                            location.reload(); // Refresh halaman jika delete sukses
                                                        })
                                                        .catch(error => {
                                                            alert(error.message);
                                                        });
                                                }
                                            });
                                        });
                                    </script>

                                </div>
                            </div>


                            <style>
                                .comment-separator {
                                    border: none;
                                    border-top: 1px solid #e0e0e0;
                                    /* Customize color as needed */
                                    margin: 15px 0;
                                    /* Adjust spacing */
                                }
                            </style>

                        </div>

                        <div class="col-lg-5">

                        <div class="card" style="border: none;">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Selamat Datang 🎉</h5>
                          <p class="mb-4 mt-3 text-50">
                            Selamat datang di e-learning PKBM Academia Anda bisa meng akses tugas, materi, absen dan berbagai fitur dengan mudah dan teratur
                          </p>

                          <a href="" class="btn btn-sm btn-outline-primary">Lihat Profil</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                            style="margin-left: -30px;"
                          />
                        </div>
                      </div>
                    </div>
                  </div>


                            <script>
                                function runClock() {
                                    const now = new Date();
                                    const sec = now.getSeconds();
                                    const min = now.getMinutes();
                                    const hr = now.getHours();

                                    const secAngle = sec * 6;
                                    const minAngle = min * 6 + sec * 0.1;
                                    const hrAngle = (hr % 12) * 30 + min * 0.5;

                                    document.querySelector("#second path").setAttribute("transform", `rotate(${secAngle},300,300)`);
                                    document.querySelector("#minute path").setAttribute("transform", `rotate(${minAngle},300,300)`);
                                    document.querySelector("#hour path").setAttribute("transform", `rotate(${hrAngle},300,300)`);

                                    // Digital clock
                                    const formatted = now.toLocaleTimeString([], {
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    });
                                    document.getElementById("txt").innerText = formatted;
                                }

                                setInterval(runClock, 1000);
                                runClock();
                            </script>


                            <div class="page-separator">
                                <div class="page-separator__text">Pengumuman</div>
                            </div>
                            @foreach ($announcements as $announcement)
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 d-flex justify-content-between align-items-start">
                                    <div>
                                        <a href="student-course.html" class="card-title mb-4pt">{{ $announcement->title }}</a>
                                        <p class="lh-1 mb-0">
                                            <small class="text-muted mr-8pt">{!! Str::limit(strip_tags($announcement->description), 35) !!}</small>
                                        </p>
                                    </div>
                                    <small class="text-muted text-right">
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

        </div>

        @include ('Page.footer')
    </div>
</body>