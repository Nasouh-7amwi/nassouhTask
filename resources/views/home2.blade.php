<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Namaa - Task</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

<!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
</head>

<body>
<!-- ======= Header ======= -->
<section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">nassouh.nh7@gmail.com</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>+963 935 112 286</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="button">
                    Logout
                </button>
            </form>
        </div>
    </div>
</section><!-- End Top Bar -->

<header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <h1>Nassou<span>7</span></h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#Blog">Blog</a></li>
                @if(auth()->user()->name == 'admin')
                    <li><a href="#Subscriber">Subscriber</a></li>
                @endif
                <li><a href="#footer">Contact</a></li>
            </ul>
        </nav><!-- .navbar -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header><!-- End Header -->
<!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero">
    <div class="container position-relative">
        <div class="row gy-5 mb-5" data-aos="fade-in">
            <div
                class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                <h2>Welcome to <span>Namaa Solutions - Task</span></h2>
                <div class="col-6 d-flex justify-content-center">
                    @if(!auth()->user()->subscribed)
                        <p class="badge badge-light text-bg-light">
                            <a href="{{'Subscribers/subscribed/'.auth()->id()}}">
                                <button class="button" style="font-weight: bold;font-size: large">
                                    Subscribe here
                                </button>
                            </a>
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 d-flex justify-content-center">
                <img src="{{asset('public/images/logo.png')}}" class="img-fluid" alt=""
                     data-aos="zoom-out" data-aos-delay="100">
            </div>
        </div>
    </div>

    </div>
</section>
<!-- End Hero Section -->

<main id="main">

    <!-- ======= Blogs Section ======= -->
    <section id="Blog" class="portfolio sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Blogs</h2>
                <p>Some blogs that talking about App , Product , Branding and Books</p>
            </div>

            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                 data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                <div class="row mb-5">
                    <div class="col-4 d-flex justify-content-start">
                        <input type="search" placeholder="search by blog title" class="form-control" id="BlogSearch">
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        @if(auth()->user()->subscribed)
                            <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal" class="button">
                                Post New Blog
                            </button>
                        @endif
                    </div>
                    <div class="col-4 ">
                    </div>
                </div>
                <div class="row gy-4 portfolio-container ">
                    @foreach($blogs as $blog)
                        <div class="col-xl-4 col-md-6 portfolio-item filter-app blogs">
                            <div class="portfolio-wrap">
                                <a href="{{$blog->img->path}}" data-gallery="portfolio-gallery-app"
                                   class="glightbox"><img src="{{$blog->img->path}}" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h3><a href="portfolio-details.html" title="More Details" class="text-dark"
                                           style="font-family: Andalus">{{$blog->title}}</a></h3>
                                    <div class="row mt-3">
                                        <div
                                            class="col-6 d-flex justify-content-start align-items-center text-start fw-bold"
                                            style="color: rgb(164,159,159);font-family: Apple">
                                            <i class="bi bi-calendar me-1"></i>{{$blog->publishDate}}
                                        </div>
                                        @if(auth()->user()->name == 'admin' || auth()->id() == $blog->subscriber_id)
                                            <div class="col-6 d-flex justify-content-end">
                                                <a class="deleteBlog"><i class="bi bi-trash me-2"
                                                                         style="font-size: x-large"></i></a>
                                                <input type="text" value="{{$blog->id}}" hidden>
                                                <a data-bs-toggle="modal" data-bs-target="#updateBlog"
                                                   class="updateBlogButton"><i class="bi bi-pencil-square"
                                                                               style="font-size: x-large"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Blogs Item -->
                    @endforeach
                </div><!-- End Blogs Container -->
            </div>
        </div>
    </section><!-- End Blogs Section -->


    <!-- ======= Subscribers Section ======= -->
    @if(auth()->user()->name == 'admin' )
        <section id="Subscriber" class="testimonials">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Subscribers</h2>
                    <p>Group of users that are subscribed in the website</p>
                </div>
                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach($subscribers as $subscriber)
                            <div class="swiper-slide subscribers">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('images/person.png')}}"
                                                 class="testimonial-img flex-shrink-0" alt="">
                                            <div>
                                                <h3>{{$subscriber->name}}</h3>
                                                @if($subscriber->subscribed)
                                                    <h5 class="badge badge-success text-bg-success">Subscribed</h5>
                                                @else
                                                    <h5 class="badge badge-danger text-bg-danger">Not Subscribed</h5>
                                                @endif
                                            </div>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            {{$subscriber->userName}}
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                        <div class="d-flex justify-content-end">
                                            <a class="deleteSubscriber"><i class="bi bi-trash me-2"
                                                                           style="font-size: x-large"></i></a>
                                            <input type="text" value="{{$subscriber->id}}" hidden>
                                            <a data-bs-toggle="modal" data-bs-target="#updateSubscriber"
                                               class="updateSubButton"><i class="bi bi-pencil-square"
                                                                          style="font-size: x-large"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Subscribers item -->
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Subscribers Section -->
    @endif

    <div class="modal fade" id="updateSubscriber" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <section id="contact" class="contact">
                <div class="container" data-aos="fade-up">
                    <div class="row gx-lg-0 gy-4">
                        <div class="col-lg-4">
                            <div class="info-container d-flex flex-column align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form action="{{'Subscribers/update'}}" method="post" role="form"
                                  class="php-email-form updateSubscriberForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="name" class="form-control" id="OldName"
                                               placeholder="Subscriber Name">
                                    </div>
                                    <div class="col-md-6 form-group mt-3 mt-md-0">
                                        <input type="email" class="form-control" name="userName" id="OldUsername"
                                               placeholder="Subscriber Username">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="switch mb-2">
                                        <input type="checkbox" class="blockedSwitch">
                                        <label for="password" class="form-label">Change Password</label>
                                    </label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Subscriber Password" disabled hidden>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="addBlog">Update Subscriber</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="updateBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <section id="contact" class="contact">
                <div class="container" data-aos="fade-up">
                    <div class="row gx-lg-0 gy-4">
                        <div class="col-lg-4">
                            <div class="info-container d-flex flex-column align-items-center justify-content-center">
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <form action="{{'Blogs/update'}}" method="post" role="form"
                                  class="php-email-form updateBlogForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="title" class="form-control" id="OldTitle"
                                               placeholder="Blog Title">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">{{ $message }}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <a href="" data-gallery="portfolio-gallery-app"
                                       class="glightbox"><img height="460" width="460px" src="" class="img-fluid"
                                                              id="OldImage" alt=""></a>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">{{ $message }}</strong>
                                         </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                       <textarea class="form-control" name="content" id="OldConten" rows="3" required></textarea>
                                    @error('conten')
                                    <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">{{ $message }}</strong>
                                         </span>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="addBlog">Update The Blog</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <section id="contact" class="contact">
                <div class="container" data-aos="fade-up">
                    <div class="row gx-lg-0 gy-4">
                        <div class="col-lg-4">
                            <div class="info-container d-flex flex-column align-items-center justify-content-center">
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <form action="{{'Blogs/create'}}" method="post" role="form" class="php-email-form"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="Blog Title"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="file" class="form-control" name="image" id="image" required>
                                </div>
                                <div class="form-group mt-3">
                       <textarea class="form-control" name="conten" id="conten"
                                 placeholder="Blog Content" rows="3"
                                 required></textarea>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="addBlog">Post The Blog</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-info">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span>Nassou7</span>
                </a>
                <div class="social-links d-flex mt-4">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Project Designed</h4>
                <ul>
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">HTML & CSS</a></li>
                    <li><a href="#">JQuery & Ajax</a></li>
                    <li><a href="#">BootStrap</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Some Of My Services</h4>
                <ul>
                    <li><a href="#">Laravel Developer</a></li>
                    <li><a href="#">Backend Developer</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Software Engineering</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Contact Me</h4>
                <p>
                    Damascus<br>
                    Syria <br><br>
                    <strong>Phone:</strong> +963 935 112 286<br>
                    <strong>Email:</strong> nassouh.nh7@gmail.com<br>
                </p>

            </div>

        </div>
    </div>

    <div class="container mt-4">
        <div class="copyright">
            &copy; Copyright <strong><span> NH_7 </span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by Mhd Nassouh
        </div>
    </div>

