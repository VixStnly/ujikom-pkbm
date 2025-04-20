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
                                                    <form action="{{ route('admin.kelas.destroy', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" id="delete-button-{{ $item->id }}" class="btn btn-link text-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>

                                                    <script>
                                                        document.getElementById('delete-button-{{ $item->id }}').addEventListener('click', function() {
                                                            Swal.fire({
                                                                title: 'Apakah Anda yakin?',
                                                                text: "Data ini akan dihapus secara permanen dan tidak dapat dikembalikan!",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#d33',
                                                                cancelButtonColor: '#3085d6',
                                                                confirmButtonText: 'Ya, hapus!',
                                                                cancelButtonText: 'Batal',
                                                                reverseButtons: true,
                                                                customClass: {
                                                                    popup: 'animated fadeInDown faster',
                                                                    confirmButton: 'bg-red-600 text-white px-4 py-2 rounded ml-2',
                                                                    cancelButton: 'bg-gray-300 text-black px-4 py-2 rounded ml-3'
                                                                }
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    Swal.fire({
                                                                        title: 'Terhapus!',
                                                                        text: 'Data berhasil dihapus.',
                                                                        icon: 'success',
                                                                        timer: 2000,
                                                                        showConfirmButton: false
                                                                    });
                                                                    setTimeout(() => {
                                                                        document.getElementById('delete-form-{{ $item->id }}').submit();
                                                                    }, 2000);
                                                                }
                                                            });
                                                        });
                                                    </script>
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

    @include('content.js')

        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Scripts -->
<script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/popper.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/dom-factory.js') }}"></script>
<script src="{{ asset('frontend/vendor/material-design-kit.js') }}"></script>
<script src="{{ asset('frontend/js/app.js') }}"></script>
<script src="{{ asset('frontend/js/preloader.js') }}"></script>
<script src="{{ asset('frontend/js/settings.js') }}"></script>
<script src="{{ asset('frontend/vendor/moment.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/moment-range.js') }}"></script>
<script src="{{ asset('frontend/vendor/Chart.min.js') }}"></script>
<script src="{{ asset('frontend/js/chartjs-rounded-bar.js') }}"></script>
<script src="{{ asset('frontend/js/chartjs.js') }}"></script>
<script src="{{ asset('frontend/vendor/list.min.js') }}"></script>
<script src="{{ asset('frontend/js/list.js') }}"></script>

</body>