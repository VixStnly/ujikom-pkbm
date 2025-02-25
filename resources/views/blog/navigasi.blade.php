            <!-- Header -->

            <div id="header"
                 class="mdk-header mdk-header--bg-primary bg-dark js-mdk-header mb-0"
                 data-effects="parallax-background waterfall"
                 data-fixed
                 data-condenses>
                <div class="mdk-header__bg">
                    <div class="mdk-header__bg-front"
                         style="background-image: url({{ asset('frontend/images/bg-triwala.jpg') }});"></div>
                </div>
                <div class="mdk-header__content justify-content-center">

                <div class="navbar navbar-expand navbar-dark-pickled-bluewood bg-transparent will-fade-background"
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
                                    <img src="{{ asset('frontend/images/illustration/student/128/triwala.png') }}" alt="logo" class="img-fluid" />
                                </span>
                            </span>
                            <span class="d-none d-lg-block">PKBM</span>
                        </a>


                        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-center ml-8pt">
                            <li class="nav-item active">
                                <a href="/"
                                   class="nav-link">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Profile</a>
                                <div class="dropdown-menu">
                                    <a href="courses.html"
                                       class="dropdown-item">Visi &amp; Misi</a>
                                    <a href="student-course.html"
                                       class="dropdown-item">Strategi Pengelolaan</a>
                                    <a href="student-lesson.html"
                                       class="dropdown-item">Kalender Pendidikan</a>
                                    <a href="student-take-course.html"
                                       class="dropdown-item"><span class="mr-16pt">Sejarah Singkat</a>
                                    <a href="student-take-lesson.html"
                                       class="dropdown-item">Sarana Prasarana</a>
                                    <a href="student-take-quiz.html"
                                       class="dropdown-item">Struktur Organisasi</a>
                                    <a href="student-quiz-result-details.html"
                                       class="dropdown-item">Kepala PKBM</a>
                                    <a href="student-dashboard.html"
                                       class="dropdown-item">Guru PKBM</a>
                                    <a href="student-my-courses.html"
                                       class="dropdown-item">Tenaga Pendidikan</a>
                                    <a href="student-quiz-results.html"
                                       class="dropdown-item">Narasumber Teknis</a>
                                    <a href="help-center.html"
                                       class="dropdown-item">Komite</a>
                                       <a href="help-center.html"
                                       class="dropdown-item">Prestasi</a>
                                       <a href="help-center.html"
                                       class="dropdown-item">Agenda</a>
                                       <a href="Galleris.blade.php"
                                       class="dropdown-item">Galeri</a>
                                       <a href="help-center.html"
                                       class="dropdown-item">Kontak</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Program</a>
                                <div class="dropdown-menu">
                                    <a href="paths.html"
                                       class="dropdown-item">Keaksaraan</a>
                                    <a href="student-path.html"
                                       class="dropdown-item">Paud</a>
                                    <a href="student-path-assessment.html"
                                       class="dropdown-item">Paket A</a>
                                    <a href="student-path-assessment-result.html"
                                       class="dropdown-item">Paket B</a>
                                    <a href="student-paths.html"
                                       class="dropdown-item">Paket C IPA</a>
                                    <a href="student-paths.html"
                                       class="dropdown-item">Paket C IPS</a>
                                    <a href="student-paths.html"
                                       class="dropdown-item">TBM IPA</a>
                                    <a href="student-paths.html"
                                       class="dropdown-item">Kursus Keterampilan</a>
                                    <a href="student-paths.html"
                                       class="dropdown-item">Ekstrakulikuler</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Kursus</a>
                                <div class="dropdown-menu">
                                    <a href="paths.html"
                                       class="dropdown-item">Jenis - Jenis Kursus</a>
                                    <a href="student-path.html"
                                       class="dropdown-item">Kurikulum Tata Busana</a>
                                    <a href="student-path-assessment.html"
                                       class="dropdown-item">Kurikulum Tata Rias Pengatin</a>
                                    <a href="student-path-assessment-result.html"
                                       class="dropdown-item">Kurikulim Bhs. Inggris</a>
                                    <a href="student-paths.html"
                                       class="dropdown-item">Pembiayaan</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Paket A</a>
                                <div class="dropdown-menu">
                                    <a href="instructor-dashboard.html"
                                       class="dropdown-item">Kurikulum</a>
                                    <a href="instructor-courses.html"
                                       class="dropdown-item">Silabus K-13</a>
                                    <a href="instructor-quizzes.html"
                                       class="dropdown-item">Analisis Kontek</a>
                                    <a href="instructor-earnings.html"
                                       class="dropdown-item">Pemetaan SKK</a>
                                    <a href="instructor-statement.html"
                                       class="dropdown-item">Jadwal Pelajaran</a>
                                    <a href="instructor-edit-course.html"
                                       class="dropdown-item">Modul Paket A</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Guru Paket A</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Sumber Belajar</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">E-Learning</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Paket B</a>
                                <div class="dropdown-menu">
                                    <a href="instructor-dashboard.html"
                                       class="dropdown-item">Kurikulum</a>
                                    <a href="instructor-courses.html"
                                       class="dropdown-item">Silabus K-13</a>
                                    <a href="instructor-quizzes.html"
                                       class="dropdown-item">Analisis Kontek</a>
                                    <a href="instructor-earnings.html"
                                       class="dropdown-item">Pemetaan SKK</a>
                                    <a href="instructor-statement.html"
                                       class="dropdown-item">Jadwal Pelajaran</a>
                                    <a href="instructor-edit-course.html"
                                       class="dropdown-item">Modul Paket B</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Guru Paket B</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Sumber Belajar</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">E-Learning</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   data-caret="false">Paket C</a>
                                <div class="dropdown-menu">
                                    <a href="instructor-dashboard.html"
                                       class="dropdown-item">Kurikulum</a>
                                    <a href="instructor-courses.html"
                                       class="dropdown-item">Mata Pelajaran</a>
                                    <a href="instructor-quizzes.html"
                                       class="dropdown-item">Silabus K-13</a>
                                    <a href="instructor-earnings.html"
                                       class="dropdown-item">Analisis Kontek</a>
                                    <a href="instructor-statement.html"
                                       class="dropdown-item">Pemetaan SKK</a>
                                    <a href="instructor-edit-course.html"
                                       class="dropdown-item">Jadwal Pelajaran</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Modul Paket C</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Tenaga Pendidik</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Pendaftaran</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">Sumber Belajar</a>
                                    <a href="instructor-edit-quiz.html"
                                       class="dropdown-item">E-Learning</a>
                                </div>
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

                    <div class="hero container page__container text-center text-md-left py-112pt">
                    <h1 class="text-white text-shadow">Galeri</h1>
                    <p class="lead measure-hero-lead mx-auto mx-md-0 text-white text-shadow mb-0">Dokumentasi Kumpulan Foto momen berharga yang kami abadikan, dari acara spesial hingga kegiatan sehari-hari.</p>
                    </div>
                </div>
            </div>

            <!-- // END Header -->