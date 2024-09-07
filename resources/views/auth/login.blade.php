@extends('layouts.app')

@section('content')
    {{-- @guest
        @include('layouts.components.web-topbar')
    @endguest --}}
    <div>
        <div class="p-0">
            <div class="row g-0" style="overflow-y: hidden;">

                {{-- <div class="col-xl-8">
                    <div class="auth-full-bg pt-lg-1">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">

                                                <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">5k</span>+ Satisfied clients</h4>

                                                <img src="{{ asset('images/flag-boy.webp') }}" alt="">
                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" Fantastic theme with a ton of options. If you just want the HTML to integrate with your project, then this is the package. You can find the files in the 'dist' folder...no need to install git and all the other stuff the documentation talks about. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">Abs1981</h4>
                                                                    <p class="font-size-14 mb-0">- Concreted Education User</p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" If Every Vendor on Envato are as supportive as Themesbrand, Development with be a nice experience. You guys are Wonderful. Keep us the good work. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">nezerious</h4>
                                                                    <p class="font-size-14 mb-0">- Concreted Education User</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-8 col-md-6 col-sm-12 d-none d-md-block" style="overflow-y: hidden; overflow-x: hidden;">
                    <div class="auth-full-bg pt-lg-1">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">
                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        {{-- <div class="col-lg-7 d-none d-md-block"> <!-- Hide on screens smaller than lg --> --}}
                                            <div class="text-center">
                                                <img src="{{ asset('images/flag-boy.webp') }}" alt="" class="img-fluid"> <!-- Make image responsive -->
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="index.html" class="d-block card-logo">
                                        <img src="assets/images/logo-dark.png" alt="" height="18" class="card-logo-dark">
                                        <img src="assets/images/logo-light.png" alt="" height="18" class="card-logo-light">
                                    </a>
                                </div>
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to Concreted Education.</p>
                                    </div>

                                    <div class="mt-4">
                                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {{-- <div class="float-end">
                                                    <a href="auth-recoverpw-2.html" class="text-muted">Forgot password?</a>
                                                </div> --}}
                                                <label class="form-label">Password</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" aria-label="Password" aria-describedby="password-addon" @error('password') is-invalid @enderror autocomplete="current-password">
                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </form>
                                        {{-- <div class="mt-5 text-center">
                                            <p>Don't have an account ? <a href="auth-register-2.html" class="fw-medium text-primary"> Signup now </a> </p>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <div class="text-center">
                                        <div>
                                            {{-- <p>Don't have an account ? <a href="{{ route('register') }}" class="fw-medium text-primary"> Signup Now </a> </p> --}}
                                            <p>© <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}. <br> Powered with <i class="mdi mdi-heart text-danger"></i> by The Tech Shelf</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
