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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

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


    @include('auth.style')
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
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-card text-center">
                    <h5 class="login-title">LOGIN <span>ELEARNING</span></h5>
                    <p class="text-muted">Access to our dashboard</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-2 text-start">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control form-control-sm" style="transition: box-shadow 0.3s;">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-2 text-start">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control form-control-sm border-end-0" style="transition: box-shadow 0.3s;">
                                <span class="input-group-text bg-white border-start-0" style="cursor: pointer;">
                                    <i class="fa fa-eye" id="togglePassword"></i>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <script>
                            document.getElementById('email').addEventListener('mouseover', function () {
                                this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                            });
                            document.getElementById('email').addEventListener('mouseout', function () {
                                this.style.boxShadow = 'none';
                            });
                            document.getElementById('password').addEventListener('mouseover', function () {
                                this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                            });
                            document.getElementById('password').addEventListener('mouseout', function () {
                                this.style.boxShadow = 'none';
                            });
                            document.getElementById('togglePassword').addEventListener('mouseover', function () {
                                this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                            });
                            document.getElementById('togglePassword').addEventListener('mouseout', function () {
                                this.style.boxShadow = 'none';
                            });
                        </script>

                        <script>
                            document.getElementById('togglePassword').addEventListener('click', function () {
                                var passwordInput = document.getElementById('password');
                                if (passwordInput.type === 'password') {
                                    passwordInput.type = 'text';
                                    this.classList.remove('fa-eye');
                                    this.classList.add('fa-eye-slash');
                                } else {
                                    passwordInput.type = 'password';
                                    this.classList.remove('fa-eye-slash');
                                    this.classList.add('fa-eye');
                                }
                            });
                        </script>

                        <div class="form-group d-flex align-items-center mb-3">
                            <div class="captcha-display me-2">
                                @foreach(str_split($captcha) as $index => $char)
                                <span class="captcha-char color-{{ $index % 5 }}">{{ $char }}</span>
                                @endforeach
                            </div>
                            <input id="captcha" type="text" name="captcha" class="form-control form-control-sm captcha-input" placeholder="Enter CAPTCHA" required>
                            <x-input-error :messages="$errors->get('captcha')" class="mt-1" />
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm w-100" style="font-weight: bold; background-color:rgb(72, 151, 231); border-color: #4da6ff;" onmouseover="this.style.backgroundColor='#4da6ff';" onmouseout="this.style.backgroundColor='rgb(72, 151, 231)';">Login</button>
                    </form>
                    <p class="mt-2">Don't have an account? <a href="#" class="text-primary">Register</a></p>
                </div>
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