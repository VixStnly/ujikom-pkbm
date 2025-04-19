@foreach ($forums->where('parent_id', null) as $forum)
<div class="bg-white p-6 rounded-lg shadow-md mb-6 transition duration-300 ease-in-out transform hover:scale-105 fade-in">
    <div class="flex justify-between items-center text-sm text-gray-600">
        <span class="font-semibold">{{ $forum->user->name }}</span>
        @if (auth()->id() === $forum->user_id)
        <div class="flex items-center space-x-2 justify-end">
            <span class="text-gray-400">{{ $forum->created_at->diffForHumans() }}</span>
            <!-- Tambahkan titik tiga di sini -->
            <button class="text-gray-600 hover:text-gray-800 focus:outline-none" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded text-xl"></i> <!-- Ikon titik tiga -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTitleModal-{{ $forum->id }}">Edit Judul</button>
                </li>
                <li>
                <form action="{{ route('forum.destroy', $forum->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus forum ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                </form>
                </li>
            </ul>
        </div>
        @else
        <span class="text-gray-400">{{ $forum->created_at->diffForHumans() }}</span>
        @endif
    </div>


    <p class="mt-3 text-gray-700">{{ $forum->message }}</p>
    @if ($forum->image_path)
    <img src="{{ asset('storage/' . $forum->image_path) }}" class="mt-3 rounded-lg max-w-full shadow-lg zoom-in">
    @endif

    <form action="{{ route('forums.like', $forum->id) }}" method="POST" class="inline">
    @csrf
    <button type="button" class="like-button text-sm text-blue-600 mr-3 hover:text-blue-800 mt-3 focus:outline-none" data-id="{{ $forum->id }}">
        <i class='bx {{ $forum->likes->contains(Auth::id()) ? "bxs-heart text-red-500" : "bx-heart text-gray-400" }} text-base'></i>
        <span class="like-count">{{ $forum->likes->count() }}</span>
    </button>

</form>


    <!-- Balasan -->
    <button class="text-sm text-blue-600 hover:text-blue-800 mt-3 mr-2 focus:outline-none" data-bs-toggle="collapse" data-bs-target="#replies-{{ $forum->id }}">
        <i class='bx bx-comment-dots text-base'></i>
        <span>({{ $forum->replies->count() }})</span>
    </button>

    <div class="collapse mt-4 slide-up" id="replies-{{ $forum->id }}">
        <ul class="d-flex flex-column list-unstyled overflow-y-auto" id="messages" style="max-height: 20rem;">
            @foreach ($forum->replies as $reply)
            @php
            $isMe = auth()->id() === $reply->user_id;
            @endphp
            <li class="message d-inline-flex {{ $isMe ? 'justify-content-end' : 'justify-content-start' }}">
                {{-- Wrapper untuk avatar + bubble --}}
                <div class="d-flex align-items-start {{ $isMe ? 'flex-row-reverse' : '' }}">
                    {{-- Avatar (selalu kiri) --}}
                    <div class="mx-2">
                        <a href="profile.html" class="avatar avatar-sm">
                            <img src="{{ $reply->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($reply->user->name) }}" class="avatar-img rounded-circle">
                        </a>
                    </div>

                    {{-- Bubble Chat --}}
                    <div class="message__body card {{ $isMe ? 'bg-primary text-white' : 'bg-light' }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex mr-3">
                                    <strong class="{{ $isMe ? 'text-white' : 'text-dark' }}">{{ $reply->user->name }}</strong>
                                </div>
                                <div>
                                    <small class="{{ $isMe ? 'text-light' : 'text-70' }}">{{ $reply->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="{{ $isMe ? 'text-white' : 'text-dark' }}">
                                {{ $reply->message }}
                            </div>

                            @if ($reply->image_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $reply->image_path) }}" class="img-fluid rounded shadow" style="max-width: 400px; max-height: 400px;">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
        </li>
            @endforeach
        </ul>
    </div>

    <!-- Form Balas Toggle -->
    <button class="text-sm text-blue-600 hover:text-blue-800 mt-3 focus:outline-none" data-bs-toggle="collapse" data-bs-target="#form-reply-{{ $forum->id }}">
        <i class='bx bx-reply text-base'></i>
        Balas
    </button>
    <div class="collapse mt-3 slide-up" id="form-reply-{{ $forum->id }}">
        <form action="{{ route('forum.store', $meeting->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $forum->id }}">
            <textarea name="message" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis balasan..."></textarea>
            <div class="mb-3">
                        <input class="form-control" type="file" id="formFile" />
                      </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">Kirim Balasan</button>
        </form>
    </div>
</div>
@endforeach


<style>

/* Scrollbar yang lebih halus dan minimalis */
#messages::-webkit-scrollbar {
    width: 6px;
}

#messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#messages::-webkit-scrollbar-thumb {
    background: #c0c0c0;
    border-radius: 10px;
}

#messages::-webkit-scrollbar-thumb:hover {
    background: #a0a0a0;
}


    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(10px);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }

    .animate-fade-out {
        animation: fadeOut 0.2s ease-in forwards;
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Apply animations to specific elements */
    .fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .zoom-in {
        animation: zoomIn 0.5s ease-out forwards;
    }

    .slide-up {
        animation: slideUp 0.5s ease-out forwards;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.like-button').on('click', function () {
        var button = $(this);
        var forumId = button.data('id');

        $.ajax({
            url: '/forums/' + forumId + '/like',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                // Ganti icon
                let icon = button.find('i');
                if (data.liked) {
                    icon.removeClass('bx-heart text-gray-400').addClass('bxs-heart text-red-500');
                } else {
                    icon.removeClass('bxs-heart text-red-500').addClass('bx-heart text-gray-400');
                }

                // Update jumlah like
                button.find('.like-count').text(data.like_count);
            }
        });
    });
</script>
