<!-- HTML -->
@include ('content.html')
<head>
    @include('content.style')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
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
                                <h2 class="mb-0">Tambah Pengumuman</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="index.html">Pengumuman</a></li>

                                    <li class="breadcrumb-item active">

                                        Add Pengumuman

                                    </li>

                                </ol>

                            </div>
                        </div>

                    </div>
                </div>

            <!-- ISI KONTENT -->
            <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return handleSubmit(event)">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                            <div class="page-separator">
                                <div class="page-separator__text">Informasi Pengumuman</div>
                            </div>
                            <div class="card card-body">

                                <div class="form-group">
                                    <label class="form-label">Judul</label>
                                    <input type="text"
                                        class="form-control"
                                        name="title" id="title"
                                        placeholder="Masukan Title"
                                        required>
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    <small class="form-text text-muted">Masukan Judul</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="description">Deskripsi</label>
                                    <textarea id="description" rows="10" class="form-control" placeholder="Masukan Isi" required></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Masukan Deskripsi</small>
                                </div>
                            </div>

                            </div>
                            <div class="col-md-4">
                            <div class="page-separator">
                                <div class="page-separator__text">Action</div>
                            </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Create Pengumuman</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex" href="{{ route('admin.announcements.index') }}"><strong>Kembali</strong></a>
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
            @include ('layouts.sidebarSuper')
    </div>
    @include ('content.js')
    
<script>
    // Initialize CKEditor on the div
    CKEDITOR.replace('description', {
        // Additional configuration can go here if needed
    });

    function handleSubmit(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the data from CKEditor
        const descriptionData = CKEDITOR.instances.description.getData();
        
        // Set the data to a hidden input for submission
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'description';
        hiddenInput.value = descriptionData;

        // Append hidden input to the form
        event.target.appendChild(hiddenInput);

        // Now submit the form
        event.target.submit();
    }
</script>

</body>
