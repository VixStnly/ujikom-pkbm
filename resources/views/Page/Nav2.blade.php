            <!-- Header -->
            <div id="header"
                 class="mdk-header js-mdk-header mb-0"
                 data-fixed
                 data-effects="">
                <div class="mdk-header__content">

                    <div class="navbar navbar-expand navbar-dark-pickled-bluewood navbar-shadow"
                         id="default-navbar"
                         data-primary>

                        <!-- Navbar toggler -->
                        <button class="navbar-toggler w-auto mr-16pt d-block d-md-none rounded-0"
                                type="button"
                                data-toggle="sidebar">
                            <span class="material-icons">short_text</span>
                        </button>


                        <!-- Navbar Brand -->
                        <a href="{{ url('/') }}" class="navbar-brand mr-16pt">
                            <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                                <span class="rounded">
                                    <img src="{{ asset('images/logo-academia.png') }}" alt="logo" class="img-fluid" />
                                </span>
                            </span>
                            <span class="d-none d-lg-block">PKBM</span>
                        </a>

                        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-center ml-8pt">
                            <li class="nav-item active">
                                <a href="{{ url('/') }}"
                                   class="nav-link">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Profile</a>
                                <div class="dropdown-menu">
                                    <a href="/Visi&Misi"
                                       class="dropdown-item">Visi &amp; Misi</a>
                                    <a href="/Profile"
                                       class="dropdown-item">Fisologi Logo</a>
                              </div>
                           </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Program</a>
                                <div class="dropdown-menu">
                                    <a href="/paketA-SD"
                                       class="dropdown-item">Paket A</a>
                                    <a href="/paketB-SMP"
                                       class="dropdown-item">Paket B</a>
                                    <a href="/paketC-SMA"
                                       class="dropdown-item">Paket C</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="/gallery"
                                   class="nav-link">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a href="/pendaftaran"
                                   class="nav-link">Pendaftaran</a>
                            </li>
                            <li class="nav-item">
                                <a href="/bloglist"
                                   class="nav-link">Blog</a>
                            </li>

                        </ul>

                        <ul class="nav navbar-nav ml-auto mr-0">
                        <li class="nav-item">
                                <a href="kontak.html"
                                class="nav-link"
                                data-toggle="tooltip"
                                data-title="Kontak Kami"
                                data-placement="bottom"
                                data-boundary="window"><i class="material-icons">contact_mail</i></a>
                            </li>

                            <li class="nav-item">
                                <a href="/login"
                                   class="btn btn-outline-white">Login</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- // END Header -->