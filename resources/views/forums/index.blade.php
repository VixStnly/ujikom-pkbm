<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forum Chat</title>
 <!-- Link ke Tailwind CSS dan Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Ikon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon"></head>
<body class="bg-gray-100">
    @include('layouts.NavSiswa')

    <div class="mt-[80px] flex justify-center">
  <div class="h-52 w-full max-w-7xl bg-cover bg-center text-white flex justify-center items-center rounded-lg shadow-md" style="background-image: url('{{ asset('assets/img/image.png') }}');">
    <h1 class="text-2xl font-bold text-center px-4">{{ $meeting->title }} - Forum Chat</h1>
  </div>
</div>


  <!-- Main Content -->
  <div class="container mx-auto px-4 mt-6">
    <div class="flex flex-col md:flex-row gap-4">

      <!-- Kotak Informasi (kiri) -->
      <div class="w-full md:w-1/4">
        <div class="bg-white p-4 rounded shadow max-h-60">
          <h2 class="text-xl font-semibold mb-2">Informasi Forum</h2>
          <p class="text-sm text-gray-700">Tempat diskusi seputar topik pertemuan ini. Silakan kirim pertanyaan atau balasan di kolom sebelah kanan.</p>
        </div>
      </div>

      <!-- Forum Q&A (kanan) -->
      <div class="w-full md:w-3/4">
        <!-- Form Pertanyaan -->
        <form action="{{ route('forum.store', $meeting->id) }}" method="POST" enctype="multipart/form-data" class="mb-4 bg-white p-4 rounded shadow transition-all duration-300">
  @csrf
  <textarea 
    id="forum-textarea"
    name="message" 
    rows="1" 
    class="w-full p-2 border rounded mb-2 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-300" 
    placeholder="Tulis pertanyaan..." 
    onclick="showForumActions()"
  ></textarea>

  <!-- Elemen yang disembunyikan awalnya -->
  <div id="forum-actions" class="hidden">
    <div class="flex justify-between items-center mb-2">
      <label for="image" class="text-blue-500 cursor-pointer">Upload Gambar</label>
      <input type="file" id="image" name="image" class="hidden">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
    </div>
    <button type="button" onclick="hideForumActions()" class="text-sm text-red-500">Batal</button>
  </div>
</form>

<script>
  function showForumActions() {
    document.getElementById('forum-actions').classList.remove('hidden');
    document.getElementById('forum-textarea').rows = 3;
  }

  function hideForumActions() {
    document.getElementById('forum-actions').classList.add('hidden');
    const textarea = document.getElementById('forum-textarea');
    textarea.value = '';
    textarea.rows = 1;
  }
</script>


        <!-- Daftar Pertanyaan -->
        @foreach ($forums->where('parent_id', null) as $forum)
          <div class="bg-white p-4 rounded shadow mb-4">
            <div class="flex justify-between text-sm text-gray-600">
              <span><strong>{{ $forum->user->name }}</strong></span>
              <span>{{ $forum->created_at->diffForHumans() }}</span>
            </div>
            <p class="mt-2">{{ $forum->message }}</p>
            @if ($forum->image_path)
              <img src="{{ asset('storage/' . $forum->image_path) }}" class="mt-2 rounded max-w-xs">
            @endif

            <!-- Balasan Toggle -->
            <button class="text-sm text-blue-500 mt-2" data-bs-toggle="collapse" data-bs-target="#replies-{{ $forum->id }}">
              Lihat Balasan ({{ $forum->replies->count() }})
            </button>

            <div class="collapse mt-2" id="replies-{{ $forum->id }}">
              @foreach ($forum->replies as $reply)
                <div class="bg-gray-100 p-3 my-2 rounded">
                  <div class="text-sm font-semibold">{{ $reply->user->name }}</div>
                  <p class="text-sm">{{ $reply->message }}</p>
                  @if ($reply->image_path)
                    <img src="{{ asset('storage/' . $reply->image_path) }}" class="mt-1 rounded max-w-xs">
                  @endif
                </div>
              @endforeach
            </div>

            <!-- Form Balas Toggle -->
            <button class="text-sm text-blue-500 mt-2" data-bs-toggle="collapse" data-bs-target="#form-reply-{{ $forum->id }}">
              Balas
            </button>
            <div class="collapse mt-2" id="form-reply-{{ $forum->id }}">
              <form action="{{ route('forum.store', $meeting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $forum->id }}">
                <textarea name="message" rows="2" class="w-full p-2 border rounded mb-2" placeholder="Tulis balasan..."></textarea>
                <input type="file" name="image" class="mb-2">
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Kirim Balasan</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>

  <!-- Bootstrap JS buat collapse -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
