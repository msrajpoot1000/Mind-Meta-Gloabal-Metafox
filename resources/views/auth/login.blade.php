 <?php
 use Illuminate\Support\Facades\DB;
 $company = DB::table('companyinfos')->first();
 ?>


 {{-- laravel breeze login form  --}}
 {{-- <x-guest-layout>
    
    <div style="display: flex; align-items: center; justify-content: center;">
      <img src="{{ asset('assets/images/logo/' . $company->logo) }}" alt="logo image" width="150px" class="text-center">
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
       @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


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
                                     class="auth-logo-dark me-start" /> --}}
                                 <img src="assets/images/logo-light.png" alt="" height="30"
                                     class="auth-logo-light me-start" />
                             </a>
                         </div>

                         <div class="card">

                             <div class="card-body p-4">
                                 @if (session('success'))
                                     <div class="alert alert-success alert-dismissible fade show" id="targetDiv"
                                         role="alert">
                                         {{ session('success') }}
                                         <button type="button" class="btn-close" onclick="hideDiv()"
                                             data-bs-dismiss="alert" aria-label="Close"></button>
                                     </div>
                                 @endif
                                 @if (session('error'))
                                     <div class="alert alert-danger">
                                         {{ session('error') }}
                                     </div>
                                 @endif

                                 <div class="text-center mt-2">
                                     <h5>Welcome Back !</h5>
                                     <p class="text-muted">Sign in to continue to webadmin.</p>
                                 </div>

                                 <div class="p-2 mt-4">
                                     <form method="POST" action="{{ route('login') }}">
                                         @csrf

                                         <div class="mb-3">
                                             <label class="form-label" for="email">Email</label>
                                             <div class="position-relative input-custom-icon">
                                                 <input type="email" name="email" id="email"
                                                     class="form-control" placeholder="Enter email"
                                                     value="{{ old('email') }}" required autofocus>
                                                 <span class="bx bx-user"></span>
                                             </div>
                                             @error('email')
                                                 <div class="text-danger mt-1">{{ $message }}</div>
                                             @enderror
                                         </div>


                                         <div class="mb-3">
                                             <div class="float-end">
                                                 @if (Route::has('send.otp.index'))
                                                     <a href="{{ route('send.otp.index') }}"
                                                         class="text-muted text-decoration-underline">Forgot
                                                         password?</a>
                                                 @endif
                                             </div>
                                        
                                             <label class="form-label" for="password">Password</label>
                                             <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                 <span class="bx bx-lock-alt"></span>
                                                 <input type="password" name="password" id="password"
                                                     class="form-control" placeholder="Enter password"
                                                     autocomplete="current-password" required>

                                                 <button type="button"
                                                     class="btn btn-link position-absolute h-100 end-0 top-0"
                                                     id="password-addon">
                                                     <i class="mdi mdi-eye-outline font-size-18 text-muted" id="toggle-password-icon"></i>
                                                 </button>
                                             </div>
                                             @error('password')
                                                 <div class="text-danger mt-1">{{ $message }}</div>
                                             @enderror
                                         </div>

                                         <div class="form-check py-1">
                                             <input type="checkbox" name="remember" class="form-check-input"
                                                 id="auth-remember-check" {{ old('remember') ? 'checked' : '' }}>
                                             <label class="form-check-label" for="auth-remember-check">Remember
                                                 me</label>
                                         </div>

                                         <div class="mt-3">
                                             <button class="btn btn-primary w-100 waves-effect waves-light"
                                                 type="submit">
                                                 Log In
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

                                         {{-- <div class="mt-4 text-center">
                                             <p class="mb-0">
                                                 Don't have an account ?
                                                 <a href="auth-register.html" class="fw-medium text-primary">
                                                     Signup now
                                                 </a>
                                             </p>
                                         </div> --}}
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- end col -->
                 </div>
                 <!-- end row -->

                 <div class="row">
                     <div class="col-lg-12">
                         <div class="text-center p-4">
                             <p>
                                 ©
                                 <script>
                                     document.write(new Date().getFullYear());
                                 </script>
                                 webadmin. Crafted with
                                 <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- end container -->
     </div>
 </x-guest-layout>
