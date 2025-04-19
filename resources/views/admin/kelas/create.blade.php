<!-- HTML -->
@include ('content.html')
<head>
    @include('content.style')
    <script src="https://cdn.tailwindcss.com"></script>
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
                            <h2 class="mb-0">Buat Kelas</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item active">Buat</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ISI KONTENT -->
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="card card-body">

                                    <!-- Grade -->
                                    <div class="form-group">
                                    <label class="form-label"
                                           for="grade">Pilih Tingkatan</label>
                                    <select id="grade" name="grade"
                                            data-toggle="select"
                                            data-minimum-results-for-search="-1"
                                            class="form-control">
                                            <option value="" disabled selected>Pilih Paket</option>
                                            <option value="Paket A">Paket A</option>
                                            <option value="Paket B">Paket B</option>
                                            <option value="Paket C">Paket C</option>
                                    </select>
                                </div>
                                @error('grade')
    <div class="text-danger">{{ $message }}</div>
@enderror

                                    <!-- Nama Kelas -->
                                    <div class="form-group">
                                        <label class="form-label" for="name">Nama Kelas</label>
                                        <input type="text" id="name" name="name" 
                                               class="form-control" 
                                               placeholder="Masukkan Nama Kelas" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Buat Kelas</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex" href="{{ route('admin.kelas.index') }}"><strong>Kembali</strong></a>
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
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000",
            "positionClass": "toast-top-right"
        };

        @if($errors->any())
            toastr.error("{!! addslashes($errors->first()) !!}", "Terjadi Kesalahan!");
        @endif
    });
</script>

</body>
