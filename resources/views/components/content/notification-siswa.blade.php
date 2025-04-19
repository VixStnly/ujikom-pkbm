<div class="nav navbar-nav d-none d-sm-flex flex justify-content-end ml-8pt">
    <!-- Notifications dropdown -->
    <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full"
        data-toggle="tooltip"
        data-title="Messages"
        data-placement="bottom"
        data-boundary="window">
        <button class="nav-link btn-flush dropdown-toggle"
            type="button"
            data-toggle="dropdown"
            data-caret="false">
            <i class="material-icons icon-24pt">mail_outline</i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <div data-perfect-scrollbar
                class="position-relative">
                <div class="dropdown-header"><strong>Messages</strong></div>
                <div class="list-group list-group-flush mb-0">

                    <a href="javascript:void(0);"
                        class="list-group-item list-group-item-action unread">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-black-50">5 minutes ago</small>

                            <span class="ml-auto unread-indicator bg-accent"></span>

                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <img src="../../public/images/people/110/woman-5.jpg"
                                    alt="people"
                                    class="avatar-img rounded-circle">
                            </span>
                            <span class="flex d-flex flex-column">
                                <strong class="text-black-100">Michelle</strong>
                                <span class="text-black-70">Clients loved the new design.</span>
                            </span>
                        </span>
                    </a>

                    <a href="javascript:void(0);"
                        class="list-group-item list-group-item-action">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-black-50">5 minutes ago</small>

                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <img src="../../public/images/people/110/woman-5.jpg"
                                    alt="people"
                                    class="avatar-img rounded-circle">
                            </span>
                            <span class="flex d-flex flex-column">
                                <strong class="text-black-100">Michelle</strong>
                                <span class="text-black-70">🔥 Superb job..</span>
                            </span>
                        </span>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <!-- // END Notifications dropdown -->

    <!-- Notifications dropdown -->
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