@include ('content.html')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('content.style')
</head>

<body class="layout-sticky-subnav layout-default bg-light">
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        @include('Page.Nav2')

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">

            <x-content.banner-landing>
                <h1 class="h2 measure-lead-max mb-16pt text-white">PENDAFTARAN</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Pendaftaran</li>
                    </ol>
                </nav>
            </x-content.banner-landing>

            <div class="page-section border-bottom-2">
                <div class="container page__container">

                    <div class="row">
                        <div class="col-lg-8">

                            <div class="card" style="border: 1px solid #ddd; border-radius: 1;">
                                <div class="card-header text-center" style="background: #e3efff; color: #1d4ed8; padding: 25px; border-radius: 10px 10px 0 0;">
                                    <h4 style="margin: 0; color: darkblue;">Formulir Pendaftaran PKBM</h4>
                                    <p class="text-muted" style="margin: 0; font-weight: normal;">Silakan isi formulir pendaftaran dengan lengkap dan benar</p>
                                </div>
                                <div class="card-body">
                                    <form id="registrationForm">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label" for="namaLengkap">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="namaLengkap" placeholder="Masukkan Nama Lengkap" required>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label" for="nik">NIK</label>
                                                <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label" for="tempatLahir">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempatLahir" placeholder="Masukkan Tempat Lahir" required>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input id="tanggalLahir" placeholder="mm/dd/yyyy" type="text" class="form-control flatpickr-input" data-toggle="flatpickr" value="mm/dd/yyyy">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <div class="custom-controls-stacked">
                                                    <div class="custom-control custom-radio">
                                                        <input id="lakiLaki" name="jenisKelamin" type="radio" class="custom-control-input" required>
                                                        <label for="lakiLaki" class="custom-control-label">Laki-laki</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input id="perempuan" name="jenisKelamin" type="radio" class="custom-control-input">
                                                        <label for="perempuan" class="custom-control-label">Perempuan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label" for="select01">Agama</label>
                                                <select id="select01" data-toggle="select" class="form-control">
                                                    <option selected="">Pilih Agama</option>
                                                    <option>Islam</option>
                                                    <option>Kristen</option>
                                                    <option>Katholik</option>
                                                    <option>Hindu</option>
                                                    <option>Buddha</option>
                                                    <option>Konghucu</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="telepon">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="telepon" placeholder="Masukkan Nomor Telepon" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="alamat">Alamat</label>
                                            <textarea id="alamat" class="form-control" placeholder="Masukkan Alamat Lengkap" required></textarea>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Daftar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <script>
                                document.getElementById("registrationForm").addEventListener("submit", function(event) {
                                    event.preventDefault();

                                    var namaLengkap = document.getElementById("namaLengkap").value;
                                    var nik = document.getElementById("nik").value;
                                    var tempatLahir = document.getElementById("tempatLahir").value;
                                    var tanggalLahir = document.getElementById("tanggalLahir").value;
                                    var jenisKelamin = document.querySelector('input[name="jenisKelamin"]:checked').nextElementSibling.innerText;
                                    var agama = document.getElementById("select01").value;
                                    var email = document.getElementById("email").value;
                                    var telepon = document.getElementById("telepon").value;
                                    var alamat = document.getElementById("alamat").value;

                                    var message = `Halo, saya ingin mendaftar PKBM.\nNama Lengkap: \`${namaLengkap}\`\nNIK: \`${nik}\`\nTempat Lahir: \`${tempatLahir}\`\nTanggal Lahir: \`${tanggalLahir}\`\nJenis Kelamin: \`${jenisKelamin}\`\nAgama: \`${agama}\`\nEmail: \`${email}\`\nNomor Telepon: \`${telepon}\`\nAlamat: \`${alamat}\`\n\nMohon informasi lebih lanjut terkait pendaftaran saya. Terima kasih.`;
                                    var waLink = `https://wa.me/62895613113418?text=${encodeURIComponent(message)}`;
                                    window.location.href = waLink;
                                });
                            </script>
                        </div>

                        <x-content.outher-landing />

                    </div>

                </div>
            </div>
        </div>
        <!-- // END Header Layout Content -->

        <!-- Footer -->
        @include ('Page.footer')
    </div>

    <!-- Drawer -->
    @include('Page.NavMenu')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    @include('content.js')

</body>