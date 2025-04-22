<!-- Drawer Layout -->
<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Tugas</h2>
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tugas</li>
                </ol>
            </div>
        </div>
        <div class="row" role="tablist">
            <div class="col-auto">
                <a href="{{ route('guru.tugas.create') }}" class="btn btn-outline-secondary">Tambah Tugas</a>
            </div>
        </div>
    </div>
</div>

<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Informasi Tugas</div>
    </div>
    <div class="row card-group-row">
        @if($tugass->isEmpty())
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                Tidak ada tugas untuk ditampilkan.
            </div>
        </div>
        @else
        @foreach ($tugass as $tugas)
        <div class="card-group-row__col col-md-6">
            <div class="card card-group-row__card card-sm">
                <div class="card-body d-flex align-items-center">
                    @php
                    $subject = $tugas->meeting->subject ?? null;
                    @endphp


                    <a href="{{ url('#', $tugas->id) }}" class="avatar avatar-4by3 mr-12pt">
                        @if($tugas->image)

                        <img src="{{ asset('storage/pelajaran/' . $subject->image) }}" class="card-img-top" alt="{{ $subject->name }}">
                        style="width: 64px; height: 48px; object-fit: cover;">
                        @else
                        <div class="position-relative" style="width: 64px; height: 48px; overflow: hidden;">
                            <img src="{{ asset('images/achievements/cover-pembelajaran.png') }}"
                                alt="Tugas {{ $tugas->judul }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                                <small class="text-white text-center px-1" style="font-size: 10px; text-shadow: 1px 1px 2px #000;">
                                    {{ $subject->name ?? 'Mata Pelajaran' }}
                                </small>

                            </div>
                        </div>
                        @endif




                    </a>
                    <div class="flex">
                        <a class="card-title" href="{{ url('#', $tugas->id) }}">{{ $tugas->judul }}</a>
                        <div class="card-subtitle text-50">{{ $tugas->completed_count }} Selesai</div>
                    </div>
                    <div class="mt-2 text-secondary d-flex d-block position-relative">
                        <i class="material-icons toggle-info" style="font-size: 16px; cursor: pointer;">info</i>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <div class="flex mr-2">
                            <a href="{{ route('guru.tugas.review', $tugas->id) }}" class="btn btn-light btn-sm">
                                <i class="material-icons icon--left">playlist_add_check</i> Tinjau
                                <span
                                    class="badge badge-dark badge-notifications ml-2">{{ $tugas->submissions_count }}</span>
                            </a>
                        </div>
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted">
                                <i class="material-icons">more_horiz</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('guru.tugas.edit', $tugas->id) }}" class="dropdown-item">Edit
                                    Tugas</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)"
                                    onclick="confirmDelete('{{ $tugas->judul }}', '{{ $tugas->id }}')"
                                    class="dropdown-item text-danger">Hapus Tugas <i class="fa fa-trash p-8pt"></i> <!-- Ikon trash --></a>
                                <form id="delete-form-{{ $tugas->id }}"
                                    action="{{ route('guru.tugas.destroy', $tugas->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div class="mb-32pt">
        <ul class="pagination justify-content-start pagination-xsm m-0">
            <!-- Previous Button -->
            <li class="page-item {{ $tugass->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tugass->previousPageUrl() }}" aria-label="Previous" {{ $tugass->onFirstPage() ? 'tabindex="-1"' : '' }}>
                    <span aria-hidden="true" class="material-icons">chevron_left</span>
                    <span>Prev</span>
                </a>
            </li>

            <!-- Page Numbers -->
            @for ($i = 1; $i <= $tugass->lastPage(); $i++)
                <li class="page-item {{ $i == $tugass->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $tugass->url($i) }}" aria-label="Page {{ $i }}">
                        <span>{{ $i }}</span>
                    </a>
                </li>
                @endfor

                <!-- Next Button -->
                <li class="page-item {{ $tugass->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $tugass->nextPageUrl() }}" aria-label="Next" {{ !$tugass->hasMorePages() ? 'tabindex="-1"' : '' }}>
                        <span>Next</span>
                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                    </a>
                </li>
        </ul>
    </div>
</div>

<style>
    .title-shadow {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        font-weight: bold;
        font-size: 1rem;
        color: #f1f1f1;
        text-shadow:
            -2px -2px 0 #003366,
            2px -2px 0 #003366,
            -2px 2px 0 #003366,
            2px 2px 0 #003366;
        padding: 10px;
        text-align: center;
        border-radius: 12px;
        line-height: 1.1;
        margin: 0;
        margin-top: 20px;
    }
</style>

<script>
    function confirmDelete(tugasJudul, tugasId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus tugas "${tugasJudul}".`,
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ff6f61', // Custom confirm button color
            cancelButtonColor: '#6c757d' // Custom cancel button color
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + tugasId).submit();
            }
        });
    }


    // JavaScript to toggle the info message without shifting the icon
    document.querySelectorAll('.toggle-info').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const infoMessage = this.nextElementSibling;
            if (infoMessage.style.display === 'none' || infoMessage.style.display === '') {
                infoMessage.style.display = 'block';
            } else {
                infoMessage.style.display = 'none';
            }
        });
    });

    // JavaScript to show toastr message on clicking the info icon
    document.querySelectorAll('.toggle-info').forEach(function(icon) {
        icon.addEventListener('click', function() {
            toastr.info("Gambar akan muncul ketika Tugas terhubung dengan Pertemuan.", "Informasi", {
                closeButton: true,
                progressBar: true,
                timeOut: "5000" // 5 seconds
            });
        });
    });

    $(document).ready(function() {
        // Additional toastr settings (optional)
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000", // 5 seconds
        };
    });
</script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>