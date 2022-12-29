@extends('Orbitali::inc.app')

@section("container")
<div id="page-container">
    {{-- Main Container --}}
    <main id="main-container">
        {{-- Page Content --}}
        <div class="row no-gutters justify-content-center bg-body-dark">
            <div class="hero-static col-sm-6 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                {{-- Sign In Block --}}
                <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden">
                    <div class="row no-gutters">
                        <div class="col-md-12 bg-body-extra-light">
                            <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                {{-- Header --}}
                                <div class="mb-2 text-center">
                                    <a class="link-fx fw-bold fs-1" href="#">
                                        <span class="text-dark">Orbital</span><span class="text-primary">i</span>
                                    </a>
                                    <p class="text-uppercase fw-bold fs-6 text-muted">
                                        @lang(['native.auth.passwords.email.title','Password Reminder'])</p>
                                </div>

                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <form class="js-validation-signin" action="{{ route('password.email') }}"
                                    aria-label="@lang(['native.auth.passwords.email.title','Password Reminder'])"
                                    method="POST">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <input type="email"
                                            class="form-control form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            id="email" name="email" value="{{ old('email') }}" required autofocus
                                            placeholder="@lang(['native.auth.passwords.email.mail','E-Mail Address'])">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <button type="submit" class="btn btn-block btn-hero-primary">
                                            <i class="fa fa-fw fa-reply mr-1" aria-hidden="true"></i>
                                            @lang(['native.auth.passwords.email.send_password_reset_link','Send Password
                                            Reset Link'])
                                        </button>
                                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1"
                                                href="{{ route('login') }}">
                                                <i class="fa fa-sign-in-alt text-muted mr-1" aria-hidden="true"></i>
                                                @lang(['native.auth.register.login_button','Sing In'])
                                            </a>
                                        </p>
                                    </div>

                                </form>
                                {{-- END Sign In Form --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END Sign In Block --}}
            </div>
        </div>
        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}
</div>
@endsection
