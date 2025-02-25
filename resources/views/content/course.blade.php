<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                    <h1 class="h2 mb-8pt">Manage Courses</h1>
                    <div>

                        <span class="chip chip-outline-secondary d-inline-flex align-items-center" data-toggle="tooltip"
                            data-title="Earnings" data-placement="bottom">
                            <i class="material-icons icon--left">trending_up</i> &dollar;12.3k
                        </span>
                        <span class="chip chip-outline-secondary d-inline-flex align-items-center" data-toggle="tooltip"
                            data-title="Sales" data-placement="bottom">
                            <i class="material-icons icon--left">receipt</i> 264
                        </span>

                    </div>
                </div>
                <div class="ml-lg-16pt">
                    <a href="teacher-profile.html" class="btn btn-light">My Profile</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">

                    <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-24pt"
                        style="white-space: nowrap;">
                        <small class="flex text-muted text-headings text-uppercase mr-3 mb-2 mb-sm-0">Displaying 4 out
                            of 10 results</small>
                        <div class="w-auto ml-sm-auto table d-flex align-items-center mb-2 mb-sm-0">
                            <small class="text-muted text-headings text-uppercase mr-3 d-none d-sm-block">Sort
                                by</small>

                            <a href="#" class="sort desc small text-headings text-uppercase">Newest</a>

                            <a href="#" class="sort small text-headings text-uppercase ml-2">Popularity</a>

                        </div>

                    </div>




                    @foreach ($courses as $category => $courseList)
                        <div class="page-separator">
                            <div class="page-separator__text">{{ ucfirst($category) }} Courses</div>
                        </div>

                        <div class="row">
                            @foreach ($courseList as $course)
                                <div class="col-sm-6 col-xl-4">
                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary js-overlay mdk-reveal js-mdk-reveal"
                                        data-toggle="popover" data-trigger="click" data-html="true" data-placement="right"
                                        data-content=" <!-- Popover content -->
                                <div class='popoverContainer'>
                                    <div class='media'>
                                        <div class='media-left mr-12pt'>
                                            <img src='{{ asset('storage/' . $course->image) }}'
                                                 width='40'
                                                 height='40'
                                                 alt='{{ $course->title }}'
                                                 class='rounded'>
                                        </div>
                                        <div class='media-body'>
                                            <div class='card-title mb-0'>{{ $course->title }}</div>
                                            <p class='lh-1'>
                                                <span class='text-50 small'>by</span>
                                                <span class='text-50 small font-weight-bold'>{{ $course->instructor }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <p class='my-16pt text-70'>{{ $course->description }}</p>

                                    <div class='mb-16pt'>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($course->{'feature_' . $i})
                                                <div class='d-flex align-items-center'>
                                                    <span class='material-icons icon-16pt text-50 mr-8pt'>check</span>
                                                    <p class='flex text-50 lh-1 mb-0'><small>{{ $course->{'feature_' . $i} }}</small></p>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>

                                    <div class='row align-items-center'>
                                        <div class='col-auto'>
                                            <div class='d-flex align-items-center mb-4pt'>
                                                <span class='material-icons icon-16pt text-50 mr-4pt'>access_time</span>
                                                <p class='flex text-50 lh-1 mb-0'><small>{{ $course->duration }} per day</small></p>
                                            </div>
                                        </div>
                                        <div class='col text-right'>
                                            <a href='{{ route('admin.courses.edit', $course->id) }}' class='btn btn-primary'>Edit course</a>
                                        </div>
                                    </div>
                                </div>">

                                        <a href="javascript:void(0);" class="js-image">
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}"
                                                class="img-fluid">
                                            <span class="overlay__content align-items-start justify-content-start">
                                                <span class="overlay__action card-body d-flex align-items-center">
                                                    <i class="material-icons mr-4pt">edit</i>
                                                    <span class="card-title text-white">Edit</span>
                                                </span>
                                            </span>
                                        </a>

                                        <div class="mdk-reveal__content">
                                            <div class="card-body">
                                                <div class="card-content">
                                                    <a class="card-title mb-2"
                                                        href="{{ route('admin.courses.edit', $course->id) }}">
                                                        {{ $course->title }}
                                                    </a>
                                                    <p class="text-50 mb-2"><small>{{ $course->duration }} per day</small></p>
                                                </div>
                                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                                    class="ml-4pt material-icons text-20 card-course__icon-favorite">edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination for each category -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $courseList->links() }} <!-- This will render the pagination links -->
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4">
                    <div class="accordion js-accordion accordion--boxed mb-24pt" id="instructor-accordion">
                        <div class="accordion__item">
                            <a href="#" class="accordion__toggle collapsed" data-toggle="collapse"
                                data-target="#instructor-accordion-menu" data-parent="#instructor-accordion">
                                <span class="flex">My Account</span>
                                <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                            </a>
                            <div class="accordion__menu collapse" id="instructor-accordion-menu">
                                <div class="accordion__menu-link active">
                                    <span
                                        class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                                        <i class="material-icons icon-16pt">school</i>
                                    </span>
                                    <a class="flex" href="instructor-dashboard.html">Dashboard</a>
                                </div>
                                <div class="accordion__menu-link">
                                    <span
                                        class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                                        <i class="material-icons icon-16pt">import_contacts</i>
                                    </span>
                                    <a class="flex" href="instructor-courses.html">Manage Courses</a>
                                </div>
                                <div class="accordion__menu-link">
                                    <span
                                        class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                                        <i class="material-icons icon-16pt">help</i>
                                    </span>
                                    <a class="flex" href="instructor-quizzes.html">Manage Quizzes</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">Recommended</div>
                    </div>

                    <div class="mb-8pt d-flex align-items-center">
                        <a href="student-course.html" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                            <img src="../../public/images/paths/angular_routing_200x168.png"
                                alt="Angular Routing In-Depth" class="avatar-img rounded">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="student-course.html">Angular Routing In-Depth</a>
                            <div class="d-flex align-items-center">
                                <div class="rating mr-8pt">

                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                    <span class="rating__item"><span class="material-icons">star_border</span></span>

                                    <span class="rating__item"><span class="material-icons">star_border</span></span>

                                </div>
                                <small class="text-muted">3/5</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-16pt d-flex align-items-center">
                        <a href="student-course.html" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                            <img src="../../public/images/paths/angular_testing_200x168.png" alt="Angular Unit Testing"
                                class="avatar-img rounded">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="student-course.html">Angular Unit Testing</a>
                            <div class="d-flex align-items-center">
                                <div class="rating mr-8pt">

                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                    <span class="rating__item"><span class="material-icons">star_border</span></span>

                                </div>
                                <small class="text-muted">4/5</small>
                            </div>
                        </div>
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0">
                            <a href="student-course.html" class="card-title mb-4pt">Angular Best Practices</a>
                            <p class="lh-1 mb-0">
                                <small class="text-muted mr-8pt">6h 40m</small>
                                <small class="text-muted mr-8pt">13,876 Views</small>
                                <small class="text-muted">13 May 2018</small>
                            </p>
                        </div>
                        <div class="list-group-item px-0">
                            <a href="student-course.html" class="card-title mb-4pt">Unit Testing in Angular</a>
                            <p class="lh-1 mb-0">
                                <small class="text-muted mr-8pt">6h 40m</small>
                                <small class="text-muted mr-8pt">13,876 Views</small>
                                <small class="text-muted">13 May 2018</small>
                            </p>
                        </div>
                        <div class="list-group-item px-0">
                            <a href="student-course.html" class="card-title mb-4pt">Migrating Applications from
                                AngularJS to Angular</a>
                            <p class="lh-1 mb-0">
                                <small class="text-muted mr-8pt">6h 40m</small>
                                <small class="text-muted mr-8pt">13,876 Views</small>
                                <small class="text-muted">13 May 2018</small>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- // END Header Layout Content -->