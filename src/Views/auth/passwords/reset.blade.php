@extends('Orbitali::inc.app')

@section("container")
<div id="page-container">
    {{-- Main Container --}}
    <main id="main-container">
        {{-- Page Content --}}
        <div class="row no-gutters justify-content-center bg-body-dark">
            <div class="hero-static col-sm-6 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                {{-- Reset Password Block --}}
                <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden">
                    <div class="row no-gutters">
                        <div class="col-md-12 bg-white">
                            <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                {{-- Header --}}
                                <div class="mb-2 text-center">
                                    <a class="link-fx font-w700 font-size-h1" href="#">
                                        <span class="text-dark">Orbital</span><span class="text-primary">i</span>
                                    </a>
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">
                                        @lang(['native.auth.register.title','Register'])</p>
                                </div>

                                <form class="js-validation-signin" action="{{ route('password.request') }}"
                                    aria-label="@lang(['native.auth.reset.title','Reset Password'])" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            id="email" name="email" value="{{  $email ?? old('email') }}" required
                                            autofocus placeholder="@lang(['native.auth.reset.mail','E-Mail Address'])">
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
                                            placeholder="@lang(['native.auth.reset.password','Password'])">
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-alt{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                            id="password_confirmation" name="password_confirmation" required
                                            placeholder="@lang(['native.auth.reset.password_confirmation','Confirm Password'])">
                                        @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-hero-primary">
                                            <i class="fa fa-fw fa-plus mr-1" aria-hidden="true"></i>
                                            @lang(['native.auth.reset.submit','Reset Password'])
                                        </button>
                                    </div>
                                </form>
                                {{-- END Reset Password Form --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END Reset Password Block --}}
            </div>
        </div>
        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}
</div>
@endsection