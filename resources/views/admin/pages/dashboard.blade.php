@php
    $companyinfos = DB::table('companyinfos')->first();
    $company = \DB::table('companyinfos')->first();
@endphp

@extends('admin.layouts.app')

@section('title', 'dashboard')



@section('content')


    @php
        $companyinfos = DB::table('companyinfos')->first();
        $company = \DB::table('companyinfos')->first();
    @endphp



    <div class="container" style="display:none">
        <!-- Sparkline charts -->
        <div id="mini-1" data-colors='["--bs-primary"]'></div>
        <div id="mini-2" data-colors='["--bs-success"]'></div>
        <div id="mini-3" data-colors='["--bs-warning"]'></div>
        <div id="mini-4" data-colors='["--bs-danger"]'></div>

        <!-- Bar chart -->
        <div id="overview" data-colors='["--bs-info", "--bs-primary", "--bs-success", "--bs-warning", "--bs-danger"]'>
        </div>

        <!-- Donut chart -->
        <div id="saleing-categories" data-colors='["--bs-primary", "--bs-warning", "--bs-success", "--bs-danger"]'></div>

        <!-- Vector map -->
        <div id="world-map-markers" style="height: 400px;"></div>
    </div>


    <div class="container-fluid">

        <div class="row">
            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="user-profile-img">
                            <img src="assets/admin/images/pattern-bg.jpg"
                                class="profile-img profile-foreground-img rounded-top" style="height: 120px;"
                                alt="">
                            <div class="overlay-content rounded-top">
                                <div>
                                    <div class="user-nav p-3">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-16" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-vertical text-white font-size-20"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('companyinfo') }}">Edit</a>


                                                    @if ($company)
                                                        <form action="{{ route('companyinfo.destroy', $company?->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this company info?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            {{-- <button type="submit" class="dropdown-item text-danger">All
                                                                Remove</button> --}}
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end user-profile-img -->

                        @if ($companyinfos)
                            <div class="p-4 pt-0">


                                <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                    <img src="{{ asset($company->logo ?? 'default/image/company_logo/company_logo.png') }}"
                                        alt="" class="avatar-xl rounded-circle img-thumbnail">

                                    <div class="mt-3">
                                        <h5 class="mb-1">{{ $companyinfos->companyname }}</h5>
                                    </div>

                                </div>

                                <div class="table-responsive mt-3 border-bottom pb-3">
                                    <table
                                        class="table align-middle table-sm table-nowrap table-borderless table-centered mb-0">
                                        <tbody>

                                            <tr>
                                                <th class="fw-bold">Email :</th>
                                                <td class="text-muted">{{ $companyinfos->email }}</td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Phone :</th>
                                                <td class="text-muted">{{ $companyinfos->phone }}</td>
                                            </tr>

                                            @php($phone2 = trim($companyinfos->phone2 ?? ''))
                                            @if (!blank($phone2))
                                                <tr>
                                                    <th class="fw-bold">2nd Phone :</th>
                                                    <td class="text-muted">{{ $companyinfos->phone2 }}</td>
                                                </tr>
                                            @endif

                                            @php($phone3 = trim($companyinfos->phone3 ?? ''))
                                            @if (!blank($phone3))
                                                <tr>
                                                    <th class="fw-bold">3rd Phone :</th>
                                                    <td class="text-muted">{{ $companyinfos->phone3 }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th class="fw-bold">
                                                    Address :</th>
                                                <td class="text-muted">{{ $companyinfos->address }}</td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Facebook :</th>
                                                <td class="text-muted"><a href="{{ $companyinfos->facebook }}"
                                                        target="_blank">Facebook Profile</a></td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Instagram :</th>
                                                <td class="text-muted"><a href="{{ $companyinfos->instagram }}"
                                                        target="_blank">Instagram Profile</a></td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">LinkedIn :</th>
                                                <td class="text-muted"><a href="{{ $companyinfos->linkedin }}"
                                                        target="_blank">LinkedIn Profile</a></td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Pinterest :</th>
                                                <td class="text-muted"><a href="{{ $companyinfos->pinterest }}"
                                                        target="_blank">Pinterest Profile</a></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- container-fluid -->

@endsection

@section('scripts')
    <script src="{{ URL::asset('assets/admin/libs/eva-icons/eva.min.js') }}"></script>

@endsection
