<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PKBM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    @include('Page.Styles')
    <style>
        .page-section {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        .media-body p {
                margin: 0;
                /* Atur margin menjadi 0 */
                padding: 0;
                /* Atur padding menjadi 0 */
            }

        .carousel-inner {
            height: 200px;
        }

        .carousel-item img {
            height: 110%;
            width: 100%;
            object-fit: cover;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 100%;
            margin-top: 10%;
            transform: translateY(-100%);
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(0, 0, 0, 0.8);
            width: 5%;
            height: 100px;
            transform: translateY(-50%);
        }

        @media (max-width: 576px) {
            .modal-lg {
                max-width: 90%;
                /* Allow modal to take up more width on small screens */
                margin: 1.75rem auto;
                /* Adjust margin to center it properly */
            }

            .modal-body {
                padding: 15px;
                /* Adjust padding for mobile */
            }
        }

        .hover-zoom:hover {
            transform: scale(1.05);
        }

        .modal {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-backdrop {
            display: none;
        }

        #modalImage {
            max-width: 100%;
            height: auto;
        }

        #call-to-action {
            padding: 120px 0;
            background-image: url('/frontend/images/bg-triwala.jpg');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            text-align: center;
            color: white;
        }

        #call-to-action .cta-content {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 8px;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-green:hover {
            background-color: #218838;
        }
    </style>
</head>

