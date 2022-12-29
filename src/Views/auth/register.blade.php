@extends('Orbitali::inc.app')

@section("container")
<div id="page-container">
    {{-- Main Container --}}
    <main id="main-container">
        {{-- Page Content --}}
        <div class="bg-body-dark d-flex justify-content-center">
            <div class="hero-static col-sm-6 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                {{-- Sign In Block --}}
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
                                        @lang(['native.auth.register.title','Register'])</p>
                                </div>

                                <form class="js-validation-signin" action="{{ route('register') }}"
                                    aria-label="@lang(['native.auth.register.title','Register'])" method="POST">
                                    @csrf

                                    <div class="form-group mb-4">
                                        <input type="text"
                                            class="form-control form-control-alt{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            id="name" name="name" value="{{ old('name') }}" required autofocus
                                            placeholder="@lang(['native.auth.register.name','Name'])">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="email"
                                            class="form-control form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            id="email" name="email" value="{{ old('email') }}" required autofocus
                                            placeholder="@lang(['native.auth.register.mail','E-Mail Address'])">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password"
                                            class="form-control form-control-alt{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            id="password" name="password" required
                                            placeholder="@lang(['native.auth.register.password','Password'])">
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password"
                                            class="form-control form-control-alt{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                            id="password_confirmation" name="password_confirmation" required
                                            placeholder="@lang(['native.auth.register.password_confirmation','Confirm Password'])">
                                        @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div
                                        class="form-group mb-4 d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                                        <div class="custom-control form-check custom-control-primary">
                                            <input type="checkbox" class="form-check-input" id="terms_agree"
                                                name="terms_agree" {{ old('terms_agree') ? 'checked' : '' }} required>
                                            <label class="custom-control-label"
                                                for="terms_agree">@lang(['native.auth.register.terms_agreee','I agree to
                                                Terms & Conditions'])</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fa fa-fw fa-plus mr-1" aria-hidden="true"></i>
                                            @lang(['native.auth.register.sing_up','Sing Up'])
                                        </button>
                                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1"
                                                href="{{ route('login') }}">
                                                <i class="fa fa-sign-in-alt text-muted mr-1" aria-hidden="true"></i>
                                                @lang(['native.auth.register.login_button','Sing In'])
                                            </a>
                                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="#"
                                                data-bs-toggle="modal" data-bs-target="#modal-terms">
                                                <i class="fa fa-book text-muted mr-1" aria-hidden="true"></i>
                                                @lang(['native.auth.register.read_term','Read Terms'])
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
        {{-- Terms Modal --}}
        <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">@lang(['native.auth.register.terms.title','Terms & Conditions'])
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            @lang(['native.auth.register.term.body','<p>Dolor posuere proin blandit accumsan senectus
                                netus nullam curae, ornare laoreet
                                adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est
                                ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio
                                sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>'])
                        </div>
                        <div class="block-content block-content-full text-right bg-body">
                            <button type="button" class="btn btn-sm btn-primary"
                                data-bs-dismiss="modal">@lang(['native.auth.register.terms.done','Done'])</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END Terms Modal --}}
    </main>
    {{-- END Main Container --}}
</div>
@endsection
