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
                                        @lang(['native.setup.welcome','Welcome to Orbitali'])</p>
                                </div>

                                <form class="js-validation-signin"
                                    aria-label="@lang(['native.setup.welcome','Welcome to Orbitali'])" method="POST">
                                    @csrf
                                    <div class="alert alert-info" role="alert">
                                        @lang(['native.setup.step1','This is the default page of controller.'])
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        @lang(['native.setup.step2','You have to be create a new controller which
                                        is <b>:controller</b>'], ["controller"=>$orbitali->class])
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        @lang(['native.setup.step3','Controller has to be <b>:method</b> method'],
                                        ["method"=>$orbitali->method])
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-hero-primary">
                                            <i class="fa fa-fw fa-plus mr-1" aria-hidden="true"></i>
                                            @lang(['native.setup.create','Auto Create Class'])
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