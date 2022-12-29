@extends('Orbitali::inc.app')
@section('container2')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group mb-4 row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("container")
<div id="page-container">
    {{-- Main Container --}}
    <main id="main-container">
        {{-- Page Content --}}
        <div class="row no-gutters justify-content-center bg-body-dark">
            <div class="hero-static col-sm-6 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                {{-- Confirm Block --}}
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
                                        @lang(['native.auth.confirm.title','Confirm Password'])</p>
                                </div>
                                {{-- Confirm Form --}}
                                <form class="js-validation-signin" action="{{ route('password.confirm') }}"
                                    aria-label="@lang(['native.auth.confirm.title','Confirm Password'])" method="POST">
                                    @csrf
                                    <div class="alert alert-info" role="alert">
                                        {{ __('Please confirm your password before continuing.') }}
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password"
                                            class="form-control form-control-alt{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            id="password" name="password" required autocomplete="current-password"
                                            placeholder="@lang(['native.auth.login.password','Password'])">
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <button type="submit" class="btn btn-block btn-hero-primary">
                                            <i class="fa fa-fw fa-fw fa-sign-in-alt mr-1" aria-hidden="true"></i>
                                            @lang(['native.auth.confirm.submit','Confirm Password'])
                                        </button>
                                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                            @if(config("orbitali.passwordResetActivity"))
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1"
                                                href="{{ route('password.request') }}">
                                                <i class="fa fa-exclamation-triangle fa-fw text-muted mr-1"
                                                    aria-hidden="true"></i>
                                                @lang(['native.auth.login.forget_password','Forgot Your Password'])
                                            </a>
                                            @endif
                                        </p>
                                    </div>
                                </form>
                                {{-- END Confirm Form --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END Confirm Block --}}
            </div>
        </div>
        {{-- END Page Content --}}

    </main>
    {{-- END Main Container --}}
</div>
@endsection
