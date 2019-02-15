@extends('Orbitali::inc.app')

@section("container")
    <div id="page-container">
        {{-- Main Container --}}
        <main id="main-container">
            {{-- Page Content --}}
            <div class="row no-gutters justify-content-center bg-body-dark">
                <div class="hero-static col-sm-5 col-md-4 col-xl-3 d-flex align-items-center p-2 px-sm-0">
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
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">{{ __('Login') }}</p>
                                    </div>
                                    {{-- END Header --}}
                                    {{-- Sign In Form --}}
                                    {{-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) --}}
                                    {{-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation --}}
                                    <form class="js-validation-signin" action="{{ route('login') }}"
                                          aria-label="{{ __('Login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                   class="form-control form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   id="email"
                                                   name="email" placeholder="{{ __('E-Mail Address') }}">
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
                                                   placeholder="{{ __('Password') }}">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-hero-primary">
                                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ __('Login') }}
                                            </button>
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
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
