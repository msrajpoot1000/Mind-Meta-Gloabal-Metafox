@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('companyinfos')->first(); // ✅ returns only the first row (an object)
@endphp

<!--register for corpoerate section -->

<div class="request-call-back-area text-light default-padding"
    style="background-image: url('{{ asset('assets/img/tax.jpg') }}');">
    <div class="container">
        <div class="row align-center">
            <div class="col-lg-6">
                <h2 class="title">Register for Corporate Tax </h2>
                <a class="btn circle btn-light mt-30 mt-md-15 mt-xs-10 btn-md radius animation" target="_blank"
                    href="{{$company->tax_guide_link}}">See
                    Tax Guide</a>
            </div>
            <div class="col-lg-6 text-end">
                <div class="achivement-counter">
                    <ul>
                        <li>
                            <div class="icon">
                                <i class="flaticon-handshake"></i>
                            </div>
                            <div class="fun-fact">
                                <div class="counter">
                                    <div class="timer" data-to="50" data-speed="2000">50</div>
                                    <div class="operator">+</div>
                                </div>
                                <span class="medium">Business advices given over 2 years</span>
                            </div>
                        </li>
                        {{-- <li>
                            <div class="icon">
                                <i class="flaticon-employee"></i>
                            </div>
                            <div class="fun-fact">
                                <div class="counter">
                                    <div class="timer" data-to="30" data-speed="2000">30</div>
                                    <div class="operator">+</div>
                                </div>
                                <span class="medium">Business Excellence awards achieved</span>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
