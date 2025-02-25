<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Add any required CSS or JavaScript links here -->
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
            @include('layouts.NavSuper')

            <div class="pt-32pt">
                <div
                    class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Edit Pembelajaran</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Pembelajaran</a></li>
                                <li class="breadcrumb-item active">Edit Pembelajaran</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <form action="{{ route('admin.courses.update', $subject->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Informasi Pembelajaran</div>
                                </div>
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Nama Pelajaran</label>
                                        <input name="name" id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $subject->name) }}" placeholder="Masukan Nama"
                                            required>
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <small class="mt-3 text-gray-500">
                                            <a class="text-blue-500 mt-3">Tolong masukan nama mata pelajaran yang
                                                benar</a>
                                        </small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Deskripsi</label>
                                        <textarea name="description" id="description"
                                            class="form-control @error('description') is-invalid @enderror" rows="3"
                                            placeholder="Deskripsi Materi">{{ old('description', $subject->description) }}</textarea>
                                        @error('description')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="image">Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image"
                                                onchange="updateFileName(); validateFileSize()">
                                            <label for="image" class="custom-file-label" id="file-label">Choose
                                                file</label>
                                            @error('image')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="guru">Pilih Guru</label>
                                        <select id="guru" name="user_id" class="form-control" required>
                                            <option value="" disabled>Pilih Guru</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $subject->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label class="form-label" for="kelas">Pilih Kelas</label>
                                        <select id="kelas" name="kelas_id" data-toggle="select"
                                            class="form-control @error('kelas_id') is-invalid @enderror" required>
                                            @foreach ($kelasOptions as $kelas)
                                                <option value="{{ $kelas->id }}" {{ (old('kelas_id', $subject->kelas_id) == $kelas->id) ? 'selected' : '' }}>
                                                    {{ $kelas->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Action</div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Update Pembelajaran</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex"
                                                href="{{ route('admin.courses.index') }}"><strong>Kembali</strong></a>
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

            <script>
                function updateFileName() {
                    const input = document.getElementById('image');
                    const label = document.getElementById('file-label');
                    const fileName = input.files[0] ? input.files[0].name : 'Choose file';
                    label.textContent = fileName;
                }
            </script>
            @include ('guru.footer')

        </div>
        @include('layouts.sidebarSuper')
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
                "positionClass": "toast-top-right"
            };

            @if(session('success'))
                toastr.success("{{ session('success') }}", "Berhasil!");
            @endif

            @if($errors->any())
                toastr.error("{{ $errors->first() }}", "Terjadi Kesalahan!");
            @endif
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const meetingTitle = "{{ $subject->title }}";

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

            const deleteButton = document.getElementById('delete-button');
            if (deleteButton) {
                deleteButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `Anda akan menghapus pertemuan ini?`,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = "{{ route('admin.courses.destroy', $subject->id) }}";
                            form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>


    <!-- Scripts -->
    <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/dom-factory.js') }}"></script>
    <script src="{{ asset('frontend/vendor/material-design-kit.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script src="{{ asset('frontend/js/preloader.js') }}"></script>
    <script src="{{ asset('frontend/js/settings.js') }}"></script>
    <script src="{{ asset('frontend/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/moment-range.js') }}"></script>
    <script src="{{ asset('frontend/vendor/Chart.min.js') }}"></script>
    <script src="{{ asset('frontend/js/chartjs-rounded-bar.js') }}"></script>
    <script src="{{ asset('frontend/js/chartjs.js') }}"></script>
    <script src="{{ asset('frontend/vendor/list.min.js') }}"></script>
    <script src="{{ asset('frontend/js/list.js') }}"></script>

</body>

</html>