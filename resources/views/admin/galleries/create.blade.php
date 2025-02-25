@include('content.html')

<head>
    @include('content.style')
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('layouts.NavSuper')

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Tambah Gambar</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
                                <li class="breadcrumb-item active">Add Gambar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Informasi Galeri</div>
                                </div>
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label">Masukan Gambar</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="file" class="custom-file-input @error('image') is-invalid @enderror" onchange="updateFileName()">
                                            @error('image')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <label for="file" class="custom-file-label" id="file-label">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="kategori_id" class="form-label">Pilih Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <script>
                                        function updateFileName() {
                                            var fileInput = document.getElementById('file');
                                            var fileName = fileInput.files[0] ? fileInput.files[0].name : 'Choose file';
                                            document.getElementById('file-label').textContent = fileName;
                                        }
                                    </script>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Action</div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Tambah Gambar</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex" href="{{ route('admin.gallery.index') }}"><strong>Kembali</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @include ('guru.footer')
        </div>

        @include('layouts.sidebarSuper')
    </div>

    @include('content.js')
</body>
