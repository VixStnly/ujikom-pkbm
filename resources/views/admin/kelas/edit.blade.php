<!-- HTML -->
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
                            <h2 class="mb-0">Edit Kelas</h2>
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.kelas.index') }}">Kelas</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ISI KONTENT -->
            <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-start">
                            <div class="col-md-8">
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="grade">Grade Kelas</label>
                                        <select id="grade" name="grade" class="form-control" required>
                                            <option value="Paket A" {{ $kelas->grade == 'Paket A' ? 'selected' : '' }}>Paket A</option>
                                            <option value="Paket B" {{ $kelas->grade == 'Paket B' ? 'selected' : '' }}>Paket B</option>
                                            <option value="Paket C" {{ $kelas->grade == 'Paket C' ? 'selected' : '' }}>Paket C</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="name">Nama Kelas</label>
                                        <input type="text" id="name" name="name" value="{{ $kelas->name }}" class="form-control" required>
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
                                            <a class="flex" href="{{ route('admin.kelas.index') }}"><strong>Kembali</strong></a>
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
                document.addEventListener('DOMContentLoaded', function () {
                    const gradeSelect = document.getElementById('grade');
                    const nameInput = document.getElementById('name');

                    function updateNameInput() {
                        const grade = gradeSelect.value;
                        // Logika untuk memodifikasi nama kelas jika perlu
                        // Misalnya, mengatur placeholder atau validasi berdasarkan grade
                    }

                    gradeSelect.addEventListener('change', updateNameInput);
                    updateNameInput(); // Panggil fungsi saat memuat halaman
                });
            </script>

            <!-- END KONTENT -->
            @include ('guru.footer')
        </div>
        <!-- Sidebar -->
        @include('layouts.sidebarSuper')
    </div>
    <!-- END KONTENT -->
    @include('content.js')
</body>
