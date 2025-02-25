@include('content.html')
<head>
    @include('content.style')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <!-- Navbar -->
            @include('layouts.NavSuper')

            @if(session('success'))
                <script>
                    $(document).ready(function() {
                        toastr.success("{{ session('success') }}", "Well Done!", {
                            closeButton: true,
                            progressBar: true,
                        });
                    });
                </script>
            @endif

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Gallery</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Gallery</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-outline-secondary">Tambah Gambar</a>
                            <a href="{{ route('kategori_galeri.create') }}" class="btn btn-outline-secondary">Tambah Kategori</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="page-section border-bottom-2">
                <div class="container page__container">
                    <div class="row align-items-start">
                        <div class="col-md-12">
                            <div class="page-separator">
                                <div class="page-separator__text">Informasi Gallery</div>
                            </div>

                            <!-- Filter Dropdown -->
                            <div class="mb-4">
                                <form action="{{ route('admin.gallery.index') }}" method="GET">
                                    <label for="kategori_id" class="form-label">Filter by Kategori</label>
                                    <select name="kategori_id" id="kategori_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">-- Semua Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('kategori_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>

                            <div class="row">
                                @foreach ($galleries as $gallery)
                                    <div class="col-md-4 mb-3"> <!-- Use col-md-3 for 4 cards per row -->
                                        <div class="card flex">
                                            <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top object-cover w-full h-48" alt="Gallery Image"> <!-- Added classes for fixed size -->
                                            <div class="card-body">
                                                <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?');">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-center mt-4">
                                {{ $galleries->links('vendor.pagination.tailwind') }} <!-- Use Tailwind pagination view -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
            @include ('guru.footer')
        </div>
        

        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>

    <script>
        $(document).ready(function() {
            // Additional toastr settings (optional)
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000", // 5 seconds
            };
        });
    </script>

    @include('content.js')
</body>
