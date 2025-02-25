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
    <!-- Sidebar Siswa (dari layout yang sudah ada) -->
    <!-- Anda mungkin perlu menambahkan sidebar Siswa di sini, jika ada -->

    <!-- Main Content -->
    <div class="flex-1 p-8 bg-white shadow rounded-lg ">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Data Siswa</h1>
            <h5>Disini Tempat untuk mengatur data</h5>
      <button class="bg-blue-500 text-white px-2 py-1 rounded">      <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Siswa</a></button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Siswa Table -->
            <div class="col-span-2">
                <form action="{{ route('admin.siswas.index') }}" method="GET" class="mb-4">
                    <input type="text" name="search" placeholder="Search siswa..." value="{{ $search }}" class="border p-2 rounded w-full">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Search</button>
                </form>

                <table class="min-w-full bg-white border-2 border-black-500">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-2 border-black-500">No</th>
                            <th class="py-2 px-4 border-2 border-black-500">NISN/NIP</th>
                            <th class="py-2 px-4 border-2 border-black-500">Nama</th>
                            <th class="py-2 px-4 border-2 border-black-500">Email</th>
                            <th class="py-2 px-4 border-2 border-black-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $index => $siswa)
                            <tr>
                                <td class="py-2 px-4 border-2 border-black-500">{{ $index + 1 }}</td>
                                <td class="py-2 px-4 border-2 border-black-500">{{ $siswa->nisn_nip }}</td>
                                <td class="py-2 px-4 border-2 border-black-500">{{ $siswa->name }}</td>
                                <td class="py-2 px-4 border-2 border-black-500">{{ $siswa->email }}</td>
                                <td class="py-2 px-4 border-2 border-black-500">
                                  <button class="bg-yellow-500 text-white px-2 py-1 rounded">  <a href="{{ route('admin.users.edit', $siswa->id) }}" >Edit</a></button>
                                    <form action="{{ route('admin.users.destroy', $siswa->id) }}" method="POST" class="inline">
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
                {{ $siswas->links() }}
            </div>

            <!-- Sidebar untuk Aktivitas Pembuatan Akun -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Aktivitas Pembuatan Akun</h2>
                <div class="bg-white shadow p-4 rounded-lg">
                    @foreach($siswas as $siswa)
                        <div class="mb-2 p-2 border-b border-black-500 text-sm">
                            <p class="text-green-500 font-semibold">{{ $siswa->email }}</p>
                            <p class="text-gray-600">{{ $siswa->created_at->format('d-m-Y H:i:s') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


</body>