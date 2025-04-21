<div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full"
    data-toggle="tooltip"
    data-title="Notifications"
    data-placement="bottom"
    data-boundary="window">

    <button class="nav-link btn-flush dropdown-toggle"
        type="button"
        data-toggle="dropdown"
        data-caret="false">
        <i class="material-icons">notifications_none</i>

        @if($unreadCount > 0)
        <span class="badge badge-notifications badge-accent">{{ $unreadCount }}</span>
        @endif
    </button>

    <div class="dropdown-menu dropdown-menu-right">
        <div data-perfect-scrollbar class="position-relative">
            <div class="dropdown-header"><strong>Notifikasi Guru</strong></div>
            <div class="list-group list-group-flush mb-0">
                @forelse ($notifications as $notif)
                
                <a href="{{ route('notification.read', $notif->id) }}"
                    class="list-group-item list-group-item-action {{ $notif->is_read ? '' : 'unread' }}">
                    <span class="d-flex align-items-center mb-1">
                        <small class="text-black-50">{{ $notif->created_at->diffForHumans() }}</small>
                        @if (!$notif->is_read)
                        <span class="ml-auto unread-indicator bg-accent"></span>
                        @endif
                    </span>
                    <span class="text-black-70">{{ $notif->message }}</span>
                </a>
                @empty
                <span class="dropdown-item">Tidak ada notifikasi.</span>
                @endforelse
            </div>
        </div>
    </div>
</div>
