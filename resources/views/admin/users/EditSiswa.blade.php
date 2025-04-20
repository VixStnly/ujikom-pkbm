<!-- HTML -->
@include ('content.html')
<head>
    @include('content.style')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout"
        data-push
        data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <!-- Navbar -->
            @include ('layouts.NavSuper')

            <div class="pt-32pt">
                    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Edit Users</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>

                                    <li class="breadcrumb-item active">

                                        Edit

                                    </li>

                                </ol>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- ISI KONTENT -->

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="page-section border-bottom-2">
                <div class="container page__container">
                    <div class="row align-items-start">
                        <div class="col-md-8">
                            <div class="page-separator">
                                <div class="page-separator__text">Edit Data User</div>
                            </div>
                            <div class="card card-body">

                                @if ($user->role_id != 1 && $user->role_id != 2)
                                    <div class="form-group">
                                        <label class="form-label" for="nisn_nip">NISN/NIP</label>
                                        <input id="nisn_nip" name="nisn_nip"
                                            value="{{ old('nisn_nip', $user->nisn_nip) }}"
                                            type="text"
                                            class="form-control @error('nisn_nip') is-invalid @enderror"
                                            placeholder="Masukkan NISN/NIP"
                                            data-mask="(000) 000-0000">
                                        @error('nisn_nip')
                                            <p class="text-red-500 text-sm mt-1">Silakan masukkan NISN/NIP yang valid.</p>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="form-label" for="name">Nama</label>
                                    <input type="text"
                                        value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        placeholder="Masukkan Nama">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">Nama tidak boleh kosong.</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        name="email"
                                        placeholder="Masukkan Email">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">Silakan masukkan alamat email yang valid.</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="role_id">Peran</label>
                                    <select id="role_id"
                                            name="role_id"
                                            data-toggle="select"
                                            data-minimum-results-for-search="-1"
                                            class="form-control @error('role_id') is-invalid @enderror" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <p class="text-red-500 text-sm mt-1">Silakan pilih peran pengguna.</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password">Masukkan Password:</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        placeholder="Masukkan password ..">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">Password harus memiliki minimal 6 karakter.</p>
                                    @enderror
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation"
                                        placeholder="Masukkan konfirmasi password ..">
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-sm mt-1">Konfirmasi password tidak cocok.</p>
                                    @enderror
                                </div>
                                <div class="form-group">
    <label class="form-label" for="guru_id">Guru</label>
    <select id="guru_id" name="guru_id[]"
            data-toggle="select"
            multiple
            class="form-control @error('guru_id') is-invalid @enderror">
        
        {{-- Guru yang sudah dimiliki siswa --}}
        @foreach($gurus->where('selected', true) as $guru)
            <option value="{{ $guru->id }}" selected>{{ $guru->name }}</option>
        @endforeach

        {{-- Guru yang belum dimiliki siswa --}}
        @foreach($gurus->where('selected', false) as $guru)
            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
        @endforeach
    </select>
    @error('guru_id')
        <p class="text-red-500 text-sm mt-1">Silakan pilih guru yang valid.</p>
    @enderror
