<!-- Navbar -->
<div class="navbar navbar-expand navbar-light border-bottom-2" id="default-navbar" data-primary>

    <button class="navbar-toggler w-auto mr-2 d-block d-lg-none rounded-0" type="button" data-toggle="sidebar">
        <span class="material-icons">short_text</span>
    </button>

    <a href="/dashboard" class="navbar-brand d-lg-none mr-2">
        <span>PKBM</span>
    </a>

    <span class="d-none d-md-flex align-items-center mr-3">
        <span class="avatar avatar-sm mr-2">
            <span class="avatar-title rounded navbar-avatar">
                <i class="material-icons">school</i>
            </span>
        </span>
        <small class="d-flex flex-column">
            <strong class="navbar-text-100">Guru</strong>
            <span class="navbar-text-50">{{ $user->name }}</span>
        </small>
    </span>

    <div class="flex"></div>

    <div class="nav navbar-nav flex-nowrap d-flex">

        @auth
        @php
        $user = auth()->user();

        // Ambil notifikasi guru (global & personal)
        $notifications = \App\Models\NotificationGuru::where('user_id', $user->id)
        ->latest()
        ->take(5)
        ->get();

        $unreadCount = \App\Models\NotificationGuru::where('user_id', $user->id)
        ->where('is_read', false)
        ->count();
        @endphp


        @include('components.content.notification-guru', [
        'notifications' => $notifications,
        'unreadCount' => $unreadCount,
        ])
        @endauth


        <div class="nav-item dropdown">

            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-caret="false">
                <span class="avatar img-profile mr-2" style="width: 42px; height: 42px;">
                    @if ($user->profile_image)
                    <img src="{{ Storage::url('profil/' . $user->profile_image) }}" alt="{{ $user->name }}"
                        class="rounded-circle w-100 h-100" style="object-fit: cover;" />
                    @else
                    <span class="avatar-title rounded-circle bg-primary w-100 h-100 d-flex align-items-center justify-content-center">
                        <i class="material-icons text-white">account_box</i>
                    </span>
                    @endif
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header"><strong>Account</strong></div>
                <a class="dropdown-item" href="{{ route('profile.editGuru') }}">Edit Account</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar -->