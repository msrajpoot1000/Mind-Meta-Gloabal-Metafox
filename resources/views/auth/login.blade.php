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
                                                     <i class="mdi mdi-eye-outline font-size-18 text-muted"
                                                         id="toggle-password-icon"></i>
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
