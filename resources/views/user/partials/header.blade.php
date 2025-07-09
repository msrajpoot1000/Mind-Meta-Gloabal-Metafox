<style>
    .navbar.validnavs.navbar-default .navbar-nav li a {
        color: white;
    }

    .navbar.validnavs.navbar-default.scrolled .navbar-nav li a {
        color: black !important;
    }
</style>

<script>
    window.addEventListener('scroll', function () {
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
                    <a class="navbar-brand" href="index.html">
                        <img src="assets/img/logo.png" class="logo" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">

                    <div class="collapse-header">
                        <img src="assets/img/logo.png" alt="Logo">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    
                    <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp" style="color:white">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Home</a>
                            <ul class="dropdown-menu">
                                <li><a href="index.html">Consulting Business</a></li>
                                <li><li><a href="index-2.html">Corporate Business</a></li>
                                <li><li><a href="marketing-agency.html">Marketing Agency</a></li>
                                <li><li><a href="insurance.html">Insurance</a></li>
                                <li><li><a href="solar-energy.html">Solar Energy</a></li>
                                <li><li><a href="software-landing.html">Software Landing</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Pages</a>
                            <ul class="dropdown-menu">
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="team.html">Team</a></li>
                                <li><a href="team-details.html">Team Details</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                                <li><a href="404.html">Error Page</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="project.html" class="dropdown-toggle" data-toggle="dropdown" >Projects</a>
                            <ul class="dropdown-menu">
                                <li><a href="project.html">Project style one</a></li>
                                <li><a href="project-details.html">Project Details</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Services</a>
                            <ul class="dropdown-menu">
                                <li><a href="services.html">Services Version One</a></li>
                                <li><a href="services-2.html">Services Version Two</a></li>
                                <li><a href="services-details.html">Services Details</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Blog</a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-standard.html">Blog Standard</a></li>
                                <li><a href="blog-with-sidebar.html">Blog With Sidebar</a></li>
                                <li><a href="blog-2-colum.html">Blog Grid Two Colum</a></li>
                                <li><a href="blog-3-colum.html">Blog Grid Three Colum</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                                <li><a href="blog-single-with-sidebar.html">Blog Single With Sidebar</a></li>
                            </ul>
                        </li>
                        <li><a href="contact-us.html">contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->

                <div class="attr-right">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            <li class="contact">
                                <div class="call">
                                    <div class="icon">
                                        <i class="fas fa-comments-alt-dollar"></i>
                                    </div>
                                    <div class="info">
                                        <p>Have any Questions?</p>
                                        <h5><a href="mailto:info@crysta.com">info@bestup.com</a></h5>
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