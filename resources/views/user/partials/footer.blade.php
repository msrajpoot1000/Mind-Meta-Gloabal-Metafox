@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp

@section('style')
@endsection

<footer class="bg-dark text-light">
    <div class="footer-shape">
        <div class="item">
            <!--<img src="assets/img/shape/7.png" alt="Shape">-->
        </div>
        <div class="item">
            <img src="assets/img/shape/9.png" alt="Shape">
        </div>
    </div>
    <div class="container">
        <div class="f-items relative pt-70 pb-120 pt-xs-0 pb-xs-50">
            <div class="row">
                <div class="col-lg-6 col-md-6 footer-item pr-50 pr-xs-15">
                    <div class="f-item about">
                        <img class="logo"
                            src="{{ asset($company->logo ?? 'default/image/company_logo/company_logo.png') }}"
                            alt="Logo">
                        @if ($company->companyname)
                            <h2>{{ $company->companyname }}</h2>
                        @endif
                        @if ($company->description)
                            <p>
                                {!! $company->description !!}
                            </p>
                        @endif
                        <div class="social-icons" style="display: flex; gap: 15px;">
                            @if ($company->facebook)
                                <a href="{{ $company->facebook }}" target="_blank" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif

                            {{-- @if ($company->twitter)
                                <a href="{{ $company->twitter }}" target="_blank" aria-label="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif --}}

                            @if ($company->instagram)
                                <a href="{{ $company->instagram }}" target="_blank" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if ($company->linkedin)
                                <a href="{{ $company->linkedin }}" target="_blank" aria-label="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif

                            {{-- @if ($company->youtube)
                                <a href="{{ $company->youtube }}" target="_blank" aria-label="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif --}}
                        </div>


                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-item">
                    <div class="f-item link">
                        <h4 class="widget-title">Quick Links</h4>
                        <ul>


                            <li><a href="{{ route('user.pages.aboutus') }}"><i class="fas fa-chevron-right mr-4"></i>
                                    About Us</a></li>
                            <li><a href="company-registration.html"><i class="fas fa-chevron-right mr-4"></i> Company
                                    Registration</a></li>
                            <li><a href="corporate-tax-services.html"><i class="fas fa-chevron-right mr-4"></i>
                                    Corporate Tax Services</a></li>
                            <li><a href="{{ route('user.pages.privacy-policy') }}"><i
                                        class="fas fa-chevron-right mr-4"></i> Privacy
                                    Policy</a></li>
                            <li><a href="{{ route('user.pages.terms-conditions') }}"><i
                                        class="fas fa-chevron-right mr-4"></i> Terms &
                                    Conditions</a></li>
                            <li><a href="{{ route('user.pages.contact') }}"><i class="fas fa-chevron-right mr-4"></i>
                                    Contact Us</a></li>
                            <li><a href="career.html"><i class="fas fa-chevron-right mr-4"></i> Career</a></li>
                            <li><a href="pricing.html"><i class="fas fa-chevron-right mr-4"></i> Plans & Pricing</a>
                            </li>
                            <li><a href="faq.html"><i class="fas fa-chevron-right mr-4"></i> Help Center</a></li>

                        </ul>

                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-item">
                    <div class="f-item link">
                        <h4 class="widget-title">Useful Links</h4>
                        <ul>
                            <li><a href="services-details.html"><i class="fas fa-chevron-right mr-4"></i> Manage
                                    Investment</a></li>
                            <li><a href="services-details.html"><i class="fas fa-chevron-right mr-4"></i> Business
                                    Planning</a></li>
                            <li><a href="services-details.html"><i class="fas fa-chevron-right mr-4"></i> Financial
                                    Advices</a></li>
                            <li><a href="services-details.html"><i class="fas fa-chevron-right mr-4"></i> Tax
                                    Strategy</a></li>
                            <li><a href="services-details.html"><i class="fas fa-chevron-right mr-4"></i> Insurance
                                    Strategy</a></li>
                            <li><a href="blog-details.html"><i class="fas fa-chevron-right mr-4"></i> Business Setup
                                    Blog</a></li>
                            <li><a href="mainland-company-formation.html"><i class="fas fa-chevron-right mr-4"></i>
                                    Mainland Company Formation</a></li>
                            <li><a href="freezone-company-formation.html"><i class="fas fa-chevron-right mr-4"></i>
                                    Freezone Company Formation</a></li>
                            <li><a href="start-business-dubai.html"><i class="fas fa-chevron-right mr-4"></i> How to
                                    Start a Business in Dubai</a></li>
                            <li><a href="corporate-pro-services.html"><i class="fas fa-chevron-right mr-4"></i>
                                    Corporate PRO Services</a></li>
                            <li><a href="coworking-spaces.html"><i class="fas fa-chevron-right mr-4"></i> Coworking
                                    Spaces</a></li>

                        </ul>

                    </div>
                </div>

                <div class="col-lg-2 col-md-6 footer-item">
                    <div class="f-item link">
                        <h4 class="widget-title">Get in Touch</h4>
                        <ul class="contact-info">
                            @if ($company->address)
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $company->address }}
                                </li>
                            @endif
                            @if ($company->email)
                                <li>

                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>

                                </li>
                            @endif
                            @if ($company->phone)
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a>
                                </li>
                            @endif
                            @if ($company->phone2)
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <a href="tel:{{ $company->phone2 }}">{{ $company->phone2 }}</a>
                                </li>
                            @endif
                            @if ($company->phone3)
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <a href="tel:{{ $company->phone3 }}">{{ $company->phone3 }}</a>
                                </li>
                            @endif

                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy; Copyright 2023. All Rights Reserved by <a href="#">Mind Meta Globals</a></p>
                </div>
                <div class="col-lg-6 text-end">
                    <ul>
                        <li>
                            <a href="{{ route('user.pages.terms-conditions') }}">Terms</a>
                        </li>
                        <li>
                            <a href="{{ route('user.pages.privacy-policy') }}">Privacy</a>
                        </li>
                        <li>
                            <a href="{{ route('user.pages.cookie-policy') }}">Cookie</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->

</footer>
