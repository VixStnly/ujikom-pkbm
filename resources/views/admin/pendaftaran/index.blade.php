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
                    $(document).ready(function () {
                        toastr.success("{{ session('success') }}", "Berhasil!", {
                            closeButton: true,
                            progressBar: true,
                        });
                    });
                </script>
            @endif
                <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                    <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                        <h2 class="mb-0">Data Pendaftaran</h2>
                        <ol class="breadcrumb p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Pendaftaran</li>
                        </ol>
                    </div>
                </div>

                <div class="row" role="tablist">
                    <div class="col-auto">
                        <a href="#" class="btn btn-outline-secondary">Tambah Pendaftaran</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="pt-32pt">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Informasi Keseluruhan Data Pendaftaran</div>
                </div>
                <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mb-5">
                    <div class="mb-4 flex gap-4 items-center">
                        <form action="{{ route('admin.pendaftaran.index') }}" method="GET" class="flex gap-4 w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Filter</button>
                        </form>
                    </div>

                    <div class="flex">
                        <div class="flex-1 bg-white border border-gray-300 rounded-lg">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-700 border-b">
                                        <th class="py-2 px-4 text-left">No</th>
                                        <th class="py-2 px-4 text-left">Nama Lengkap</th>
                                        <th class="py-2 px-4 text-left">NIK</th>
                                        <th class="py-2 px-4 text-left">Email</th>
                                        <th class="py-2 px-4 text-left">Telepon</th>
                                        <th class="py-2 px-4 text-left">Status</th>
                                        <th class="py-2 px-4 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftarans as $index => $pendaftaran)
                                        <tr class="border-b">
                                            <td class="py-2 px-4">
                                                {{ ($pendaftarans->currentPage() - 1) * $pendaftarans->perPage() + ($index + 1) }}
                                            </td>
                                            <td class="py-2 px-4">{{ $pendaftaran->nama_lengkap }}</td>
                                            <td class="py-2 px-4">{{ $pendaftaran->nik }}</td>
                                            <td class="py-2 px-4">{{ $pendaftaran->email }}</td>
                                            <td class="py-2 px-4">{{ $pendaftaran->telepon }}</td>
                                            <td class="py-2 px-4">
                                                <span class="badge 
                                                    {{ $pendaftaran->status == 'approved' ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded">
                                                    {{ ucfirst($pendaftaran->status) }}
                                                </span>
                                            </td>
                                            <td class="py-2 px-4 text-center">
                                                <div class="flex justify-center items-center gap-4">
                                                     <a href="#"
                                                        class="text-blue-500 hover:text-blue-600 transition-colors duration-300"
                                                        aria-label="View">
                                                        <i class="fa fa-eye fa-lg"></i>
                                                    </a> 
                                                    <a href="#"
                                                        class="text-yellow-500 hover:text-yellow-600 transition-colors duration-300"
                                                        aria-label="Edit">
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </a> 

                                                    <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure you want to delete this registration?');"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-500 hover:text-red-600 transition-colors duration-300"
                                                            aria-label="Delete">
                                                            <i class="fa fa-trash fa-lg"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        {{ $pendaftarans->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
        @include ('guru.footer')

        @include('layouts.sidebarSuper')

    </div>
    @include('content.js')
</body>