@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp


@section('style')
    <style>
        .navbar.validnavs.navbar-default .navbar-nav li a {
            color: white;
        }

        .navbar.validnavs.navbar-default.scrolled .navbar-nav li a {
            color: black !important;
        }

        .dropdown-menu1 {
            min-width: 300px !important;
            max-width: 1000px !important;
        }

        li {
            z-index: 1 !important;
        }
    </style>
@endsection


<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar.validnavs.navbar-default');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
    });
</script>



<header class="navbar validnavs navbar-default">
    <!-- Start Navigation -->
    <nav class="navbar mobile-sidenav navbar-sticky navbar-default validnavs navbar-fixed dark  no-background">

        <div class="container d-flex justify-content-between align-items-center">


            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('user.pages.index') }}">
                    <img src="{{ asset($company->logo ?? 'default/image/company_logo/company_logo.png') }}"
                        class="logo" alt="Logo">


                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">

                <div class="collapse-header">
                    <img src="{{ $company->logo ?? 'default/image/company_log/company_log.png' }}" alt="Logo">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp" style="color:white">
                    <li class="dropdown">
                        <a href="{{ route('user.pages.index') }}" class="active" data-toggle="dropdown">Home</a>
                    </li>


                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Company Registration</a>
                        <ul class="dropdown-menu " style="width: 700px">
                            <div class="row">
                                <div class="col-lg-4 mt-2">
                                    <a style="font-size: 1rem">Juridiction</a>
                                    <ul>
                                        <li>
                                            <a href="{{ route('user.pages.dumy') }}" style="padding: 0px;margin:0px">
                                                <i class="fas fa-chevron-right "></i>
                                                Mainland
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project.html">
                                                <i class="fas fa-chevron-right"></i>
                                                <span> FreeZone</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project.html">
                                                <i class="fas fa-chevron-right"></i>
                                                <span> Offshore</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <a href="project.html" style="font-size: 1rem">Project style one</a>
                                    <ul>
                                        <li>
                                            <a href="project.html">
                                                <i class="fas fa-chevron-right"></i>
                                                <span> Projectstyle one</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project.html">
                                                <i class="fas fa-chevron-right"></i>
                                                <span> Projectstyle one</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <a href="project.html" style="font-size: 1rem">Project style one</a>
                                    <ul>
                                        <li>
                                            <a href="project.html">
                                                <i class="fas fa-chevron-right"></i>
                                                <span> Projectstyle one</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project.html">
                                                <i class="fas fa-chevron-right"></i>
                                                <span> Projectstyle one</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </ul>
                    </li>



                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Financial Services</a>
                        <ul class="dropdown-menu">
                            <li><a href="project.html">Project style one</a></li>
                            <li><a href="project-details.html">Project Details</a></li>
                        </ul>
                    </li>
                    {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services</a>
                            <ul class="dropdown-menu">
                                <li><a href="services.html">Services Version One</a></li>
                                <li><a href="services-2.html">Services Version Two</a></li>
                                <li><a href="services-details.html">Services Details</a></li>
                            </ul>
                        </li> --}}
                    {{-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
                        <ul class="dropdown-menu ">
                            <li><a href="blog-standard.html">Blog Standard</a></li>
                            <li><a href="blog-with-sidebar.html">Blog With Sidebar</a></li>
                            <li><a href="blog-2-colum.html">Blog Grid Two Colum</a></li>
                            <li><a href="blog-3-colum.html">Blog Grid Three Colum</a></li>
                            <li><a href="blog-single.html">Blog Single</a></li>
                            <li><a href="blog-single-with-sidebar.html">Blog Single With Sidebar</a></li>
                        </ul>
                    </li> --}}
                    <li class="dropdown"><a href="{{ route('user.pages.aboutus') }}">About Us</a>
                    </li>
                    <li><a href="{{ route('user.pages.contact') }}">Contact Us</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->

            <div class="attr-right">
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="contact headerContact">
                            <div class="call">
                                <div class="icon">
                                    <i class="fas fa-comments-alt-dollar"></i>
                                </div>
                                <div class="info">
                                    <p>Have any Questions?</p>
                                    <h5>
                                        <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                                    </h5>


                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>

        </div>
        <!-- Overlay screen for menu -->
        <div class="overlay-screen"></div>
        <!-- End Overlay screen for menu -->
    </nav>
    <!-- End Navigation -->
</header>
