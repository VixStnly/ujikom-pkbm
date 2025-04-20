@include('content.html')
<head>
    @include('content.style')
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Toastr CSS for error notifications -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <!-- Navbar -->
            @include('layouts.NavSuper')

            <div class="pt-32pt">
                <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                    <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                        <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                            <h2 class="mb-0">Tambah Siswa</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Siswa</a></li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <form action="{{ route('admin.users.storeSiswa') }}" method="POST">
                @csrf

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="card card-body">
                                    <!-- Name -->
                                    <div class="form-group">
                                        <label class="form-label" for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Siswa" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
                                    </div>

                                    <!-- NISN -->
                                    <div class="form-group">
                                        <label class="form-label" for="nisn_nip">NISN / NIP</label>
                                        <input type="text" name="nisn_nip" id="nisn_nip" class="form-control" placeholder="Masukkan NISN atau NIP" required>
                                    </div>

                                    <!-- Select Teacher -->
                                    <div class="form-group">
                                        <label class="form-label" for="guru_id">Pilih Guru</label>
                                        <select name="guru_id[]" id="guru_id" class="form-control" multiple="multiple" required>
                                            <option value="" disabled>Pilih Nama Guru</option>
                                            @foreach($gurus as $guru)
                                                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Select Class -->
                                    <div class="form-group">
                                        <label class="form-label" for="kelas_id">Pilih Kelas</label>
                                        <select name="kelas_id" id="kelas_id" class="form-control" required>
                                            <option value="" disabled>Pilih Kelas</option>
                                        </select>
                                    </div>

                                    <!-- Select Subject -->
                                    <div class="form-group">
                                        <label class="form-label" for="subject_id">Pilih Pelajaran</label>
                                        <select name="subject_id[]" id="subject_id" class="form-control" multiple="multiple" required>
                                            <option value="" disabled>Pilih Pelajaran</option>
                                        </select>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex" href="{{ route('admin.users.index') }}"><strong>Kembali</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Content Section -->

            @include('guru.footer')
        </div>

        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>

    @include('content.js')

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
   $(document).ready(function () {
    // Inisialisasi Select2 untuk dropdown guru, kelas, dan pelajaran
    $('#guru_id').select2({
        placeholder: 'Pilih Nama Guru',
        allowClear: true
    });

    $('#kelas_id').select2({
        placeholder: 'Pilih Kelas',
        allowClear: true,
        multiple: true  // Memungkinkan pemilihan banyak kelas
    });

    $('#subject_id').select2({
        placeholder: 'Pilih Pelajaran',
        allowClear: true
    });

    // Ketika guru_id berubah
    $('#guru_id').on('change', function () {
        var guruIds = $(this).val();  // Ambil semua ID guru yang dipilih
        var kelasIds = $('#kelas_id').val(); // Ambil kelas_ids yang dipilih

        if (guruIds && guruIds.length > 0) {
            $.ajax({
                url: '{{ route('get.kelas.by.guru') }}',
                type: 'GET',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { guru_ids: guruIds },  // Kirim array guru_ids
                dataType: 'json',
                success: function (data) {
                    $('#kelas_id').empty().append('<option value="" disabled>Pilih Kelas</option>');
                    $('#subject_id').empty().append('<option value="" disabled>Pilih Pelajaran</option>');

                    // Mengisi dropdown kelas
                    if (data.kelas && data.kelas.length > 0) {
                        $.each(data.kelas, function (index, kelas) {
                            $('#kelas_id').append('<option value="' + kelas.id + '">' + kelas.name + '</option>');
                        });
                    }
                },
                error: function () {
                    toastr.error('Tidak ada data kelas untuk guru yang dipilih', 'Error');
                }
            });
        }
    });

    // Ketika kelas_id berubah
    $('#kelas_id').on('change', function () {
        var kelasIds = $(this).val();  // Ambil array kelas_ids yang dipilih
        var guruIds = $('#guru_id').val(); // Ambil guru_ids yang dipilih

        if (kelasIds && guruIds && guruIds.length > 0) {
            $.ajax({
                url: '{{ route('get.subjects.by.kelas') }}',
                type: 'GET',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { kelas_ids: kelasIds, guru_ids: guruIds },  // Kirim kelas_ids dan guru_ids
                dataType: 'json',
                success: function (data) {
                    $('#subject_id').empty().append('<option value="" disabled>Pilih Pelajaran</option>');

                    if (data.subjects && data.subjects.length > 0) {
                        $.each(data.subjects, function (index, subject) {
                            $('#subject_id').append('<option value="' + subject.id + '">' + subject.name + '</option>');
                        });
                    } else {
                        toastr.error('Tidak ada pelajaran yang ditemukan untuk kelas ini.', 'Error');
                    }
                }
            });
        }
    });
});

</script>

</body>
