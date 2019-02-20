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
                            <div class="col-md-12 bg-white">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    {{-- Header --}}
                                    <div class="mb-2 text-center">
                                        <a class="link-fx font-w700 font-size-h1" href="#">
                                            <span class="text-dark">Orbital</span><span class="text-primary">i</span>
                                        </a>
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">@lang(['native.auth.login.title','Login'])</p>
                                    </div>

                                    <form class="js-validation-signin" action="{{ route('login') }}"
                                          aria-label="@lang(['native.auth.login.title','Login'])" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                   class="form-control form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   id="email"
                                                   name="email"
                                                   placeholder="@lang(['native.auth.login.mail','E-Mail Address'])">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                   class="form-control form-control-alt{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   id="password" name="password" required
                                                   placeholder="@lang(['native.auth.login.password','Password'])">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div
                                            class="form-group d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                                            <div class="custom-control custom-checkbox custom-control-primary">
                                                <input type="checkbox" class="custom-control-input" id="remember"
                                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                       for="remember">@lang(['native.auth.login.remember','Remember Me'])</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-hero-primary">
                                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> @lang(['native.auth.login.login_button','Login'])
                                            </button>
                                            <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                                @if(config("orbitali.passwordResetActivity"))
                                                <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1"
                                                   href="{{ route('password.request') }}">
                                                    <i class="fa fa-exclamation-triangle text-muted mr-1"></i> @lang(['native.auth.login.forget_password','Forgot Your Password'])
                                                </a>
                                                @endif
                                                @if(config("orbitali.registerActivity"))
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1"
                                                       href="{{ route('register') }}">
                                                        <i class="fa fa-plus text-muted mr-1"></i> @lang(['native.auth.login.new_account','New Account'])
                                                    </a>
                                                @endif
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
