<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog Post</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    @include('content.style')
</head>

<body class="layout-sticky-subnav layout-default">

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

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        @include('Page.Nav2')

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content">

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex">
                            <h1 class="h2 measure-lead-max mb-16pt">{{ $blog->title }}</h1>
                        </div>
                        <div class="ml-lg-16pt">
                            <a href="#" class="btn btn-light" disabled>Berita</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-section border-bottom-2">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="d-flex flex-column flex-md-row align-items-md-center mb-16pt">
                                <div class="card shadow-lg rounded">
                                    <div class="card-header bg-dark text-white"></div>

                                    <div class="card-body">
                                        @if ($blog->image)
                                            <img src="{{ Storage::url('blog/' . $blog->image) }}" 
                                                 class="img-fluid rounded mb-3 blog-image" 
                                                 alt="{{ $blog->title }}">
                                        @endif
                                        <p class="card-text text-muted">{!! $blog->description !!}</p>
                                        <p class="text-secondary small">
                                            Dipublikasikan oleh <span class="fw-bold">{{ $blog->user->name ?? 'Pengguna Tidak Diketahui' }}</span> 
                                            pada {{ $blog->created_at->format('d F Y') }}
                                        </p>
                                    </div>

                                    <div class="card-footer text-end bg-light">
                                        <a href="/" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="page-separator">
                                <div class="page-separator__text">Berita Lainnya</div>
                            </div>

                            <ul class="list-group">
                                @foreach ($otherBlogs as $otherBlog)
                                    <li class="list-group-item">
                                        <a href="/blog/{{ $otherBlog->id }}" class="text-decoration-none d-flex align-items-center">
                                            <img src="{{ Storage::url('blog/' . $otherBlog->image) }}" 
                                                 alt="{{ $otherBlog->title }}" 
                                                 class="rounded me-2" 
                                                 style="width: 100px; height: 50px; object-fit: cover;">
                                            <span class="other-blog-title ml-3">{{ $otherBlog->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- // END Header Layout Content -->

        <!-- Footer -->
        @include ('Page.footer')
        <!-- // END Footer -->
    </div>
    <!-- // END Header Layout -->

    <!-- Drawer -->
    @include('Page.NavMenu')
    <!-- // END Drawer -->
    @include('content.js')

</body>

</html>
