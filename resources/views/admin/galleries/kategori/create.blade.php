@include('content.html')

<head>
    @include('content.style')
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout"
        data-push
        data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <!-- Navbar -->
            @include ('layouts.NavSuper')

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Create Kategori</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
                                <li class="breadcrumb-item active">Create Kategori</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Create Kategori -->
            <form action="{{ route('kategori_galeri.store') }}" method="POST">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Informasi Kategori</div>
                                </div>
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label">Nama Kategori</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama kategori">
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Action</div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Tambah Kategori</button>
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
            <!-- END Form -->
            @include ('guru.footer')
        </div>
        
        <!-- Sidebar -->
        @include ('layouts.sidebarSuper')
    </div>

    @include ('content.js')
</body>
