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
                            <h2 class="mb-0">Kelas</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Kelas</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('admin.kelas.create') }}" class="btn btn-outline-secondary">Tambah Kelas</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ISI KONTENT -->
            <div class="pt-32pt">
                <div class="container page__container">
                <div class="page-separator">
                        <div class="page-separator__text">Informasi Data Kelas</div>
                    </div>
                    <div class=" overflow-x-auto container mx-auto" style="width: 56rem;">

                        <div class=" overflow-x-auto bg-white shadow-md rounded-lg overflow-hidden">
                            <h5 class="bg-gray-200 text-lg font-semibold p-4">Data Kelas</h5>

                            <div class="table-responsive overflow-x-auto" 
                                data-toggle="lists" 
                                data-lists-sort-by="js-lists-values-date" 
                                data-lists-sort-desc="true" 
                                data-lists-values='["js-lists-values-name", "js-lists-values-company", "js-lists-values-phone", "js-lists-values-date"]'>
<div class="overflow-x-auto">
                                <table class="table mb-0 thead-border-top-0 table-nowrap table-sm">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">ID</a>
                                            </th>
                                            <th>Tingkatan</th>
                                            <th style="max-width: 200px;">Nama Kelas</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="clients">
                                        @foreach($kelas as $item)
                                            <tr>
                                                <td>
                                                    <strong class="js-lists-values-name">{{ $item->id }}</strong>
                                                </td>
                                                <td>
                                                    <span class="chip chip-outline-secondary">{{ $item->grade }}</span>
                                                </td>
                                                <td>
                                                    <small class="js-lists-values-phone text-50">{{ $item->name }}</small>
                                                </td>
                                                <td class="text-right">
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('admin.kelas.edit', $item->id) }}" class="text-primary mr-3" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.kelas.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link text-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this kelas?');">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table></div>
                            </div>
                        </div>
                        <!-- Pagination Links -->
                        <div class="mt-6 mb-5">
                            {{ $kelas->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- END KONTENT -->
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
