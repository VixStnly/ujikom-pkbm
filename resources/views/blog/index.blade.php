<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="text-center">
                            <h1 class="h2 measure-lead-max mb-16pt">{{ $blog->title }}</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="/blog">Blog</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">p1</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-section border-bottom-2">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-8">

                                <div class="container card">
                                    <div class="border border-gray rounded mb-3 mt-3 p-1">
                                        <div class="card-body">
                                        @if ($blog->image)
                                            <div class="blog-image mb-3">
                                                <a href="javascript:void(0);"><img alt="{{ $blog->title }}" src="{{ Storage::url('blog/' . $blog->image) }}" class="img-fluid w-100"></a>
                                            </div>
                                        @endif
                                            <h3 class="blog-title">{{ $blog->title }}</h3>
                                            <div class="blog-info clearfix mb-3">
                                                <div class="post-left" style="font-family: 'Poppins', sans-serif;">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item"><i class="fa fa-user text-primary"></i> {{ $blog->user->name ?? 'Pengguna Tidak Diketahui' }}</li>
                                                        <li class="list-inline-item"><i class="far fa-calendar text-primary"></i> {{ $blog->created_at->format('d F Y') }}</li>
                                                        <li class="list-inline-item"><i class="far fa-comments text-primary"></i> 12 Comments</li>
                                                        <li class="list-inline-item"><i class="far fa-eye text-primary"></i> 123 Views</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="blog-content" style="font-family: 'Poppins', sans-serif;">
                                                <p>{!! $blog->description !!}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border border-gray mb-3 mt-3 p-1">
                                        <div class="card-header">
                                            <h4 class="card-title">Share the post</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="social-share d-flex justify-content-around" style="list-style-type: none; padding-left: 0;">
                                                <li class="border p-2"><a href="#" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a></li>
                                                <li class="border p-2"><a href="#" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                                                <li class="border p-2"><a href="#" title="Linkedin"><i class="fab fa-linkedin fa-2x"></i></a></li>
                                                <li class="border p-2"><a href="#" title="Google Plus"><i class="fab fa-google-plus fa-2x"></i></a></li>
                                                <li class="border p-2"><a href="#" title="Youtube"><i class="fab fa-youtube fa-2x"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="page-separator">
                                <div class="page-separator__text">Berita Lainnya</div>
                            </div>

                                <!-- Latest Posts Widget -->
                                <div class="card post-widget" style="border-radius: 0; box-shadow: none;">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Latest Posts</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled latest-posts">
                                            @foreach ($otherBlogs as $otherBlog)
                                            <li class="d-flex mb-3">
                                                <div class="post-thumb me-3">
                                                    <a href="/blog/{{ $otherBlog->id }}">
                                                        <img class="img-fluid rounded" src="{{ Storage::url('blog/' . $otherBlog->image) }}" alt="{{ $otherBlog->title }}" style="width: 90px; height: 60px;">
                                                    </a>
                                                </div>
                                                <div class="post-info">
                                                    <h6 class="mb-1">
                                                        <a href="/blog/{{ $otherBlog->id }}" class="text-decoration-none">{{ $otherBlog->title }}</a>
                                                    </h6>
                                                    <p class="text-muted small mb-0"><i class="far fa-calendar-alt"></i> {{ $otherBlog->created_at->format('d F Y') }}</p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
