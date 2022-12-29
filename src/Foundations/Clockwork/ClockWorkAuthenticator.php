<?php

namespace Orbitali\Foundations\Clockwork;

use Clockwork\Authentication\AuthenticatorInterface;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\EncryptCookies;

class ClockWorkAuthenticator implements AuthenticatorInterface
{
    public function attempt(array $credentials)
    {
        return $this->check("");
    }

    public function check($token)
    {
        $request = request();
        $sessionStarter = new StartSession(session());
        $encrypter = new EncryptCookies(app("encrypter"));

        $encrypter->handle($request, function ($request) use ($sessionStarter) {
            return $sessionStarter->handle($request, function () {
                return response("");
            });
        });
        $user = auth()->user();
        return $user != null && $user->isAn("super_admin");
    }

    public function requires()
    {
        return [];
    }
}
