{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

 --}}









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
                                    <h5>Register Account</h5>
                                    <p class="text-muted">Get your free webadmin account now.</p>
                                </div>

                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="name">Username</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter username" value="{{ old('name') }}" required
                                                    autofocus>
                                                <span class="bx bx-user"></span>
                                            </div>
                                            @error('name')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter email" value="{{ old('email') }}" required>
                                                <span class="bx bx-mail-send"></span>
                                            </div>
                                            @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                <span class="bx bx-lock-alt"></span>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Enter password" required>
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
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Confirm password"
                                                    required>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-check py-1">
                                            <input type="checkbox" class="form-check-input"
                                                id="auth-terms-condition-check" required>
                                            <label class="form-check-label" for="auth-terms-condition-check">
                                                I accept <a href="javascript: void(0);" class="text-body">Terms and
                                                    Conditions</a>
                                            </label>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">
                                                Register
                                            </button>
                                        </div>

                                        {{-- <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="font-size-14 mb-3 mt-2 title">Sign in with</h5>
                                            </div>

                                            <ul class="list-inline mt-2">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0)"
                                                        class="social-list-item bg-primary text-white border-primary">
                                                        <i class="bx bxl-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0)"
                                                        class="social-list-item bg-info text-white border-info">
                                                        <i class="bx bxl-linkedin"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0)"
                                                        class="social-list-item bg-danger text-white border-danger">
                                                        <i class="bx bxl-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> --}}

                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Already have an account?
                                                <a href="{{ route('login') }}" class="fw-medium text-primary">Login</a>
                                            </p>
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
                                </script> webadmin. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by Themesdesign
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end container -->
    </div>
</x-guest-layout>
