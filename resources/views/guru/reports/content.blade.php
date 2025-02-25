@if(session('message'))
    <div class="alert alert-info">{{ session('message') }}</div>
@endif


<div class="pt-8">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Laporan</h2>
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Kelas</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="container mx-auto py-6">
    <div class="page-separator">
        <div class="page-separator__text">Daftar Kelas</div>
    </div>
    @if(isset($kelas) && $kelas->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kelas as $kelasItem)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-xl font-semibold mb-2">{{ $kelasItem->name }}</h3>
                    <p class="text-gray-700">Jumlah Siswa: {{ $kelasItem->users->count() }}</p>
                    <a href="{{ route('guru.reports.siswa', ['kelasId' => $kelasItem->id]) }}"
                        class="text-blue-500 hover:underline">Lihat Siswa</a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Tidak ada kelas yang tersedia.</p>
    @endif
</div>