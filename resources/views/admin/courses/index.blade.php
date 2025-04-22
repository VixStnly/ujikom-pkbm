<!-- HTML -->
@include('content.html')

<head>
    @include('content.style')
    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .card-scroll {
            display: flex;
            /* Menggunakan flexbox untuk penataan */
            overflow-x: auto;
            /* Aktifkan horizontal scrolling */
            padding: 0 15px;
            /* Padding di sisi */
            gap: 1rem;
            /* Jarak antara kartu */
            max-width: 100%;
            /* Pastikan maksimum lebar 100% */
            height: 100%;
            /* Tinggi kontainer agar tidak terpotong */
            min-width: 880px;
            /* Lebar minimum untuk memastikan tidak terlalu kecil */
        }

        .card-scroll .card {
            flex: 0 0 220px;
            /* Tetapkan lebar tetap untuk kartu */
            max-width: 220px;
            /* Batasi lebar maksimum kartu */
            box-sizing: border-box;
            /* Menghitung padding dalam ukuran total */
        }

        .card-scroll img {
            width: 100%;
            /* Gambar memenuhi lebar kartu */
            height: 150px;
            /* Atur tinggi gambar */
            object-fit: cover;
            /* Menjaga proporsi gambar */
        }

        .card-body {
            display: flex;
            /* Atur isi kartu */
            justify-content: space-between;
            /* Jarak antara judul dan tombol */
            align-items: center;
            /* Rata tengah vertikal */
            padding: 0.5rem;
            /* Padding dalam body kartu */
        }

        /* Styling scrollbar */
        .card-scroll::-webkit-scrollbar {
            height: 8px;
            /* Tinggi scrollbar */
        }

        .card-scroll::-webkit-scrollbar-thumb {
            background: rgba(136, 136, 136, 0.5);
            /* Warna scrollbar */
            border-radius: 4px;
            /* Sudut melingkar scrollbar */
        }

        .card-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(136, 136, 136, 0.8);
            /* Warna scrollbar saat hover */
        }

        /* Styling tombol edit */
        .btn-edit {
            width: 80px;
            /* Lebar tombol edit */
            height: 30px;
            /* Tinggi tombol edit */
            padding: 0;
            /* Hilangkan padding */
            font-size: 0.75rem;
            /* Ukuran font tombol */
            border-radius: 0.25rem;
            /* Sudut melingkar */
        }
    </style>
</head>

<body class="layout-app">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            @include('layouts.NavSuper')

            <div class="pt-32pt">
                <div class="container page__container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">Pembelajaran</h2>
                        <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-secondary">Tambah Pelajaran</a>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">Mata Pelajaran Berdasarkan Kelas</div>
                    </div>

                    <div id="accordionExample">
                        @foreach($kelas as $kls)
                        <div class="card">
                            <div class="card-header" id="heading-{{ $kls->id }}" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse-{{ $kls->id }}" aria-expanded="false" aria-controls="collapse-{{ $kls->id }}">
                                <h5 class="mb-0">{{ $kls->name }}</h5>
                            </div>

                            <div id="collapse-{{ $kls->id }}" class="collapse" aria-labelledby="heading-{{ $kls->id }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    @if($kls->subjects->isEmpty())
                                    <div class="alert alert-warning" role="alert">
                                        Tidak ada pelajaran di kelas ini.
                                    </div>
                                    @else
                                    <div class="card-scroll">
                                        @foreach($kls->subjects as $subject)
                                        <div class="card shadow-sm overflow-hidden" style="border-radius: 12px;">
                                            @if($subject->image)
                                            <img src="{{ asset('storage/pelajaran/' . $subject->image) }}" class="card-img-top" alt="{{ $subject->name }}">
                                            @else
                                            <div class="position-relative">
                                                <img src="{{ asset('images/achievements/cover-pembelajaran.png') }}" class="card-img-top" alt="{{ $subject->name }}">
                                                <div class="card-img-overlay d-flex justify-content-center align-items-center pt-4">
                                                    <h1 class="title-shadow text-center">{{ $subject->name }}</h1>
                                                </div>

                                            </div>
                                            @endif

                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <h5 class="card-title mb-0 text-truncate" style="max-width: 70%;">{{ $subject->name }}</h5>
                                                <a href="{{ route('admin.courses.edit', $subject->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include ('guru.footer')
        </div>
        @include('layouts.sidebarSuper')
    </div>

    <style>
        .title-shadow {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            font-weight: bold;
            font-size: 2rem;
            color: #f1f1f1;
            text-shadow:
                -2px -2px 0 #003366,
                2px -2px 0 #003366,
                -2px 2px 0 #003366,
                2px 2px 0 #003366;
            padding: 10px;
            text-align: center;
            border-radius: 12px;
            line-height: 1.1;
            margin: 0;
            margin-top: 20px;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Menghitung jumlah kartu dan menyesuaikan tampilan
            $('.card-scroll').each(function() {
                var cardCount = $(this).children('.card').length;

                // Jika jumlah kartu lebih dari 4, tambahkan kelas untuk scroll
                if (cardCount > 4) {
                    $(this).addClass('scrollable');
                } else {
                    $(this).removeClass('scrollable'); // Hapus kelas scrollable jika kurang dari 4
                }
            });

            // JavaScript untuk toggling accordion
            $('.card-header').on('click', function() {
                const target = $(this).data('target');
                $(target).collapse('toggle'); // Toggle the collapse state on click
            });

            // Initialize dropdowns if needed
            $('.dropdown-toggle').dropdown();
        });
    </script>

    @include('content.js')
</body>