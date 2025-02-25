<!-- resources/views/admin/admins/index.blade.php -->
<head>
<!-- style Css -->
@include ('content.style')
</head>
<body class="layout-sticky-subnav layout-learnly ">
@include ('layouts.NavSiswa')    
@include ('layouts.sidebarAdmin')
@extends ('content.js')

<!-- ISI KONTEN DISINI -->
<div class="p-6 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Data Admin</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Admin</a>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('admin.admins.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Search admins..." value="{{ $search }}" class="border p-2 rounded">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Search</button>
        </form>

        <!-- Admin Table -->
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">NISN/NIP</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $index => $admin)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $admin->nisn_nip }}</td>
                        <td class="py-2 px-4 border-b">{{ $admin->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $admin->email }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.users.edit', $admin->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                            <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $admins->links() }}
    </div>

</body>

