<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="{{ asset('frontend/vendor/spinkit.css') }}"
              rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="{{ asset('frontend/vendor/perfect-scrollbar.css') }}"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="{{ asset('frontend/css/material-icons.css') }}"
              rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css"
              href="{{ asset('frontend/css/fontawesome.css') }}"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="{{ asset('frontend/css/preloader.css') }}"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="{{ asset('frontend/css/app.css') }}"
              rel="stylesheet">
<style>
  .captcha-display {
    background-image: url('/path/to/paper-texture.jpg'); /* Replace with your texture image */
    background-size: cover;
    background-repeat: no-repeat;
    padding: 10px 15px;
    display: inline-flex;
    font-family: 'Courier New', Courier, monospace;
    font-size: 20px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 4px; /* Additional letter spacing */
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
}

.captcha-char {
    display: inline-block;
    transform: rotate(calc(-5deg + 10deg * var(--rotation)));
    margin-right: 8px; /* Adjust the spacing between each character */
}

.color-0 { color: #FF5733; }
.color-1 { color: #33FF57; }
.color-2 { color: #3357FF; }
.color-3 { color: #FF33A6; }
.color-4 { color: #FFBD33; }

.captcha-input {
    flex: 1; /* Allows input to scale as needed */
    max-width: 150px;
}

</style>
    </head>

    <body class="layout-sticky-subnav layout-default ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">
            @include ('Page.Nav2')
            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content page-content ">

            <div class="pt-32pt pt-sm-64pt pb-32pt">
                <div class="container page__container">
                    <!-- Tambahkan status session (untuk menampilkan pesan berhasil/gagal) -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="col-md-5 p-0 mx-auto">
    @csrf

    <!-- Email Address -->
    <div class="form-group">
        <label class="form-label" for="email">Email:</label>
        <input id="email" type="email" name="email" class="form-control" placeholder="Your email address ..." value="{{ old('email') }}" required autofocus autocomplete="username">
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="form-group">
        <label class="form-label" for="password">Password:</label>
        <input id="password" type="password" name="password" class="form-control" placeholder="Your password..." required autocomplete="current-password">
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="form-group d-flex align-items-center">
    <div class="captcha-display mr-3">
        @foreach(str_split($captcha) as $index => $char)
            <span class="captcha-char color-{{ $index % 5 }}">{{ $char }}</span>
        @endforeach
    </div>
    <input id="captcha" type="text" name="captcha" class="form-control captcha-input " placeholder="Enter CAPTCHA" required>
    <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
</div>





    <!-- Login Button -->
    <div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="/" class="btn btn-secondary">Back</a>
    </div>
</form>


                </div>
            </div>
            </div>

            <!-- // END Header Layout Content -->

             @include ('Page.footer')

        </div>
        <!-- // END Header Layout -->

        <!-- Drawer -->

        <div class="mdk-drawer js-mdk-drawer"
             id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left"
                     data-perfect-scrollbar>

                    <!-- Sidebar Content -->

                    <div class="d-flex align-items-center navbar-height">
                        <form action="index.html"
                              class="search-form search-form--black mx-16pt pr-0 pl-16pt">
                            <input type="text"
                                   class="form-control pl-0"
                                   placeholder="Search">
                            <button class="btn"
                                    type="submit"><i class="material-icons">search</i></button>
                        </form>
                    </div>

                    <a href="index.html"
                       class="sidebar-brand ">
                        <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                        <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                            <span class="avatar-title rounded bg-success"><img src="{{ asset('frontend/images/illustration/student/128/triwala.png') }}"
                                     class="img-fluid"
                                     alt="logo" /></span>

                        </span>

                        <span>Triwala</span>
                    </a>

                    <div class="sidebar-heading">Menu</div>
                    <ul class="sidebar-menu">

                        <li class="sidebar-menu-item active">
                            <a class="sidebar-menu-button"
                               href="index.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                                <span class="sidebar-menu-text">Home</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#account_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                                Profile
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="account_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="pricing.html">
                                        <span class="sidebar-menu-text">Visi &amp; Misi</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Strategi Pengelolaan</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup.html">
                                        <span class="sidebar-menu-text">Kalender Pendidikan</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup-payment.html">
                                        <span class="sidebar-menu-text">Sejarah Singkat</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Sarana Prasarana</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="change-password.html">
                                        <span class="sidebar-menu-text">Struktur Organisasi</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account.html">
                                        <span class="sidebar-menu-text">Kepala PKBM</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account-profile.html">
                                        <span class="sidebar-menu-text">Guru PKBM</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account-notifications.html">
                                        <span class="sidebar-menu-text">Tenaga Kependidikan</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account-password.html">
                                        <span class="sidebar-menu-text">NaraSumber Teknis</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing.html">
                                        <span class="sidebar-menu-text">Komite</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing-upgrade.html">
                                        <span class="sidebar-menu-text">Prestasi</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing-payment.html">
                                        <span class="sidebar-menu-text">Agenda</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing-history.html">
                                        <span class="sidebar-menu-text">Galeri</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing-invoice.html">
                                        <span class="sidebar-menu-text">Kontak</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#program_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">tune</span>
                                Program
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="program_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="pricing.html">
                                        <span class="sidebar-menu-text">Keaksaran</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Paud</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup.html">
                                        <span class="sidebar-menu-text">Paket A</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup-payment.html">
                                        <span class="sidebar-menu-text">Paket B</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Paket C IPA</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="change-password.html">
                                        <span class="sidebar-menu-text">Paket C IPS</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account.html">
                                        <span class="sidebar-menu-text">TBM IPA</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account-profile.html">
                                        <span class="sidebar-menu-text">Kursus Keterampilan</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account-notifications.html">
                                        <span class="sidebar-menu-text">Ekstrakulikuler</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="edit-account-password.html">
                                        <span class="sidebar-menu-text">NaraSumber Teknis</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing.html">
                                        <span class="sidebar-menu-text">Komite</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing-upgrade.html">
                                        <span class="sidebar-menu-text">Prestasi</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="billing-payment.html">
                                        <span class="sidebar-menu-text">Agenda</span>
                                    </a>
                                </li>
                            </ul>
                            
                            <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#kursus_menu">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                                kursus
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="kursus_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="pricing.html">
                                        <span class="sidebar-menu-text">Jenis - Jenis Kursus</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Kurikulum Tata Busana</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup.html">
                                        <span class="sidebar-menu-text">Kurikulum Tata Rias Pengatin</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup-payment.html">
                                        <span class="sidebar-menu-text">Kurikulu Bhs.Inggris</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Pembiayaan</span>
                                    </a>
                                </li>
                            </ul>
                    </ul>

                    <div class="sidebar-heading">Paket Sekolah Dasar</div>
                    <ul class="sidebar-menu">

                    <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#A_menu">
                                Paket A
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="A_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="pricing.html">
                                        <span class="sidebar-menu-text">Kurikulum</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Silabus K-13</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup.html">
                                        <span class="sidebar-menu-text">Analisis Kontek</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup-payment.html">
                                        <span class="sidebar-menu-text">Pemetaan SKK</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Jadwal Pembelajaran</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Modul Paket A</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Modul Paket B</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Sumber Belajar</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">E-Learning</span>
                                    </a>
                                </li>
                            </ul>

                            <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#B_menu">
                                Paket B
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="B_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="pricing.html">
                                        <span class="sidebar-menu-text">Kurikulum</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Silabus K-13</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Pemetaan SKK</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup.html">
                                        <span class="sidebar-menu-text">Jadwal Pembelajaran</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup-payment.html">
                                        <span class="sidebar-menu-text">Modul Paket B</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Guru Paket B</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Sumber Belajar</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">E-Learning</span>
                                    </a>
                                </li>
                            </ul>

                            <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               data-toggle="collapse"
                               href="#C_menu">
                                Paket C
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent"
                                id="C_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="pricing.html">
                                        <span class="sidebar-menu-text">Kurikulum</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Mata Pelajaran</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup.html">
                                        <span class="sidebar-menu-text">Silabus K-13</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="signup-payment.html">
                                        <span class="sidebar-menu-text">Analisis Kontek</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="reset-password.html">
                                        <span class="sidebar-menu-text">Pemetaan SKK</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Jadwal Pembelajaran</span>
                                    </a>
                                </li>
                                
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Modul Paket C</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Tenaga Pendidikan</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Pendaftaran</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button"
                                       href="login.html">
                                        <span class="sidebar-menu-text">Sumber Belajar</span>
                                    </a>
                                </li>
                            </ul>

                            <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button"
                               href="courses.html">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">spa</span>
                                <span class="sidebar-menu-text">Kabar</span>
                            </a>
                        </li>
                    </ul>

                    <!-- // END Sidebar Content -->

                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="{{ asset('frontend/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/vendor/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar -->
        <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js') }}"></script>

        <!-- DOM Factory -->
        <script src="{{ asset('frontend/vendor/dom-factory.js') }}"></script>

        <!-- MDK -->
        <script src="{{ asset('frontend/vendor/material-design-kit.js') }}"></script>

        <!-- App JS -->
        <script src="{{ asset('frontend/js/app.js') }}"></script>

        <!-- Preloader -->
        <script src="{{ asset('frontend/js/preloader.js') }}"></script>

    </body>

</html>