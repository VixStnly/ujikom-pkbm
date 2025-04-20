<div class="nav navbar-nav d-sm-flex flex justify-content-end ml-8pt">
<!-- Message -->
<div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full"
    data-toggle="tooltip"
    data-placement="bottom"
    data-boundary="window">
    <button class="nav-link btn-flush dropdown-toggle"
        type="button"
        data-toggle="dropdown"
        data-caret="false">
        <i class="material-icons icon-24pt">mail_outline</i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <div data-perfect-scrollbar class="position-relative">
            <div class="dropdown-header"><strong>Messages</strong></div>
            <div class="list-group list-group-flush mb-0">

            @foreach ($notifications as $notif)
                @php
                    $isForumAdded = Str::contains($notif['message'], 'menambahkan forum');
                    $isForumLiked = Str::contains($notif['message'], 'menyukai forum');
                @endphp

                <a href="javascript:void(0);" 
                    class="list-group-item list-group-item-action {{ $notif['unread'] ? 'unread' : '' }}">
                    <span class="d-flex align-items-center mb-1">
                        <small class="text-black-50">{{ $notif['time'] }}</small>
                        @if ($notif['unread'])
                            <span class="ml-auto unread-indicator bg-accent"></span>
                        @endif
                    </span>
                    <span class="d-flex">
                        <span class="avatar avatar-xs mr-2">
                            @if ($isForumAdded)
                                <i class="material-icons font-size-16pt text-success">add</i>
                            @elseif ($isForumLiked)
                                <i class="material-icons font-size-16pt text-primary">thumb_up</i>
                            @else
                                <img src="{{ asset($notif['avatar']) }}" 
                                    alt="people" 
                                    class="avatar-img rounded-circle">
                            @endif
                        </span>
                        <span class="flex d-flex flex-column">
                            <strong class="text-black-100">{{ $notif['user'] }}</strong>
                            <span class="text-black-70">{{ $notif['message'] }}</span>
                        </span>
                    </span>
                </a>
            @endforeach

            </div>
        </div>
    </div>
</div>


    <!-- Notifications -->
    <div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full"
        data-toggle="tooltip"
        data-placement="bottom"
        data-boundary="window">
        <button class="nav-link btn-flush dropdown-toggle"
            type="button"
            data-toggle="dropdown"
            data-caret="false">
            <i class="material-icons">notifications_none</i>
            <span class="badge badge-notifications badge-accent">{{ $unreadCount }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <div data-perfect-scrollbar class="position-relative">
                <div class="dropdown-header d-flex justify-content-between">
                    <strong>System notifications</strong>
                    <form action="{{ route('notifications.read-all') }}" method="POST">
                        @csrf
                        <button class="btn btn-link p-0 text-primary">Tandai semua dibaca</button>
                    </form>
                </div>

                <div class="list-group list-group-flush mb-0">
                    @forelse ($notifications as $notif)
                    @php
                        $isTugas = Str::contains($notif->message, 'Tugas');
                    @endphp
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action {{ !$notif->is_read ? 'unread' : '' }}">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-black-50">{{ $notif->created_at->diffForHumans() }}</small>
                            @if (!$notif->is_read)
                            <span class="ml-auto unread-indicator bg-accent"></span>
                            @endif
                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <span class="avatar-title rounded-circle bg-light">
                                    <i class="material-icons font-size-16pt text-{{ $isTugas ? 'warning' : $notif->icon_color }}">
                                        {{ $isTugas ? 'assignment' : $notif->icon }}
                                    </i>
                                </span>
                            </span>
                            <span class="flex d-flex flex-column">
                                <span class="text-black-70">{{ $notif->message }}</span>
                            </span>
                        </span>
                    </a>

                    @empty
                    <div class="text-center text-black-50 p-2">Tidak ada notifikasi</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>