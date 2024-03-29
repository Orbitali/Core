@extends('Orbitali::inc.app')

@section("container")
<div id="page-container">
    {{-- Main Container --}}
    <main id="main-container">
        {{-- Page Content --}}
        <div class="bg-body-dark d-flex justify-content-center">
            <div class="hero-static col-sm-6 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                {{-- Reset Password Block --}}
                <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden">
                    <div class="row no-gutters">
                        <div class="col-md-12 bg-body-extra-light">
                            <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                {{-- Header --}}
                                <div class="mb-2 text-center">
                                    <a class="link-fx fw-bold fs-1" href="#">
                                        <span class="text-body-color">Orbital</span><span class="text-primary">i</span>
                                    </a>
                                    <p class="text-uppercase fw-bold fs-6 text-muted">
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
                                        is <strong>:controller</strong>'], ["controller"=>$orbitali->class])
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        @lang(['native.setup.step3','Controller has to be <strong>:method</strong>
                                        method'],
                                        ["method"=>$orbitali->method])
                                    </div>
                                    <div class="form-group mb-4">
                                        <button type="submit" class="btn btn-primary w-100">
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