<body class="layout-sticky-subnav layout-default">
    @if(session('success'))
    <script>
        $(document).ready(function() {
            toastr.success("{{ session('success') }}", "Well Done!", {
                closeButton: true,
                progressBar: true,
            });
        });
    </script>
    @endif

    <div class="preloader">
        <div class="sk-chase">
            @for ($i = 0; $i < 6; $i++)
                <div class="sk-chase-dot">
        </div>
        @endfor
    </div>
    </div>

    @include('Page.Navigasi')

    <div class="mdk-header-layout__content page-content">
        <div class="border-bottom-2 py-16pt navbar-light bg-white">
            <div class="container page__container">
                <div class="row align-items-center">
                    @foreach ([
                    ['icon' => 'subscriptions', 'title' => 'Elearning Online', 'subtitle' => 'Perluas pengetahuan Anda dalam berbagai bidang.'],
                    ['icon' => 'verified_user', 'title' => 'Belajar Melalui Daring', 'subtitle' => 'Tingkatkan keterampilan Anda dengan materi terkini dan interaktif.'],
                    ['icon' => 'update', 'title' => 'Akses Belajar Fleksibel', 'subtitle' => 'Nikmati berbagai materi pembelajaran kapan saja dan di mana saja.']
                    ] as $item)
                    <div class="d-flex col-md align-items-center mb-16pt">
                        <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                            <i class="material-icons text-white">{{ $item['icon'] }}</i>
                        </div>
                        <div class="flex">
                            <div class="card-title mb-4pt">{{ $item['title'] }}</div>
                            <p class="card-subtitle text-70">{{ $item['subtitle'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="page-section border-bottom-2">
            <div class="container page__container">
                <div class="row mb-8pt">
                    <div class="col-lg-7">
                        <div class="page-separator">
                            <div class="page-separator__text">Headline Berita</div>
                        </div>
                        <div class="posts-cards mx-auto">
                            <div class="card posts-card mb-3">
                                @if ($blogs->isEmpty())
                                <div class="p-4 text-center">
                                    <p class="text-muted">Tidak ada berita yang tersedia.</p>
                                </div>
                                @else
                                @foreach ($blogs->take(3) as $blog)
                                <div class="mb-6 p-4 row no-gutters justify-content-center" data-toggle="modal" data-target="#blogModal{{ $blog->id }}">
                                    <div class="col-md-4">
                                        @if ($blog->image)
                                        <a href="/blog/{{ $blog->id }}">
                                            <img src="{{ Storage::url('blog/' . $blog->image) }}" class="card-img" alt="{{ $blog->title }}" style="width: 100%; height: 150px; object-fit: cover;">
                                        </a>
                                        @endif
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="{{ url('/blog/' . $blog->id) }}">
                                                <h5 class="card-title" style="overflow: hidden; text-overflow: ellipsis; max-width: 100%;">{{ $blog->title }} <a href="{{ url('/blog/' . $blog->id) }}"></a></h5>
                                            </a>
                                            <p class="card-text" style="margin: 0; padding: 0;">{!! Str::limit($blog->description, 100) !!}</p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Penulis {{ $blog->user->name ?? 'Pengguna Tidak Diketahui' }} pada {{ $blog->created_at->format('d F Y') }}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                <div style="height: 1px; background-color: #ccc; margin: 5px 0;"></div> <!-- Pembatas -->
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-5">
                        <div class="page-separator">
                            <div class="page-separator__text">Pengumuman</div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @if ($announcements->isEmpty())
                                <div class="p-4 text-center">
                                    <p class="text-muted">Tidak ada pengumuman yang tersedia.</p>
                                </div>
                                @else
                                @foreach ($announcements as $announcement)
                                <div class="media mb-0 mt-3">
                                    <div class="media-left mr-10pt">
                                        <a href="#" class="avatar avatar-sm">
                                            <i class="material-icons" style="font-size: 24px;">comment</i>
                                        </a>
                                    </div>
                                    <div class="media-body d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="card-title">{{ $announcement->title }}</a>
                                            <small class="ml-auto text-muted">
                                                @if ($announcement->created_at)
                                                {{ $announcement->created_at->diffForHumans() }}
                                                @else
                                                Tanggal tidak tersedia
                                                @endif
                                            </small>
                                        </div>
                                        <p class="mt-1 mb-0 text-70">{!! $announcement->description !!}</p>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                <div style="height: 1px; background-color: #ccc; margin: 5px 0;"></div> <!-- Pembatas -->
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-section">
            <div class="container page__container">
                <div class="posts-cards mx-auto">
                    <div class="card posts-card mb-3">
                        <div class="mb-6 p-4 row no-gutters justify-content-center">
                            <div class="page-headline text-center">
                                <h2 class="fw-bold">Gallery Foto</h2>
                                <p class="lead text-muted">Hasil Dokumentasi Melalui Triwala</p>
                            </div>
                            <div class="row blog">
                                <div class="col-12">
                                    <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @if(count($galleries) > 0)
                                            @foreach (array_chunk($galleries->toArray(), 4) as $index => $galleryChunk)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div class="row">
                                                    @foreach ($galleryChunk as $gallery)
                                                    <div class="col-6 col-md-3 mb-3">
                                                        <a href="#" data-toggle="modal" data-target="#imageModal" data-image="{{ asset('storage/' . $gallery['image']) }}">
                                                            <img src="{{ asset('storage/' . $gallery['image']) }}" alt="Image" class="d-block w-100 rounded shadow-sm hover-zoom">
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="carousel-item active">
                                                <div class="d-flex justify-content-center">
                                                    <p class="text-center">Tidak ada gambar yang tersedia.</p>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Button to navigate to /gallery -->
                                        <div class="d-flex justify-content-center mt-2">
                                            <a href="/gallery" class="btn btn-outline-dark border border-dark">
                                                Lihat Galeri Lainnya
                                            </a>
                                        </div>


                                        @if(count($galleries) > 4)
                                        <a class="carousel-control-prev" role="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Sebelumnya</span>
                                        </a>
                                        <a class="carousel-control-next" role="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Selanjutnya</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for larger view -->
        <div class="modal fade mt-5" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg mt-5" role="document" style="margin-bottom: 6%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image View</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="" class="img-fluid" alt="Large View">
                    </div>
                </div>
            </div>
        </div>

        <style>
            .modal-body {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #modalImage {
                max-width: 100%;
                max-height: 80vh;
                /* Atur tinggi maksimal agar tetap terlihat baik di mobile */
                object-fit: contain;
                /* Menjaga proporsi gambar */
            }
        </style>

        <section class="section" id="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="cta-content">
                            <h2 class="cta-title text-white">Punya Pertanyaan?</h2>
                            <p>Jika Mempunyai Pertanyaan atau pun Kendala Lain, Bisa Menghubungi Kami</p>
                            <div class="main-button scroll-to-section">
                                <a href="/contact" type="button" class="btn btn-outline-white">Kontak Kami</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('Page.footer')
        @include('Page.NavMenu')

        <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/vendor/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('frontend/vendor/dom-factory.js') }}"></script>
        <script src="{{ asset('frontend/vendor/material-design-kit.js') }}"></script>
        <script src="{{ asset('frontend/js/app.js') }}"></script>
        <script src="{{ asset('frontend/js/preloader.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

        <script>
            // Add an event listener to update the modal image when an image is clicked
            document.addEventListener('DOMContentLoaded', function() {
                const imageModal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');

                document.querySelectorAll('a[data-toggle="modal"]').forEach(item => {
                    item.addEventListener('click', event => {
                        const imageUrl = item.getAttribute('data-image');
                        modalImage.src = imageUrl;
                    });
                });
            });

            $(document).ready(function() {
                // Show custom backdrop and set the modal image
                $('.image-link').on('click', function() {
                    var imageSrc = $(this).data('image');
                    $('#modalImage').attr('src', imageSrc);
                    $('.custom-backdrop').fadeIn(); // Show custom backdrop
                });

                // Manage modal and backdrop visibility
                $('#imageModal').on('show.bs.modal', function() {
                    $('body').addClass('modal-open'); // Disable scroll
                });

                $('#imageModal').on('hidden.bs.modal', function() {
                    $('.custom-backdrop').fadeOut(function() {
                        $(this).hide(); // Completely hide the backdrop after fading out
                    }); // Hide custom backdrop
                    $('body').removeClass('modal-open'); // Restore scroll
                });

                // Close modal and hide backdrop on backdrop click
                $('.custom-backdrop').on('click', function() {
                    $('#imageModal').modal('hide'); // Close modal
                });
            });
        </script>

        <script>
            (function() {
                'use strict';
                var headerNode = document.querySelector('.mdk-header');
                var layoutNode = document.querySelector('.mdk-header-layout');
                var componentNode = layoutNode ? layoutNode : headerNode;
                componentNode.addEventListener('domfactory-component-upgraded', function() {
                    headerNode.mdkHeader.eventTarget.addEventListener('scroll', function() {
                        var progress = headerNode.mdkHeader.getScrollState().progress;
                        var navbarNode = headerNode.querySelector('#default-navbar');
                        navbarNode.classList.toggle('bg-transparent', progress <= 0.2);
                    });
                });
            })();
        </script>
</body>

</html>