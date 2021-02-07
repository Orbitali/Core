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
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">@lang(['native.auth.verify.title','Verify Your Email Address'])</p>
                                    </div>

                                    <form class="js-validation-signin" action="{{ route('verification.resend') }}"
                                          aria-label="@lang(['native.auth.verify.title','Verify Your Email Address'])" method="POST">
                                        @csrf
                                        @if (session('resent'))
                                            <div class="alert alert-success" role="alert">
                                                {{ __('A fresh verification link has been sent to your email address.') }}
                                            </div>
                                        @endif
                                        <div class="alert alert-info" role="alert">
                                            {{ __('Before proceeding, please check your email for a verification link.') }}
                                        </div>
                                       
                                        {{ __('If you did not receive the email') }},
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                            @lang(['native.auth.verify.submit','click here to request another.'])
                                        </button>
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