</footer><!-- End Footer -->
<!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
</script>
<script>
    $(document).ready(function () {
        $("#BlogSearch").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".blogs").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.blockedSwitch').click(function () {
            if ($(this).prop("checked") == true) {
                $('#password').attr('hidden', false);
                $('#password').attr('disabled', false);
            } else if ($(this).prop("checked") == false) {
                $('#password').attr('hidden', true);
                $('#password').attr('disabled', true);
            }
        });

        $('.deleteBlog').click(function () {
            var currentRow = $(this).next();
            var blog_id = currentRow.val();
            $.ajax({
                url: 'Blogs/destroy/' + blog_id,
                type: "",
                success: function (response) {
                    console.log(response)
                    setTimeout(function () {
                        location.reload();
                    }, 200);
                }
            });
        });

        $('.updateBlogButton').click(function () {
            var currentRow = $(this).prev();
            var blog_id = currentRow.val();
            $.ajax({
                url: 'Blogs/show/' + blog_id,
                type: "get",
                success: function (response) {
                    $('#OldTitle').val(response.Blog.title)
                    $('#OldConten').val(response.Blog.content)
                    $('#OldImage').attr('src', response.Blog.img.path)
                    $('.updateBlogForm').attr('action', 'Blogs/update/' + blog_id)
                }
            });
        });

        $('.updateSubButton').click(function () {
            var currentRow = $(this).prev();
            var subscriber_id = currentRow.val();
            $.ajax({
                url: 'Subscribers/show/' + subscriber_id,
                type: "get",
                success: function (response) {
                    $('#OldName').val(response.Subscriber.name)
                    $('#OldUsername').attr('placeholder', response.Subscriber.userName)
                    $('.updateSubscriberForm').attr('action', 'Subscribers/update/' + subscriber_id)
                }
            });
        });

        $('.deleteSubscriber').click(function () {
            var currentRow = $(this).next();
            var subscriber_id = currentRow.val();
            $.ajax({
                url: 'Subscribers/destroy/' + subscriber_id,
                type: "delete",
                success: function (response) {
                    location.reload();
                }
            });
        });
    });
</script>
</body>

</html>
