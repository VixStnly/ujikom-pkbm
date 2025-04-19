@include('content.html')
<head>
    @include('content.style')
    <script src="https://cdn.tailwindcss.com"></script>
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
                            <h2 class="mb-0">Edit Pendaftaran</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.pendaftaran.index') }}">Pendaftaran</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ISI KONTENT -->
            <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="nik">NIK</label>
                                        <input type="text" id="nik" name="nik" value="{{ old('nik', $pendaftaran->nik) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                            <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="agama">Agama</label>
                                        <input type="text" id="agama" name="agama" value="{{ old('agama', $pendaftaran->agama) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email', $pendaftaran->email) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="telepon">Telepon</label>
                                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $pendaftaran->telepon) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <textarea id="alamat" name="alamat" class="form-control" rows="4" required>{{ old('alamat', $pendaftaran->alamat) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="paket">Paket</label>
                                        <select id="paket" name="paket" class="form-control" required>
                                            <option value="A" {{ $pendaftaran->paket == 'A' ? 'selected' : '' }}>Paket A</option>
                                            <option value="B" {{ $pendaftaran->paket == 'B' ? 'selected' : '' }}>Paket B</option>
                                            <option value="C" {{ $pendaftaran->paket == 'C' ? 'selected' : '' }}>Paket C</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
    <label class="form-label" for="status">Status</label>
    <select id="status" name="status" class="form-control" required>
        <option value="Diproses" {{ old('status', $pendaftaran->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="Lunas" {{ old('status', $pendaftaran->status) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
        <option value="Batal" {{ old('status', $pendaftaran->status) == 'Batal' ? 'selected' : '' }}>Batal</option>
    </select>
</div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex">
                                            <a class="flex" href="{{ route('admin.pendaftaran.index') }}"><strong>Kembali</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- JavaScript -->
            <script>
                $(document).ready(function () {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "timeOut": "5000",
                        "positionClass": "toast-top-right"
                    };

                    @if(session('success'))
                        toastr.success("{!! addslashes(session('success')) !!}", "Berhasil!");
                    @endif

                    @if($errors->any())
                        toastr.error("{!! addslashes($errors->first()) !!}", "Terjadi Kesalahan!");
                    @endif
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const gradeSelect = document.getElementById('grade');
                    const nameInput = document.getElementById('name');

                    function updateNameInput() {
                        const grade = gradeSelect.value;
                    }

                    gradeSelect.addEventListener('change', updateNameInput);
                    updateNameInput(); 
                });
            </script>

            @include ('guru.footer')
        </div>

        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>
    
    @include('content.js')
</body>
