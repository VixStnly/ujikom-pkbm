<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico')}}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" />
  <script src="{{ asset('assets/js/config.js')}}"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body class="layout-sticky-subnav layout-learnly">
  @include('layouts.preloader')
  @include('layouts.NavSiswa')
  @include('content.sidemenu')

  <style>
  @media (max-width: 576px) {
    .forum-header-title {
      font-size: 1rem; /* setara h5 */
    }

    .forum-breadcrumb {
      font-size: 0.85rem;
    }
  }
</style>

<div class="card rounded-4 top-5 page-section border-bottom-2"
  style="background-image: url('{{ asset('assets/img/image.png') }}'); background-size: cover; background-position: center; padding: 75px 15px; margin-left: 7%; margin-right: 7%;">
  <div class="container page__container">
    <div class="d-flex flex-column align-items-center text-center">
      <h1 class="h2 forum-header-title text-white mb-3 text-break">
        {{ $meeting->title }} - Forum Chat
      </h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center forum-breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="#" class="text-white">Pembelajaran</a></li>
          <li class="breadcrumb-item active text-white" aria-current="page">Forum</li>
        </ol>
      </nav>
    </div>
  </div>
</div>


  <div class="mdk-header-layout js-mdk-header-layout">
    <div class="mdk-header-layout__content page-content">

      <div class="page-section">
        <div class="container page__container">

          <div class="row mb-8pt">

            <div class="col-lg-4">
              <div class="order-2 mb-4">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                  <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-white">
                      <i class="bx bxs-chat me-2 text-white"></i>Aktivitas Forum PKBM
                    </h6>
                  </div>
                  <div class="card-body p-3 bg-light">
                    <ul class="list-group list-group-flush">
                      @forelse ($activities as $activity)
                      <li class="list-group-item px-0 py-3 border-bottom d-flex align-items-start">
                        <div class="me-3">
                          <div style="flex-shrink: 0;">
                            <img
                              src="https://ui-avatars.com/api/?name={{ urlencode($activity->user->name) }}&background=0D8ABC&color=fff&rounded=true"
                              class="rounded-circle flex-shrink-0"
                              width="60"
                              height="60"
                              alt="{{ $activity->user->name }}" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <div class="d-flex justify-content-between">
                            <strong>{{ $activity->user->name }}</strong>
                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                          </div>
                          <div class="text-muted small mt-1">
                            <i class='bx bxs-chat'></i>&nbsp; {!! nl2br(e($activity->message)) !!}
                          </div>
                        </div>
                      </li>
                      @empty
                      <li class="list-group-item text-center text-muted py-3">Belum ada aktivitas</li>
                      @endforelse
                    </ul>
                  </div>
                </div>
              </div>

              <div class="order-3">
                <div class="card border rounded-4 p-3 shadow-sm">
                  <h6 class="fw-semibold mb-2">Mendatang</h6>

                  @forelse ($meeting->tugas as $tugas)
                  <!-- Item tugas -->
                  <a href="#" class="d-flex align-items-center mb-2 text-decoration-none px-3 mb-3 py-2 rounded-3 border border-light-subtle hover-bg-light">
                    <div class="avatar me-3">
                      <div class="avatar-title rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                        <i class="material-icons">description</i>
                      </div>
                    </div>
                    <div style="line-height: 1.4">
                      <div class="text-primary fw-semibold">{{ $tugas->judul }}</div>
                      <small class="text-muted">Dibuat oleh: {{ $tugas->user->name }}</small>
                    </div>
                  </a>
                  @empty
                  <p class="text-muted mb-3">Tidak ada tugas yang perlu segera diselesaikan.</p>
                    <a href="javascript:history.back()" class="text-primary fw-semibold text-decoration-none">Lihat Semuanya</a>
                  @endforelse
                </div>
              </div>


              <style>
                .border-light-subtle {
                  border: 1px solid #e0e0e0;
                  /* Warna abu muda */
                }
              </style>


            </div>

            <div class="col-lg-8">

              <form
                action="{{ route('forum.store', $meeting->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="mb-6 bg-white p-4 rounded-2xl shadow-lg transition-all duration-300">
                @csrf

                <textarea
                  id="forum-textarea"
                  name="message"
                  rows="1"
                  class="w-full resize-none p-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300 placeholder-gray-400"
                  placeholder="Tulis pertanyaan atau komentar..."
                  onclick="showForumActions()"></textarea>

                <div id="forum-actions" class="hidden mt-3 animate-fade-in">
                  <div class="flex flex-col gap-2 mb-3">
                    <div class="flex items-center gap-3">
                      <!-- Upload Button -->
                      <label for="image" class="flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4" />
                        </svg>
                        <span>Upload Gambar</span>
                      </label>
                      <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="updateFilePreview()">

                    </div>

                    <!-- Preview Thumbnail -->
                    <div id="image-preview" class="hidden">
                      <img id="preview-img" src="" alt="Preview" class="max-h-32 rounded-lg border border-gray-200">
                      <span id="file-name" class="text-sm text-gray-600"></span>
                    </div>
                  </div>

                  <div class="flex justify-between items-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">Kirim</button>
                    <button
                      type="button"
                      onclick="hideForumActions()"
                      class="text-sm text-red-500 hover:underline">Batal</button>
                  </div>
                </div>
              </form>

              <x-content.buble-chat :forums="$forums" :meeting="$meeting" />

            </div>
          </div>

        </div>
      </div>
    </div>
    @include ('Page.footer')
  </div>

  @foreach ($forums->where('parent_id', null) as $forum)
  <!-- Modal untuk Edit Judul -->
  <div class="modal fade" id="editTitleModal-{{ $forum->id }}" tabindex="-1" aria-labelledby="editTitleModalLabel-{{ $forum->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTitleModalLabel-{{ $forum->id }}">Edit Judul</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-top: 0.5px;"></button>
        </div>

        <form action="{{ route('forum.update', $forum->id) }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="meeting_id" value="{{ $forum->meeting_id }}">

          <div class="modal-body">
            <div class="mb-3">
              <label for="message-{{ $forum->id }}" class="form-label">Judul</label>
              <input type="text" name="message" id="message-{{ $forum->id }}" class="form-control" value="{{ $forum->message }}" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>
  @endforeach


  <script>
    function showForumActions() {
      const el = document.getElementById('forum-actions');
      el.classList.remove('hidden');
      el.classList.remove('animate-fade-out');
      el.classList.add('animate-fade-in');
    }

    function hideForumActions() {
      const el = document.getElementById('forum-actions');
      el.classList.remove('animate-fade-in');
      el.classList.add('animate-fade-out');
      document.getElementById('forum-actions').classList.add('hidden');
      document.getElementById('forum-textarea').value = '';
      document.getElementById('image').value = '';
      document.getElementById('file-name').textContent = '';
      document.getElementById('image-preview').classList.add('hidden');
      document.getElementById('preview-img').src = '';
    }

    // Delay hide so animation can play
    setTimeout(() => {
      el.classList.add('hidden');
      document.getElementById('forum-textarea').value = '';
      document.getElementById('image').value = '';
      document.getElementById('file-name').textContent = '';
      document.getElementById('image-preview').classList.add('hidden');
      document.getElementById('preview-img').src = '';
    }, 200); // match with fade-out duration

    function updateFilePreview() {
      const fileInput = document.getElementById('image');
      const file = fileInput.files[0];

      const fileNameElem = document.getElementById('file-name');
      const previewElem = document.getElementById('preview-img');
      const previewContainer = document.getElementById('image-preview');

      if (file) {
        fileNameElem.textContent = file.name;

        const reader = new FileReader();
        reader.onload = function(e) {
          previewElem.src = e.target.result;
          previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        fileNameElem.textContent = '';
        previewElem.src = '';
        previewContainer.classList.add('hidden');
      }
    }
  </script>



  @include('content.js')
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

</body>

</html>