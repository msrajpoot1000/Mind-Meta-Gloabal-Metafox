<x-guest-layout>
    <div class="authentication-bg min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="mb-4 pb-2">
                            <a href="index.html" class="d-block auth-logo">
                                {{-- <img src="assets/images/logo-dark.png" alt="" height="30"
                                    class="auth-logo-dark me-start"> --}}
                                <img src="assets/images/logo-light.png" alt="" height="30"
                                    class="auth-logo-light me-start">
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5>
                                        @if (empty($email))
                                            Request OTP
                                        @else
                                            Verify OTP
                                        @endif
                                    </h5>
                                    <p class="text-muted">Your Trust is Our Power</p>
                                </div>

                                <div class="p-2 mt-4">
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" id="targetDiv"
                                            role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" onclick="hideDiv()"
                                                data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" id="targetDiv"
                                            role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" onclick="hideDiv()"
                                                data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form id="otp-form" method="POST">
                                        @csrf


                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter email" value="{{ old('email', $email ?? '') }}"
                                                    style="{{ !empty($email) ? 'background-color: rgb(231, 227, 227);' : '' }}"
                                                    @if (!empty($email)) readonly @endif>


                                                <span class="bx bx-mail-send"></span>
                                            </div>
                                            @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @if (session('otp-expired'))
                                            <div class="text-end mt-3">
                                                <button type="submit" class="btn btn-success waves-effect waves-light"
                                                    onclick="document.getElementById('otp-form').action='{{ route('send.otp.store') }}'">
                                                    Resend OTP
                                                </button>
                                            </div>
                                        @endif


                                        @if (!empty($email) )
                                            <div class="mb-3">
                                                <label class="form-label" for="otp">Enter OTP</label>
                                                <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                    <span class="bx bx-key"></span>
                                                    <input type="otp" class="form-control" id="otp"
                                                        name="otp" placeholder="Enter OTP">
                                                </div>
                                                @error('otp')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                    <span class="bx bx-lock-alt"></span>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" placeholder="Enter password">
                                                </div>
                                                @error('password')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password_confirmation">Confirm
                                                    Password</label>
                                                <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                    <span class="bx bx-lock-alt"></span>
                                                    <input type="password" class="form-control"
                                                        id="password_confirmation" name="password_confirmation"
                                                        placeholder="Confirm password">
                                                </div>
                                                @error('password_confirmation')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif



                                        <div class="mt-3">
                                            @if (empty($email))
                                                <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit"
                                                    onclick="document.getElementById('otp-form').action='{{ route('send.otp.store') }}'">
                                                    Send OTP
                                                </button>
                                            @else
                                                <button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit"
                                                    onclick="document.getElementById('otp-form').action='{{ route('verify.otp.store') }}'">
                                                    Verify OTP & Set Password
                                                </button>
                                            @endif

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center p-4">
                            <p>©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> MetaFox Technologies <i class="mdi mdi-heart text-danger"></i>
                                All Right Reserved
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end container -->
    </div>
</x-guest-layout>
