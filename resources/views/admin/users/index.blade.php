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
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Data User</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data User</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" role="tablist">
                        <div class="col-auto">
                            <a href="{{ route('admin.users.createSiswa') }}" class="btn btn-outline-secondary">Tambah
                                Siswa</a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-secondary">Tambah
                                Data</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="pt-32pt">
                <div class="container page__container">
                    <div class="page-separator">
                        <div class="page-separator__text">Informasi Keseluruhan Data User</div>
                    </div>
                    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mb-5">
                        <div class="mb-4 flex gap-4 items-center">
                            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-4 w-full">
                                <input type="text" name="search" value="{{ $search }}" placeholder="Search..."
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <select name="role_id" class="p-2 border border-gray-300 rounded-lg">
                                    <option value="">Semua Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Filter</button>
                            </form>
                        </div>

                        <div class="flex">
                            <div class="flex-1 overflow-x-auto bg-white border border-gray-300 rounded-lg">
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
                                        <tr class="border-b">
                                            <td class="py-2 px-4">
                                                {{ ($users->currentPage() - 1) * $users->perPage() + ($index + 1) }}
                                            </td>
                                            <td class="py-2 px-4 flex items-center">
                                                <!-- Add circular image here -->

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
                                            <td class="py-2 px-4"> {{ $user->name }}
                                            </td>
                                            <td class="py-2 px-4">{{ $user->email }}</td>
                                            <td class="py-2 px-4">{{ $user->nisn_nip }}</td>
                                            <td class="py-2 px-4"><span
                                                    class="chip chip-outline-secondary d-inline-flex align-items-center">
                                                    {{ $user->role->name }}
                                                </span></td>

                                            <td class="py-2 px-4 text-center">
                                                <div class="flex justify-center items-center gap-4">
                                                    <!-- Flex container for action buttons -->
                                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                                        class="text-blue-500 hover:text-blue-600 transition-colors duration-300"
                                                        aria-label="View">
                                                        <i class="fa fa-eye fa-lg"></i>
                                                    </a>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="text-yellow-500 hover:text-yellow-600 transition-colors duration-300"
                                                        aria-label="Edit">
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </a>

                                                    <button type="button"
                                                        class="text-red-500 hover:text-red-600 transition-colors duration-300"
                                                        aria-label="Delete"
                                                        data-id="{{ $user->id }}"
                                                        onclick="openDeleteModal(this)">
                                                        <i class="fa fa-trash fa-lg"></i>
                                                    </button>

                                                </div>
                                            </td>

                                        </tr>
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
            <!-- END CONTENT -->
            @include ('guru.footer')
        </div>
        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>

    @include('content.js')

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-[#000000cc] backdrop-blur-sm flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-center">
            <h2 class="text-xl font-semibold mb-4">Hapus Pengguna</h2>
            <p class="mb-6 text-gray-600">Apakah kamu yakin ingin menghapus pengguna ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-4">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal(button) {
            const userId = button.getAttribute('data-id');
            const form = document.getElementById('deleteForm');
            form.action = `/admin/users/${userId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

</body>