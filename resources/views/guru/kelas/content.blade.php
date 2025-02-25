<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Kelas</h2>
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Kelas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Kelas Yang Anda Ajar</div>
    </div>

    @if($kelas->isEmpty())
        <div class="text-center text-gray-600">
            <p>Belum memiliki kelas.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
            @foreach($kelas as $kelasItem)
                <div class="bg-white shadow-lg rounded-lg p-4 transition-transform transform hover:scale-105 border border-gray-300">
                    <div class="flex items-center mb-1">
                        <h3 class="text-lg font-bold text-gray-800">{{ $kelasItem->name }}</h3>
                    </div>
                    <div class="card-footer">
                        <p class="text-gray-600 mb-1">Kelas ID: <span class="font-semibold text-gray-800">{{ $kelasItem->id }}</span></p>
                        <p class="text-gray-600 mb-4">Jumlah Siswa: <span class="font-semibold text-gray-800">{{ $kelasItem->jumlah_siswa }}</span></p>
                        
                        <!-- Tombol untuk halaman subject -->
                        <a href="{{ route('guru.kelas.pelajaran', ['kelas' => $kelasItem->id]) }}" class="py-2 px-4 rounded w-full text-center text-white bg-gradient-to-br from-blue-500 to-green-400 hover:from-green-500 hover:to-blue-500 transition duration-300">
                            Lihat Mata Pelajaran
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Pagination -->
    <div class="mb-32pt">
        <ul class="pagination justify-content-start pagination-xsm m-0">
            <li class="page-item {{ $kelas->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kelas->previousPageUrl() }}" aria-label="Previous" {{ $kelas->onFirstPage() ? 'tabindex="-1"' : '' }}>
                    <span aria-hidden="true" class="material-icons">chevron_left</span>
                    <span>Prev</span>
                </a>
            </li>
            @for ($i = 1; $i <= $kelas->lastPage(); $i++)
                <li class="page-item {{ $i == $kelas->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $kelas->url($i) }}" aria-label="Page {{ $i }}">
                        <span>{{ $i }}</span>
                    </a>
                </li>
            @endfor
            <li class="page-item {{ $kelas->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $kelas->nextPageUrl() }}" aria-label="Next" {{ !$kelas->hasMorePages() ? 'tabindex="-1"' : '' }}>
                    <span>Next</span>
                    <span aria-hidden="true" class="material-icons">chevron_right</span>
                </a>
            </li>
        </ul>
    </div>
</div>
