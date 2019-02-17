@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.request') }}"
                              aria-label="{{ __('Reset Password') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--TODO:Fix it--}}

{{--
@extends('Orbitali::inc.app')

@section("container")
    <div id="page-container">
        --}}
{{-- Main Container --}}{{--

        <main id="main-container">
            --}}
{{-- Page Content --}}{{--

            <div class="row no-gutters justify-content-center bg-body-dark">
                <div class="hero-static col-sm-6 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    --}}
{{-- Sign In Block --}}{{--

                    <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden">
                        <div class="row no-gutters">
                            <div class="col-md-12 bg-white">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    --}}
{{-- Header --}}{{--

                                    <div class="mb-2 text-center">
                                        <a class="link-fx font-w700 font-size-h1" href="#">
                                            <span class="text-dark">Orbital</span><span class="text-primary">i</span>
                                        </a>
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">@lang(['native.auth.register.title','Register'])</p>
                                    </div>

                                    <form class="js-validation-signin" action="{{ route('password.request') }}"
                                          aria-label="@lang(['native.auth.register.title','Register'])" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-group">
                                            <input type="email"
                                                   class="form-control form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email') }}" required autofocus
                                                   placeholder="@lang(['native.auth.register.mail','E-Mail Address'])">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-hero-primary">
                                                <i class="fa fa-fw fa-plus mr-1"></i> @lang(['native.auth.register.sing_up','Sing Up'])
                                            </button>
                                            <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                                <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1"
                                                   href="{{ route('password.request') }}">
                                                    <i class="fa fa-sign-in-alt text-muted mr-1"></i> @lang(['native.auth.register.login_button','Sing In'])
                                                </a>
                                                <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="#"
                                                   data-toggle="modal" data-target="#modal-terms">
                                                    <i class="fa fa-book text-muted mr-1"></i> @lang(['native.auth.register.read_term','Read Terms'])
                                                </a>
                                            </p>
                                        </div>
                                    </form>
                                    --}}
{{-- END Sign In Form --}}{{--

                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
{{-- END Sign In Block --}}{{--

                </div>
            </div>
            --}}
{{-- END Page Content --}}{{--

            --}}
{{-- Terms Modal --}}{{--

            <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">@lang(['native.auth.register.terms.title','Terms & Conditions'])</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal"
                                            aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                @lang(['native.auth.register.term.body','<p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet
                                    adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est
                                    ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio
                                    sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>'])
                            </div>
                            <div class="block-content block-content-full text-right bg-light">
                                <button type="button" class="btn btn-sm btn-primary"
                                        data-dismiss="modal">@lang(['native.auth.register.terms.done','Done'])</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}
{{-- END Terms Modal --}}{{--

        </main>
        --}}
{{-- END Main Container --}}{{--

    </div>
@endsection
--}}
