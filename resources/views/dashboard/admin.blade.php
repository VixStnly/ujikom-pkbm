
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold">Admin Dashboard</h1>
    

    <!-- Page Content -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Welcome to the Admin Dashboard</h2>
        <div class="page-separator">
    <div class="page-separator__text">Comments</div>
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

                    <!-- Replies form -->
                    @if (Auth::check())
                        <div class="reply-form" id="reply-form-{{ $comment->id }}" style="display: none;">
                            <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="comment" class="form-control" required placeholder="Reply...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Display replies -->
                    @foreach ($comment->replies as $reply)
                        <div class="media mt-3">
                            <div class="media-left mr-3">
                                <a href="#" class="avatar avatar-sm">
                                    <span class="avatar-title rounded-circle">{{ $reply->user->initials }}</span>
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="card-title">{{ $reply->user->name }}</a>
                                    <small class="ml-auto text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mt-1 mb-0 text-70 reply-text">{{ $reply->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p>No comments available.</p>
        @endforelse
    </div>
    <div class="card-footer">
        @if (Auth::check())
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="comment" class="form-control" required placeholder="Write a comment...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- JavaScript to toggle reply form -->
<script>
    document.querySelectorAll('.reply-btn').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.getAttribute('data-comment-id');
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Logout</button>
        </form>
    </div>
    </x-slot>
</x-app-layout>
