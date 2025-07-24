@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp


@php
    use App\Models\ComReg;
    $comRegs = ComReg::with('comRegPages')->get();
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


        nav.navbar.validnavs ul li.dropdown ul.dropdown-menu li a {
            padding: 0px
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
                        <a class="dropdown-toggle" data-toggle="dropdown">Company Registration</a>
                        <ul class="dropdown-menu p-2" style="width: 800px;background-color:white;margin-top:-1rem">
                            <div class="row p-2">
                                @foreach ($comRegs as $comReg)
                                    <div class="col-lg-4 mt-2">
                                        <a style="font-size:1rem;color:black;">{{ $comReg->name }}</a>
                                        <ul>
                                            @foreach ($comReg->comRegPages->where('ref_id', $comReg->id) as $page)
                                                <li class="ml-2">
                                                    <a href="{{ route('user.pages.comRegPage', $page->id) }}"
                                                        style="font-size:0.9rem;padding:0px;margin:0px"
                                                        class="d-flex align-items-center">
                                                        <i class="fas fa-chevron-right "
                                                            style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                        <span>{{ $page->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach

                            </div>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Financial Services</a>
                        <ul class="dropdown-menu p-2" style="width: 600px;background-color:white;margin-top:-1rem">
                            <div class="row p-2">
                                <div class="col-lg-4 mt-2">
                                    <a style="font-size:1rem;color:black;">Juridiction</a>
                                    <ul>
                                        <li class="ml-2">
                                            <a href="{{ route('user.pages.dumy') }}"
                                                style="font-size:0.8rem;padding:0px;margin:0px"
                                                class="d-flex align-items-center">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span>Mainland</span> </a>
                                        </li>
                                        <li>
                                            <a href="project.html" style="font-size:0.8rem;">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span> FreeZone</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project.html" style="font-size:0.8rem;">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span> Offshore</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <a style="font-size:1rem;color:black;">Juridiction</a>
                                    <ul>
                                        <li class="ml-2">
                                            <a href="{{ route('user.pages.dumy') }}"
                                                style="font-size:0.8rem;padding:0px;margin:0px"
                                                class="d-flex align-items-center">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span>Mainland</span> </a>
                                        </li>
                                        <li>
                                            <a href="project.html" style="font-size:0.8rem;">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span> FreeZone</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project.html" style="font-size:0.8rem;">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span> Offshore</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <a style="font-size:1rem;color:black;">Juridiction</a>
                                    <ul>
                                        <li class="ml-2">
                                            <a href="{{ route('user.pages.dumy') }}"
                                                style="font-size:0.8rem;padding:0px;margin:0px"
                                                class="d-flex align-items-center">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span>Mainland</span> </a>
                                        </li>
                                        <li>
                                            <a href="project.html" style="font-size:0.8rem;">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span> FreeZone</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project.html" style="font-size:0.8rem;">
                                                <i class="fas fa-chevron-right "
                                                    style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>
                                                <span> Offshore</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </ul>
                    </li>


                    <li><a href="{{ route('user.pages.contact', '') }}">Contact Us</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">Others</a>
                        <ul class="dropdown-menu" style="padding:0.5rem">
                            <li><a href="{{ route('user.pages.aboutus') }}" style="padding:0px"><i
                                        class="fas fa-chevron-right "
                                        style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>About
                                    Us</a></li>
                            <li>
                            <li><a href="{{ route('user.pages.blog') }}" style="padding:0px"><i class="fas fa-chevron-right "
                                        style="font-size:0.6rem;margin-right:0.2rem;margin-left:0.5rem"></i>Blogs</a>
                            </li>
                            <li>
                        </ul>
                    </li>
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
