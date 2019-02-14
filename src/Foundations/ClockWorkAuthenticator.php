<?php

namespace Orbitali\Foundations;

use Clockwork\Authentication\AuthenticatorInterface;

class ClockWorkAuthenticator implements AuthenticatorInterface
{
    public function attempt(array $credentials)
    {
        return true;
    }

    public function check($token)
    {
        return true;
    }

    public function requires()
    {
        return [];
    }
}
