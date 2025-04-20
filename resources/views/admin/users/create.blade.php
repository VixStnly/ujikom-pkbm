<!DOCTYPE html>
<html lang="en">

<head>
    @include('content.html')
    @include('content.style')
    <style>
        .toast {
            background-color: #f44336 !important; /* Merah untuk error */
            color: white !important; /* Teks putih */
        }

        .toast-success {
            background-color: #4CAF50 !important; /* Hijau untuk sukses */
        }

        .toast-error {
            background-color: #f44336 !important; /* Pastikan merah untuk error */
        }
    </style>
</head>

<body class="layout-app">

    @include('layouts.preloader')

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('layouts.NavSuper')

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Buat Data User</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Data User</a></li>
                                <li class="breadcrumb-item active">Buat Data User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="page-separator">
                                    <div class="page-separator__text">Pembuatan Data User</div>
                                </div>
                                <div class="card card-body">

                                    <div class="form-group">
                                        <label class="form-label" for="role_id">Role</label>
                                        <select id="role_id" name="role_id" data-toggle="select" data-minimum-results-for-search="-1" class="form-control" required>
                                            <option value="" disabled selected>Pilih Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="name">Nama</label>
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Masukan Nama Lengkap" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" required>
                                    </div>

                                    <div class="form-group" id="nisn_nip_field" style="display: none;">
                                        <label class="form-label" for="nisn_nip">NISN/NIP</label>
                                        <input id="nisn_nip" name="nisn_nip" type="number" class="form-control" placeholder="Masukan NISN/NIP" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    </div>

                                    <div class="form-group" id="kelas_field" style="display: none;">
                                        <label class="form-label" for="kelas">Pilih Kelas</label>
                                        <select id="kelas" name="kelas[]" data-toggle="select" multiple class="form-control" required>
                                            @foreach ($kelas as $kelasItem)
                                                <option value="{{ $kelasItem->id }}">{{ $kelasItem->name }} - {{ $kelasItem->grade}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="pelajaran_field" style="display: none;">
                                        <label class="form-label" for="pelajaran">Pilih Pelajaran</label>
                                        <select id="pelajaran" name="subjects[]" data-toggle="select" multiple class="form-control" required disabled>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">
                                                    {{ $subject->name }} - {{ $subject->kelas->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="no-subject-message" style="display: none; color: red;">
    <p>Tidak ada mata pelajaran tersedia untuk kelas yang dipilih.</p>
</div>

                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Action</div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-primary"></div>
                                    <div class="card-body d-flex mt-3">
                                        <button type="submit" class="btn btn-primary ml-4" id="submitButton" >Buat User</button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ml-3">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>
            <script>
   $(document).ready(function () {
    // Initialize Select2 for Kelas and Pelajaran
    $('#kelas').select2({
        placeholder: 'Pilih Kelas',
        allowClear: true,
        multiple: true // Ensure multiple selections are allowed for Guru
    });

    $('#pelajaran').select2({
        placeholder: 'Pilih Pelajaran',
        allowClear: true
    });

    // Role select dynamic behavior
    $('#role_id').on('change', function () {
        const selectedRole = $(this).val();
        if (selectedRole == 1 || selectedRole == 2) { // Super Admin or Admin
            $('#nisn_nip').removeAttr('required');
            $('#kelas').removeAttr('required').val(null).trigger('change'); // Clear selection
            $('#pelajaran').removeAttr('required').prop('disabled', true);
            $('#nisn_nip_field').hide();
            $('#kelas_field').hide();
            $('#pelajaran_field').hide();
        } else if (selectedRole == 3) { // Guru
            $('#nisn_nip').attr('required', 'required');
            $('#kelas').attr('required', 'required').prop('multiple', true); // Allow multiple selections
            $('#pelajaran').attr('required', 'required').prop('disabled', true);
            $('#nisn_nip_field').show();
            $('#kelas_field').show();
            $('#pelajaran_field').hide();
        } else if (selectedRole == 4) { // Siswa
            $('#nisn_nip').attr('required', 'required');
            $('#kelas').attr('required', 'required').prop('multiple', false); // Only allow single selection
            $('#pelajaran').attr('required', 'required').prop('disabled', true);
            $('#nisn_nip_field').show();
            $('#kelas_field').show();
            $('#pelajaran_field').hide();
        } else {
            $('#nisn_nip').attr('required', 'required');
            $('#kelas').attr('required', 'required').prop('multiple', true); // Allow multiple selections for other roles
            $('#pelajaran').attr('required', 'required').prop('disabled', true);
            $('#nisn_nip_field').show();
            $('#kelas_field').show();
            $('#pelajaran_field').hide();
        }
    });


    // Manual validation for Select2
    $('form').on('submit', function (e) {
        if ($('#role_id').val() != 1 && $('#role_id').val() != 2) {
            if ($('#kelas').val().length == 0 ) {
                alert('Kelas dan Pelajaran wajib dipilih!');
                e.preventDefault(); // Prevent form submission
                return;
            }
        }
    });
});

</script>



            @include('guru.footer')
        </div>
        @include('layouts.sidebarSuper')
    </div>

    @include('content.js')

    <!-- JavaScript Libraries -->
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
