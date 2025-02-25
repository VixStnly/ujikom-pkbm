<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Tambahkan link CSS atau JavaScript yang dibutuhkan di sini -->
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
                            <h2 class="mb-0">Edit Pertemuan</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item active">Edit Pertemuan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>



            <form action="{{ route('guru.meeting.update', $meeting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Informasi Pertemuan</div>
                                </div>
                                <div class="card card-body">
                                <div class="form-group mb-24pt">
                                    <label for="subject_id">Mata Pelajaran</label>
                                    <select name="subject_id" id="subject_id" class="form-control" required>
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">
                {{ $subject->name }} -  {{ $subject->kelas->name }}
            </option>                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                    <div class="form-group mb-24pt">
                                        <label for="title">Judul Pertemuan</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Judul Pertemuan" value="{{ old('title', $meeting->title) }}"
                                            required>
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-24pt">
                                        <label for="meeting_time">Waktu Pertemuan</label>
                                        <input type="datetime-local" name="meeting_time" id="meeting_time"
                                            class="form-control"
                                            value="{{ old('meeting_time', date('Y-m-d\TH:i', strtotime($meeting->meeting_time))) }}"
                                            required>
                                        @error('meeting_time')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-32pt">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" class="form-control" rows="5"
                                            placeholder="Deskripsi Pertemuan"
                                            required>{{ old('description', $meeting->description) }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Preview</div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <!-- Preview content if needed -->
                                        <label class="form-label">Preview Informasi Pertemuan</label>
                                        <input type="text" class="form-control" id="disabledTextInput"
                                            placeholder="Preview Konten" value="{{ $meeting->title }}" disabled>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Update Pertemuan</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex"
                                                href="{{ route('guru.meeting.index') }}"><strong>Kembali</strong></a>
                                        </div>
                                        <div class="list-group-item">
                                            <a href="#" id="delete-button" class="text-danger"><strong>Delete
                                                    Pertemuan</strong></a>
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

    <!-- Custom Script for SweetAlert2 -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mendapatkan judul meeting dari elemen input atau variabel
            const meetingTitle = "{{ $meeting->title }}"; // Pastikan ini sesuai dengan nama variable di Blade

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

        document.getElementById('delete-button').addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus pertemnuan ini?`, // Tampilkan judul meeting
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('guru.meeting.destroy', $meeting->id) }}";
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
    <script src="{{ asset('frontend/js/app.js') }}"></script>

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

    <!-- List.js -->
    <script src="{{ asset('frontend/vendor/list.min.js')}}"></script>
    <script src="{{ asset('frontend/js/list.js')}}"></script>

</body>

</html>