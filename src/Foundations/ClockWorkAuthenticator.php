<?php

namespace Orbitali\Foundations;

use Clockwork\Authentication\AuthenticatorInterface;
use Illuminate\Support\Facades\Session;

class ClockWorkAuthenticator implements AuthenticatorInterface
{
    public function attempt(array $credentials)
    {
        return true;
    }

    public function check($token)
    {
        Session::setId(request()->cookie(Session::getName()));
        Session::start();
        return auth()->check() && auth()->user()->id == 1;
    }

    public function requires()
    {
        return [];
    }
}
