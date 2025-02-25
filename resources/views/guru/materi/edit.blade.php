<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="layout-app">

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <span>{{ session('success') }}</span>
            <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
        </div>
    @endif

    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('guru.navbar')
            <!-- Page Content -->
            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Edit Materi</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Pertemuan</a></li>
                                <li class="breadcrumb-item active">Edit Materi</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="card card-body">

                                    <div class="form-group">
                                        <label class="form-label">Judul Materi</label>
                                        <input name="judul" type="text" class="form-control"
                                            placeholder="Masukan Judul Materi"
                                            value="{{ old('judul', $materi->judul) }}" required>
                                        @error('judul')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Deskripsi</label>
                                        <textarea name="konten" class="form-control" rows="3"
                                            placeholder="Deskripsi Materi">{{ old('konten', $materi->konten) }}</textarea>
                                        @error('konten')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">File</label>
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="file"
                                                onchange="updateFileName()">
                                            <!-- Preview Gambar Lama -->
                                            @if ($materi->file_path)
                                                <a href="{{ asset('storage/' . $materi->file_path) }}"
                                                    class="form-text text-muted" target="_blank">Lihat
                                                    File Saat Ini</a>
                                            @endif
                                            @error('file')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <label for="file" class="custom-file-label" id="file-label">Choose
                                                file</label>
                                            <small class="form-text text-muted">File yang diizinkan: PDF, DOCX, PPTX,
                                                PNG, JPG, JPEG Maksimal ukuran: 20MB.</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="meeting_id">Pilih Meeting</label>
                                        <select id="meeting_id" name="meeting_id" data-toggle="select"
                                            data-minimum-results-for-search="-1" class="form-control">
                                            @foreach($meetings as $meeting)
                                                <option value="{{ $meeting->id }}" {{ $materi->meeting_id == $meeting->id ? 'selected' : '' }}>
                                                    {{ $meeting->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('meeting_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Link (Opsional)</label>
                                        <input type="url" name="link" class="form-control" placeholder="Masukkan Link"
                                            value="{{ old('link', $materi->link) }}">
                                        <small class="form-text text-muted">Tambahkan Link terkait materi ini
                                            (opsional).</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Update Materi</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex"
                                                href="{{ route('guru.materi.index') }}"><strong>Kembali</strong></a>
                                        </div>
                                        <div class="list-group-item">
                                            <a href="#" id="delete-button" class="text-danger" data-toggle="popover"
                                                title="Hapus Materi" data-content='
        <form id="delete-form-{{ $materi->id }}" action="{{ route("guru.materi.destroy", $materi->id) }}" method="POST" style="display: inline;">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
        </form>
        <button class="btn btn-secondary btn-sm" data-dismiss="popover">Batal</button>
    '>
                                                
                                                <strong>Hapus Materi</strong>
                                                <i class="fa fa-trash p-10 pt"></i> <!-- Ikon trash -->
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                function updateFileName() {
                    const input = document.getElementById('file');
                    const label = document.getElementById('file-label');
                    const fileName = input.files[0] ? input.files[0].name : 'Choose file';
                    label.textContent = fileName;
                }
            </script>

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
                    form.action = "{{ route('guru.materi.destroy', $materi->id) }}";
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
</body>

</html>

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

<!-- Custom Script for SweetAlert2 -->
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
</script>