<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pertemuan Baru</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
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
                            <h2 class="mb-0">Tambah Pertemuan Baru</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item active">Tambah Pertemuan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('guru.meeting.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="card card-body">

                                    <div class="form-group">
                                        <label class="form-label">Mata Pelajaran</label>
                                        @if($subjects)
                                            <input type="text" class="form-control"
                                                value="{{ $subjects->name }} - {{ $subjects->kelas->name }}" readonly>
                                            <input type="hidden" name="subjects_id" value="{{ $subjects->id }}">
                                        @else
                                            <p class="text-muted">Tidak ada mata pelajaran yang tersedia.</p>
                                        @endif
                                    </div>

                                    <div class="form-group mb-24pt">
                                        <label for="title">Judul Pertemuan</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Judul Pertemuan" required>
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-24pt">
                                        <label for="meeting_time">Waktu Pertemuan</label>
                                        <input type="datetime-local" name="meeting_time" id="meeting_time"
                                            class="form-control" required>
                                        @error('meeting_time')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-32pt">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" class="form-control" rows="5"
                                            placeholder="Deskripsi Pertemuan" required></textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Simpan Pertemuan</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex cursor-pointer" onclick="history.back()"><strong>Kembali</strong></a>
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

    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/dom-factory.js')}}"></script>
    <script src="{{ asset('frontend/vendor/material-design-kit.js')}}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
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