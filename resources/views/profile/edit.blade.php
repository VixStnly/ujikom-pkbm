<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico')}}" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" />
    <script src="{{ asset('assets/js/config.js')}}"></script>

    <style>
        /* Custom styles to ensure buttons and inputs are clickable */
        .card-body {
            position: relative;
            /* Ensures proper stacking context */
            z-index: 1;
            /* Bring it above other elements if necessary */
        }

        .btn {
            position: relative;
            /* Ensures the button is clickable */
            z-index: 2;
            /* Higher than other elements */
        }
    </style>
</head>

<body class="layout-sticky-subnav layout-learnly">
    @include('layouts.preloader')
    @include('layouts.NavSiswa')
    @include('content.sidemenu')

    @if(session('success'))
        <div id="alert" class="alert alert-success" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="close" onclick="document.getElementById('alert').style.display='none';">
                &times;
            </button>
        </div>
        <script>
            setTimeout(() => {
                const alertElement = document.getElementById('alert');
                if (alertElement) {
                    alertElement.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif

    <div class="mdk-header-layout js-mdk-header-layout">
        <div class="mdk-header-layout__content page-content">
            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div
                            class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">My Profile</h1>
                            <div>
                                <span class="chip chip-outline-secondary" data-toggle="tooltip"
                                    data-title="Experience IQ" data-placement="bottom">
                                    <i class="material-icons icon--left">class</i>
                                    @if($user->kelas->isEmpty())
                                        <span>Tidak memiliki kelas</span>
                                    @else
                                        @foreach($user->kelas as $kelas)
                                            {{ $kelas->name }} @if(!$loop->last), @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-section">
                <div class="container page__container">
                    <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-4">
                            <h5 class="card-header">Profile Details</h5>
                            <div class="card-body mt-2">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img id="uploadedAvatar"
                                    src="{{ $user->profile_image ? asset('storage/profil/' . $user->profile_image) : asset('https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?t=st=1745006517~exp=1745010117~hmac=ef314be0dba1d776e00b1771f75f14e66087c55d7cf1e1d79d7a444213100f2b&w=900') }}"
                                    alt="{{ $user->name }}'s Profile Picture" class="mb-2"
                                    style="max-width: 100px; max-height: 100px;">

                                    <div class="button-wrapper">
                                        <label for="profile_image" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload {{ __('Foto Profil') }}</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" name="profile_image" id="profile_image"
                                                class="account-file-input" hidden accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" id="resetImage"
                                            class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">{{ __('Nama') }}</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ old('name', $user->name) }}" required autofocus
                                            autocomplete="name" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input class="form-control" type="email" id="email" name="email"
                                            value="{{ old('email', $user->email) }}" placeholder="john.doe@example.com"
                                            required autocomplete="username" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="update_password_current_password"
                                            class="form-label">{{ __('Password Lama') }}</label>
                                        <input type="password" class="form-control"
                                            id="update_password_current_password" name="current_password"
                                            autocomplete="current-password" placeholder="Masukan Password lama" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="update_password_password"
                                            class="form-label">{{ __('Password Baru') }}</label>
                                        <input type="password" class="form-control" id="update_password_password"
                                            name="password" autocomplete="new-password"
                                            placeholder="Masukan Password baru" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="update_password_password_confirmation"
                                            class="form-label">{{ __('Konfirmasi Password') }}</label>
                                        <input type="password" class="form-control"
                                            id="update_password_password_confirmation" name="password_confirmation"
                                            placeholder="Konfirmasi Password" autocomplete="new-password" />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="window.history.back();">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include ('Page.footer')
    </div>

    @include('content.js')
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


    <script>
        document.getElementById('profile_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('uploadedAvatar').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('resetImage').addEventListener('click', function () {
            document.getElementById('profile_image').value = '';
            document.getElementById('uploadedAvatar').src = '{{ $user->profile_image ? asset('storage/profil/' . $user->profile_image) : 'default_avatar.png' }}';
        });

        $(document).ready(function () {

            // JavaScript untuk toggling accordion
            $('.card-header').on('click', function () {
                const target = $(this).data('target');
                $(target).collapse('toggle'); // Toggle the collapse state on click
            });

            // Initialize dropdowns if needed
            $('.dropdown-toggle').dropdown();
        });

    </script>

</body>

</html>