</div>



                                @if ($user->role_id != 1 && $user->role_id != 2)
                                    <div class="form-group">
                                        <label class="form-label" for="kelas_id">Kelas</label>
                                        <select id="kelas_id" name="kelas_id[]"
                                                data-toggle="select"
                                                multiple
                                                class="form-control @error('kelas_id') is-invalid @enderror">
                                            @foreach($kelas as $k)
                                                <option value="{{ $k->id }}" {{ (isset($user) && in_array($k->id, old('kelas_id', $user->kelas->pluck('id')->toArray()))) ? 'selected' : '' }}>
                                                    {{ $k->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <p class="text-red-500 text-sm mt-1">Silakan pilih kelas yang valid.</p>
                                        @enderror
                                    </div>
                                @endif

                                @if ($user->role_id != 1 && $user->role_id != 2)
                                    <div class="form-group">
    <label class="form-label" for="subject_id">Mata Pelajaran</label>
    <select id="subject_id" name="subject_id[]"
            data-toggle="select"
            multiple
            class="form-control @error('subject_id') is-invalid @enderror">
        
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" 
                    {{ (isset($user) && in_array($subject->id, old('subject_id', $user->subjects->pluck('id')->toArray()))) ? 'selected' : '' }}>
                {{ $subject->name }} - {{ $subject->kelas->name }}
                @if($subject->user)  <!-- Pastikan ada user terkait -->
                    (Diajarkan oleh: {{ $subject->user->name }})
                @else
                    (Guru tidak tersedia)
                @endif
            </option>
        @endforeach
    </select>
    @error('subject_id')
        <p class="text-red-500 text-sm mt-1">Silakan pilih mata pelajaran yang valid.</p>
    @enderror
</div>

                                @endif

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="page-separator">
                                <div class="page-separator__text">Action</div>
                            </div>
                            <div class="card">
                                <div class="card-header text-center">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

                <!-- END KONTENT -->
                @include ('guru.footer')
                </div>
                    <!-- Sidebar -->
                    @include ('layouts.sidebarSuper')
            </div>
            <!-- END KONTENT -->
    @include ('content.js')

    <script>// Enhanced script for edit user page
$(document).ready(function () {
    // Initialize Select2 for all dropdown elements
    $('#guru_id, #kelas_id, #subject_id').select2({
        placeholder: 'Pilih...',
        allowClear: true
    });

    // Save initial subjects for reference
    let allSubjects = [];
    $('#subject_id option').each(function() {
        allSubjects.push({
            id: $(this).val(),
            text: $(this).text(),
            selected: $(this).is(':selected')
        });
    });

    // Function to load classes and subjects based on selected teachers
    function loadDataByTeacher(guruIds) {
        if (guruIds && guruIds.length > 0) {
            $.ajax({
                url: '{{ route('get.kelas.by.guru') }}',
                type: 'GET',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { guru_ids: guruIds },
                dataType: 'json',
                success: function (data) {
                    // Store currently selected values
                    var selectedKelasIds = $('#kelas_id').val();
                    
                    // Update kelas dropdown
                    $('#kelas_id').empty().append('<option value="" disabled>Pilih Kelas</option>');
                    
                    if (data.kelas && data.kelas.length > 0) {
                        $.each(data.kelas, function (index, kelas) {
                            var option = new Option(kelas.name, kelas.id, false, 
                                     selectedKelasIds && selectedKelasIds.includes(kelas.id.toString()));
                            $('#kelas_id').append(option);
                        });
                    }
                    
                    // Trigger change to update subjects
                    $('#kelas_id').trigger('change');
                },
                error: function () {
                    toastr.error('Tidak ada data kelas untuk guru yang dipilih', 'Error');
                }
            });
        } else {
            // If no teachers selected, clear the dependent dropdowns
            $('#kelas_id').empty().append('<option value="" disabled>Pilih Kelas</option>');
            $('#subject_id').empty().append('<option value="" disabled>Pilih Pelajaran</option>');
        }
    }

    // Handle teacher selection change
    $('#guru_id').on('change', function () {
        var guruIds = $(this).val();
        loadDataByTeacher(guruIds);
    });

    // Handle class selection change
    $('#kelas_id').on('change', function () {
        var kelasIds = $(this).val();
        var guruIds = $('#guru_id').val();

        if (kelasIds && kelasIds.length > 0 && guruIds && guruIds.length > 0) {
            $.ajax({
                url: '{{ route('get.subjects.by.kelas') }}',
                type: 'GET',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { kelas_ids: kelasIds, guru_ids: guruIds },
                dataType: 'json',
                success: function (data) {
                    // Store currently selected values
                    var selectedSubjectIds = $('#subject_id').val();
                    
                    // Update subjects dropdown
                    $('#subject_id').empty().append('<option value="" disabled>Pilih Pelajaran</option>');
                    
                    if (data.subjects && data.subjects.length > 0) {
                        $.each(data.subjects, function (index, subject) {
                            var option = new Option(subject.name, subject.id, false, 
                                     selectedSubjectIds && selectedSubjectIds.includes(subject.id.toString()));
                            $('#subject_id').append(option);
                        });
                    } else {
                        toastr.info('Tidak ada pelajaran yang ditemukan untuk kombinasi guru dan kelas ini.', 'Info');
                    }
                    
                    // Refresh Select2
                    $('#subject_id').trigger('change');
                },
                error: function() {
                    toastr.error('Gagal memuat data pelajaran', 'Error');
                }
            });
        } else if (!kelasIds || kelasIds.length === 0) {
            // Clear subjects if no classes selected
            $('#subject_id').empty().append('<option value="" disabled>Pilih Pelajaran</option>');
        }
    });

    // Initialize data loading if teachers are already selected (for edit page)
    var initialGuruIds = $('#guru_id').val();
    if (initialGuruIds && initialGuruIds.length > 0) {
        loadDataByTeacher(initialGuruIds);
    }

    // Role change handling to show/hide fields based on user role
    $('#role_id').on('change', function() {
        var roleId = $(this).val();
        if (roleId == 1 || roleId == 2) { // Admin or Superadmin
            $('.kelas-subject-container').hide();
        } else {
            $('.kelas-subject-container').show();
        }
    }).trigger('change'); // Trigger on page load
});
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

</body>
