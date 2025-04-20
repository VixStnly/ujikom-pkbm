@include ('content.html')

    <head>
    @include ('content.style')
    <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body class="layout-app ">
    <div class="container flex">
    <div class="sidebar">
        <!-- Your sidebar content here -->
    </div>
    <div class="main-content flex-1">
    @if(session('success'))
                <script>
                    $(document).ready(function() {
                        toastr.success("{{ session('success') }}", "Selamat Datang!", {
                            closeButton: true,
                            progressBar: true,
                        });
                    });
                </script>
            @endif
        <!-- Rest of your main content here -->
    </div>
</div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Navbar -->
                 @include ('layouts.NavSuper')


                <div class="pt-32pt">
                    <div class="container page__container">

                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                                <h1 class="h2 mb-8pt">Dashboard Super Admin</h1>
                                <div>

                                <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                    data-toggle="tooltip"
                                    data-title="Admins"
                                    data-placement="bottom">
                                    <i class="material-icons icon--left">admin_panel_settings</i>1
                                </span>
                                <span class="chip chip-outline-secondary d-inline-flex align-items-center"
                                    data-toggle="tooltip"
                                    data-title="Users"
                                    data-placement="bottom">
                                    <i class="material-icons icon--left">person</i> {{ $totalUsers }}
                                </span>

                                </div>
                            </div>
                            <div class="ml-lg-16pt">
                                <a href="teacher-profile.html"
                                class="btn btn-light">My Profile</a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- SEBELUM Page Content -->
 <div class="container mx-auto md:text-left text-center mb-4 mt-4">
    <div
        class="bg-gradient-to-r from-green-500 to-black shadow-lg rounded-lg p-6 transition-transform duration-300 transform hover:scale-105">
        <h3 class="text-2xl font-bold mb-2 text-white">Waktu Sekarang</h3>
        <p id="clock" class="text-4xl font-semibold text-white"></p>
    </div>
</div>

<script>
    // Update the clock
    function updateClock() {
        const now = new Date();
        const currentTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('clock').innerText = currentTime;
    }

    // Update clock every second
    setInterval(updateClock, 1000);
    // Initialize the clock immediately
    updateClock();
</script>
                <!-- Page Content -->
                <div class="page-section border-bottom-2 py-8">
                    <div class="container page__container">
                        <div class="row">

                            <!-- Card 1: Earnings this month -->
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card border-1 border-left-3 border-left-success text-center mb-lg-0">
                                    <div class="card-body">
                                        <h4 class="h2 mb-0">{{ $adminCount }}</h4>
                                        <div>Jumlah Admin</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Account Balance -->
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card border-1 border-left-3 border-left-accent text-center mb-lg-0">
                                    <div class="card-body">
                                        <h4 class="h2 mb-0">{{ $guruCount }}</h4>
                                        <div>Jumlah Guru</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Total Sales -->
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card border-1 border-left-3 border-left-warning text-center mb-lg-0">
                                    <div class="card-body">
                                        <h4 class="h2 mb-0">{{ $kelasCount }}</h4>
                                        <div>Jumlah Kelas</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4: Another Metric -->
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card border-1 border-left-3 border-left-primary text-center mb-lg-0">
                                    <div class="card-body">
                                        <h4 class="h2 mb-0">{{ $siswaCount }}</h4>
                                        <div>Jumlah Siswa</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

               <div class="container page__container page-section">
                <div class="row mb-8pt">
                    <div class="col-lg-12">
                        <!-- Comments Section -->
                        <div class="page-separator">
                            <div class="page-separator__text">Laporan User</div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @forelse ($comments as $comment)
                                    <div class="media mb-3">
                                        <div class="media-left mr-3">
                                            <a href="#" class="avatar avatar-sm">
                                                <span class="avatar-title rounded-circle">{{ $comment->user->initials }}</span>
                                            </a>
                                        </div>

                                            <div class="media-body">
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="card-title">{{ $comment->user->name }}</a>
                                                    <small class="ml-auto text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="mt-1 mb-0 text-70 comment-text">{{ $comment->comment }}</p>

                                                <!-- Reply button -->
                                                <button class="btn btn-link text-primary reply-btn" data-comment-id="{{ $comment->id }}">Reply</button>

                                            <!-- Delete button -->
                                            @if (Auth::check() && Auth::user()->id === $comment->user_id)
                                                <button class="btn btn-link text-danger delete-btn" data-comment-id="{{ $comment->id }}">Delete</button>
                                            @endif

                                            <!-- Reply form (hidden by default) -->
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
                                            @foreach ($comment->replies as $reply)
                                                <div class="flex mt-3 ml-5 sm:ml-0">
                                                    <div class="flex-shrink-0 mr-3">
                                                        <a href="#" class="avatar avatar-sm">
                                                            <span class="avatar-title rounded-full bg-gray-300 text-white">{{ $reply->user->initials }}</span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div class="flex items-center">
                                                            <a href="#" class="font-bold text-lg">{{ $reply->user->name }}</a>
                                                            <small class="ml-auto text-gray-500 text-xs">{{ $reply->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <p class="mt-1 text-gray-700">{{ $reply->comment }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr> <!-- Divider between comments -->
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

                        <!-- JavaScript to toggle reply form and handle delete comment -->
                        <script>
                            document.querySelectorAll('.reply-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const commentId = this.getAttribute('data-comment-id');
                                    const replyForm = document.getElementById(`reply-form-${commentId}`);
                                    if (replyForm.style.display === "none") {
                                        replyForm.style.display = "block";
                                    } else {
                                        replyForm.style.display = "none";
                                    }
                                });
                            });

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
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                alert(data.message);
                                                location.reload();
                                            } else {
                                                alert(data.error);
                                            }
                                        })
                                        .catch(error => alert('Error deleting comment: ' + error.message));
                                    }
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        @include ('layouts.sidebarSuper')
    </div>

    @include ('content.js')

    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
            };
        });
    </script>
</body>