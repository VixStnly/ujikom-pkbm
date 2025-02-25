<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <!-- Include your CSS files here -->
</head>

<body class="layout-app">
    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Edit Tugas</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tugas</a></li>
                                <li class="breadcrumb-item active">Edit Tugas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Edit Tugas</div>
                                </div>
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Judul Tugas" value="{{ old('judul', $tugas->judul) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi Tugas" required>{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tenggat Waktu</label>
                                        <input type="date" name="tanggal_deadline" class="form-control" value="{{ old('tanggal_deadline', $tugas->tanggal_deadline) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="meeting_id">Pilih Pertemuan</label>
                                        <select name="meeting_id" id="meeting_id" class="form-control">
                                            <option value="">-- Pilih Pertemuan --</option>
                                            @foreach($meetings as $meeting)
                                                <option value="{{ $meeting->id }}" {{ $tugas->meeting_id == $meeting->id ? 'selected' : '' }}>
                                                    {{ $meeting->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">File (optional)</label>
                                        <input type="file" name="file" class="form-control">
                                        @if($tugas->file_path)
                                            <a href="{{ asset('storage/' . $tugas->file_path) }}" class="form-text text-muted" target="_blank">Lihat File Saat Ini</a>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Link (optional)</label>
                                        <input type="url" name="link" class="form-control" placeholder="Link Tugas" value="{{ old('link', $tugas->link) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Action</div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Update Materi</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex" href="{{ route('guru.tugas.index') }}"><strong>Kembali</strong></a>
                                        </div>
                                        <div class="list-group-item">
                                            <a href="#" id="delete-button" class="text-danger" data-toggle="popover" title="Hapus Materi" data-content='
                                                <form id="delete-form-{{ $tugas->id }}" action="{{ route("guru.tugas.destroy", $tugas->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
                                                </form>
                                                <button class="btn btn-secondary btn-sm" data-dismiss="popover">Batal</button>
                                            '>
                                                <strong>Hapus Tugas</strong>
                                                <i class="fa fa-trash"></i> <!-- Ikon trash -->
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @include('guru.footer')
        </div>
        @include('layouts.sidebarGuru')
    </div>

        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Tutup'
                });
            @endif
        });

        document.getElementById('delete-button').addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Materi ini akan dihapus secara permanen!',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('guru.tugas.destroy', $tugas->id) }}";
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>

    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('frontend/vendor/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js')}}"></script>
    <!-- Perfect Scrollbar -->
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js')}}"></script>
    <!-- DOM Factory -->
    <script src="{{ asset('frontend/vendor/dom-factory.js')}}"></script>
    <!-- MDK -->
    <script src="{{ asset('frontend/vendor/material-design-kit.js')}}"></script>
    <!-- App JS -->
    <script src="{{ asset('frontend/js/app.js')}}"></script>
    <!-- Preloader -->
    <script src="{{ asset('frontend/js/preloader.js')}}"></script>
    <!-- Global Settings -->
    <script src="{{ asset('frontend/js/settings.js')}}"></script>
    <!-- Moment.js -->
    <script src="{{ asset('frontend/vendor/moment.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('frontend/vendor/Chart.min.js')}}"></script>
    <!-- UI Charts Page JS -->
    <script src="{{ asset('frontend/js/chartjs-rounded-bar.js')}}"></script>
    <script src="{{ asset('frontend/js/chartjs.js')}}"></script>
    <!-- Chart.js Samples -->
    <script src="{{ asset('frontend/js/page.instructor-dashboard.js')}}"></script>
    <!-- List.js -->
    <script src="{{ asset('frontend/vendor/list.min.js')}}"></script>
    <script src="{{ asset('frontend/js/list.js')}}"></script>
    <script src="{{ asset('assets/js/form-basic-inputs.js')}}"></script>
</body>

</html>
