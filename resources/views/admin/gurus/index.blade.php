<!-- resources/views/admin/gurus/index.blade.php -->

<!-- HTML -->
@include ('content.html')

<head>
<!-- style Css -->
@include ('content.style')
</head>
<body class="layout-sticky-subnav layout-learnly ">
@include ('layouts.NavSuper')     
@include ('layouts.sidebarAdmin')
@extends ('content.js')

<!-- ISI KONTEN DISINI -->
<div class="flex">
        <!-- Main Content -->
        <div class="flex-1 p-6 bg-white shadow rounded-lg mt-5">
            <!-- Display Success Message -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Data User</h1>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors duration-200">
                    <a href="{{ route('admin.users.create') }}" class="text-white">Add User</a>
                </button>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
                <input type="text" name="search" placeholder="Search users..." value="{{ $search }}" class="border p-2 rounded w-full">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2 hover:bg-green-600 transition-colors duration-200">Search</button>
            </form>

            <!-- User Table -->
            <!-- Your existing Blade template -->
<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">No</th>
            <th class="py-2 px-4 border-b">NISN/NIP</th>
            <th class="py-2 px-4 border-b">Nama</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Role</th>
            <th class="py-2 px-4 border-b">Kelas</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($gurus as $index => $guru)
            <tr class="hover:bg-gray-100 transition-colors duration-200">
            <td class="py-2 px-4 border-b">{{ ($gurus->currentPage() - 1) * $gurus->perPage() + $loop->iteration }}</td>
            <td class="py-2 px-4 border-b">{{ $guru->nisn_nip }}</td>
                <td class="py-2 px-4 border-b">{{ $guru->name }}</td>
                <td class="py-2 px-4 border-b">{{ $guru->email }}</td>
                <td class="py-2 px-4 border-b">{{ $guru->role->name }}</td>
                <td class="py-2 px-4 border-b">{{ $guru->kelas ? $guru->kelas->name : 'N/A' }}</td>
                <td class="py-2  border-b flex space-x-2">
                    <a href="{{ route('admin.users.edit', $guru->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 transition-colors duration-200">Edit</a>
                    <form action="{{ route('admin.users.destroy', $guru->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition-colors duration-200">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


            <!-- Pagination -->
            {{ $gurus->links() }}
        </div>

        <!-- Sidebar untuk Aktivitas Pembuatan Akun -->
        <div class="w-80 p-6 bg-gray-100 shadow rounded-lg ml-4">
            <h2 class="text-xl font-semibold mb-4">Aktivitas Pembuatan Akun</h2>
            <div class="bg-white p-4 rounded-lg shadow">
                @foreach($recentActivities as $activity)
                    <div class="mb-2 p-2 border-b border-gray-300 text-sm">
                        <p class="text-green-500 font-semibold">{{ $activity->email }}</p>
                        <p class="text-gray-600">{{ $activity->created_at->format('d-m-Y H:i:s') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</body>

