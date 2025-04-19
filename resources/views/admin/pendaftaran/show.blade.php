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
            @foreach($pendaftarans as $index => $pendaftaran)

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Detail User: {{ $pendaftaran->nama_lengkap }}</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Detail User</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="container mx-auto mt-10 p-6 bg-gray-100 shadow-lg rounded-lg mb-5">
                <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Detail Pendaftar</h2>

                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <div class="mb-2">
                        <h3 class="font-semibold text-lg">INFORMASI ACCOUNT:</h3>
                        <strong class="text-gray-700">NIK:</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->nik }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Tempat Lahir:</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->tempat_lahir }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Tanggal Lahir :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->tanggal_lahir }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Jenis Kelamin :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->jenis_kelamin }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Agama :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->agama }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Email :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->email }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Nomor Telepon  :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->telepon }}</span>
                    </div>

                    <div class="mb-2">
                        <strong class="text-gray-700">Alamat :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->alamat }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Pilihan Paket Paket :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->paket }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-gray-700">Status :</strong> 
                        <span class="text-gray-600">{{ $pendaftaran->status }}</span>
                    </div>
                    <!-- Divider -->
                    <hr class="my-4 border-gray-400" />
                </div>
    @endforeach
</div>



                </div>
            </div>
            <!-- END Content Section -->

            @include('guru.footer')
        </div>
        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>

    @include('content.js')
</body>
