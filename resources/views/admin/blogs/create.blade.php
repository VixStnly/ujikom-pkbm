<!-- HTML -->
@include('content.html')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('content.style')

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.css" />
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/43.3.0/ckeditor5-premium-features.css" />
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.0/",
                "ckeditor5-premium-features": "https://cdn.ckeditor.com/ckeditor5-premium-features/43.3.0/ckeditor5-premium-features.js",
                "ckeditor5-premium-features/": "https://cdn.ckeditor.com/ckeditor5-premium-features/43.3.0/"
            }
        }
    </script>

    <style>
        .ck-editor__editable_inline {
            height: 200px;
        }
    </style>
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
                            <h2 class="mb-0">Tambah Blogs</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Blogs</a></li>
                                <li class="breadcrumb-item active">Add Blogs</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ISI KONTENT -->
                <!-- Bagian form -->
                <form action="{{ route('admin.blogs.store') }}" method="POST" id="myForm" enctype="multipart/form-data" onsubmit="return handleSubmit(event)">
                    @csrf
                    <div class="page-section border-bottom-2">
                        <div class="container page__container">
                            <div class="row align-items-start">
                                <div class="col-md-8">
                                    <div class="page-separator">
                                        <div class="page-separator__text">Informasi Blogs</div>
                                    </div>
                                    <div class="card card-body">
                                        <div class="form-group">
                                            <label class="form-label">Judul Blog</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Masukan Title" value="{{ old('title') }}" required>
                                            @error('title')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">Masukan judul blog</small>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label" for="description">Deskripsi</label>
                                                <!-- Input description as fallback -->
                                                <textarea name="description" id="myeditorinstance" rows="4" class="form-control">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">Masukkan isi berita</small>
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
                                                @error('image')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                                <label for="file" class="custom-file-label" id="file-label">Choose file</label>
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
                                            <button type="submit" class="btn btn-primary" id="create-btn">Buat Blog</button>
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
            @include ('guru.footer')
        </div>
        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>
    @include('content.js')

    <script>
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000",
            "positionClass": "toast-top-right"
        };

        @if(session('success'))
            toastr.success("{!! addslashes(session('success')) !!}", "Berhasil!");
        @endif

        @if($errors->any())
            toastr.error("{!! addslashes($errors->first()) !!}", "Terjadi Kesalahan!");
        @endif
    });
</script>

</body>
