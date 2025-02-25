<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <link rel="stylesheet" href="{{ asset('path/to/your/styles.css') }}"> <!-- Adjust path -->
    <!-- Include other necessary CSS files -->
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

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Buat Materi Baru</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item active">Buat Materi</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('guru.materi.store', ['meeting_id' => old('meeting_id', $meeting_id ?? null)]) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row">

                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Informasi Dasar</div>
                                </div>

                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul Materi</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Judul Materi" required value="{{ old('judul') }}">
                                        @error('judul')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="konten" class="form-control" rows="3" placeholder="Deskripsi Materi">{{ old('konten') }}</textarea>
                                        @error('konten')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">File</label>
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="file" onchange="updateFileName()">
                                            <label for="file" class="custom-file-label" id="file-label">Choose file</label>
                                            @error('file')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">File yang diizinkan: PDF, DOCX, PPTX, PNG, JPG, JPEG. Maksimal ukuran: 20MB.</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Pertemuan</label>
                                        @if($meeting)
                                            <input type="text" class="form-control" value="{{ $meeting->title }}" readonly>
                                            <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                                        @else
                                            <p class="text-muted">Tidak ada pertemuan yang tersedia.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Preview</div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <label class="form-label">Link (Opsional)</label>
                                        <input type="url" name="link" class="form-control" placeholder="Link Tugas" value="{{ old('link') }}">
                                        <small class="form-text text-muted">Tambahkan Link terkait materi ini.</small>
                                        @error('link')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="card-footer d-flex">
                                        <button type="submit" class="btn btn-primary ml-3">Tambah Materi</button>
                                        <a href="{{ route('guru.meeting.index') }}" class="btn btn-secondary ml-3">Kembali</a>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function updateFileName() {
            const fileInput = document.getElementById('file');
            const fileLabel = document.getElementById('file-label');
            const fileName = fileInput.files[0] ? fileInput.files[0].name : 'Choose file';
            fileLabel.innerText = fileName;
        }

        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Tutup'
                });
            @endif
        });
    </script>

    <!-- jQuery and Bootstrap -->
    <script src="{{ asset('frontend/vendor/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js')}}"></script>

    <!-- Other Scripts -->
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/dom-factory.js')}}"></script>
    <script src="{{ asset('frontend/vendor/material-design-kit.js')}}"></script>
    <script src="{{ asset('frontend/js/app.js')}}"></script>
    <script src="{{ asset('frontend/js/preloader.js')}}"></script>
    <script src="{{ asset('frontend/js/settings.js')}}"></script>
    <script src="{{ asset('frontend/vendor/moment.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js')}}"></script>
    <script src="{{ asset('frontend/vendor/Chart.min.js')}}"></script>
    <script src="{{ asset('frontend/js/chartjs-rounded-bar.js')}}"></script>
    <script src="{{ asset('frontend/js/chartjs.js')}}"></script>
    <script src="{{ asset('frontend/vendor/list.min.js')}}"></script>
    <script src="{{ asset('frontend/js/list.js')}}"></script>

</body>
</html>
