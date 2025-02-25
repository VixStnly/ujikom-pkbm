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
                                <h2 class="mb-0">Pengumuman</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>

                                    <li class="breadcrumb-item active">

                                        Pengumuman

                                    </li>

                                </ol>

                            </div>
                        </div>

                        <div class="row"
                             role="tablist">
                            <div class="col-auto">
                                <a href="{{ route('admin.announcements.create') }}"
                                   class="btn btn-outline-secondary">Tambah Pengumuman</a>
                            </div>
                        </div>

                    </div>
                </div>

            <!-- ISI KONTENT -->
            <div class="container mx-auto px-4 py-8">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <h5 class="bg-gray-200 text-lg font-semibold p-4">Table Pengumuman</h5>

                            <div class="table-responsive"
                                data-toggle="lists"
                                data-lists-sort-by="js-lists-values-date"
                                data-lists-sort-desc="true"
                                data-lists-values='["js-lists-values-name", "js-lists-values-company", "js-lists-values-phone", "js-lists-values-date"]'>

                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Judul</a>
                                            </th>
                                            <th>Deskripsi</th>
                                            <th style="width: 120px;" class="pl-4">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody class="list" id="clients">
                                    @foreach ($announcements as $announcement)
                                        <tr>
                                            <td>
                                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                                    <div class="avatar avatar-sm mr-8pt">
                                                        <span class="avatar-title rounded-circle">PP</span>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="d-flex flex-column">
                                                            <p class="mb-0"><strong class="js-lists-values-name">{{ $announcement->title }}</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <small class="text-50">{!! $announcement->description !!}</small>
                                            </td>

                                            <td class="text-right">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="text-primary mr-3" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this blog?');">
                                                            <i class="fas fa-trash-alt"></i>
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
                        <div class="flex justify-center mt-4">
                                {{ $announcements->links('vendor.pagination.tailwind') }} <!-- Use Tailwind pagination view -->
                            </div>
            </div>
                    <!-- END KONTENT -->
                    @include ('guru.footer')
                </div>
                    <!-- Sidebar -->
                    @include ('layouts.sidebarSuper')
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
    
    @include ('content.js')
</body>
