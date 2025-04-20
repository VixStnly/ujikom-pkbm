@include('content.html')
<head>
    @include('content.style')
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <!-- Navbar -->
            @include('layouts.NavSuper')

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Edit Blogs</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Blogs</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form to Edit Blog -->
            <form action="{{ route('admin.blogs.update', $blog->id) }}" id="myForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Informasi Blogs</div>
                                </div>
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul Blogs</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Masukan Title" value="{{ old('title', $blog->title) }}" required>
                                        @error('title')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Edit judul blog</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Deskripsi</label>
                                        <textarea name="description" id="myeditorinstance" class="form-control" rows="10" required>{{ old('description', $blog->description) }}</textarea>
                                        <input type="hidden" name="image_url" id="image-url">
                                        <small class="form-text text-muted">Isi Konten</small>
                                    </div>

                                    <script>
                                        function updateFileName() {
                                            var fileInput = document.getElementById('file');
                                            var fileName = fileInput.files[0] ? fileInput.files[0].name : 'Choose file';
                                            document.getElementById('file-label').textContent = fileName;
                                        }
                                    </script>

                                    <div class="form-group">
                                        <label class="form-label">Image (optional)</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="file" class="custom-file-input @error('image') is-invalid @enderror" onchange="updateFileName()">
                                            
                                            <!-- Preview Gambar Lama -->
                                            @if ($blog->image)
                                                <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}" class="mt-2 w-48 rounded-md shadow-md">
                                            @endif
                                            
                                            @error('image')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <label for="file" class="custom-file-label text-fixed" id="file-label">Pilih File</label>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Action</div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex" href="{{ route('admin.blogs.index') }}"><strong>Kembali</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END KONTENT -->

            @include('guru.footer')
        </div>

        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>

    @include('content.js')
    
</body>
