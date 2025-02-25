@include('content.html')

<head>
    @include('content.style')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
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

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Data Guru</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data Guru</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-secondary">Tambah Data</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="pt-32pt">
                <div class="container page__container">
                    <div class="page-separator">
                        <div class="page-separator__text">Informasi Keseluruhan Data Guru</div>
                    </div>
                    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mb-5">
                        <div class="mb-4 flex gap-4 items-center">
                            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-4 w-full">
                                <input type="text" name="search" value="{{ $search }}" placeholder="Search..."
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="submit"
                                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Filter</button>
                            </form>
                        </div>

                        <div class="flex">
                            <div class="flex-1 bg-white border border-gray-300 rounded-lg">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-700 border-b">
                                            <th class="py-2 px-4 text-left">No</th>
                                            <th class="py-2 px-4 text-left">Image</th>
                                            <th class="py-2 px-4 text-left">Name</th>
                                            <th class="py-2 px-4 text-left">Email</th>
                                            <th class="py-2 px-4 text-left">NISN/NIP</th>
                                            <th class="py-2 px-4 text-left">Role</th>
                                            <th class="py-2 px-4 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $index => $user)
                                            @if($user->role_id === 3) <!-- Filter only for role_id 3 (Guru) -->
                                                <tr class="border-b">
                                                    <td class="py-2 px-4">
                                                        {{ ($users->currentPage() - 1) * $users->perPage() + ($index + 1) }}
                                                    </td>
                                                    <td class="py-2 px-4 flex items-center">
                                                        @if ($user->profile_image)
                                                            <img src="{{ Storage::url('profil/' . $user->profile_image) }}"
                                                                alt="{{ $user->name }}" class="rounded-circle"
                                                                style="width: 38px; height: 38px; object-fit: cover; margin-right: 8px;">
                                                        @else
                                                            <span
                                                                class="avatar-title rounded-full bg-primary w-8 h-8 flex items-center justify-center"
                                                                style="width: 38px; height: 39px; object-fit: cover; margin-right: 8px;">
                                                                <i class="material-icons text-white">account_box</i>
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="py-2 px-4">{{ $user->name }}</td>
                                                    <td class="py-2 px-4">{{ $user->email }}</td>
                                                    <td class="py-2 px-4">{{ $user->nisn_nip }}</td>
                                                    <td class="py-2 px-4"><span
                                                            class="chip chip-outline-secondary d-inline-flex align-items-center">
                                                            {{ $user->role->name }}
                                                        </span></td>

                                                        <td class="py-2 px-4 text-center">
    <form action="{{ route('impersonate', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Monitoring
        </button>
    </form>
</td>




                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-4">
                            {{ $users->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
            @include ('guru.footer')
        </div>
        @include('layouts.sidebarSuper')
    </div>

    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000", // 5 seconds
            };
        });
    </script>

    @include('content.js')
</body>
