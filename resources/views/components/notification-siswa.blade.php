<!-- resources/views/layouts/app.blade.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="nav navbar-nav d-sm-flex flex justify-content-end ml-8pt">
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
            <span id="unreadCount" class="badge badge-notifications badge-accent"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <div data-perfect-scrollbar class="position-relative">
                <div class="dropdown-header d-flex justify-content-between">
                    <strong>System notifications</strong>
                </div>

                <div class="list-group list-group-flush mb-0" id="notificationList">
                    <!-- Notifikasi akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Ambil notifikasi saat halaman dimuat
    $.get("{{ route('notifications.fetch') }}", function(data) {
        // Update jumlah notifikasi yang belum dibaca
        $('#unreadCount').text(data.unreadCount);
        
        // Tampilkan notifikasi dalam dropdown
        if (data.notifications.length > 0) {
            data.notifications.forEach(function(notif) {
                $('#notificationList').append(`
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action ${!notif.is_read ? 'unread' : ''}">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-black-50">${notif.created_at}</small>
                            ${!notif.is_read ? '<span class="ml-auto unread-indicator bg-accent"></span>' : ''}
                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <span class="avatar-title rounded-circle bg-light">
                                    <i class="material-icons font-size-16pt">${notif.icon}</i>
                                </span>
                            </span>
                            <span class="flex d-flex flex-column">
                                <span class="text-black-70">${notif.message}</span>
                            </span>
                        </span>
                    </a>
                `);
            });
        } else {
            $('#notificationList').html('<div class="text-center text-black-50 p-2">Tidak ada notifikasi</div>');
        }
    });
});
</script>
