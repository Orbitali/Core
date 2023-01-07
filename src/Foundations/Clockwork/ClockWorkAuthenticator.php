<?php

namespace Orbitali\Foundations\Clockwork;

use Clockwork\Authentication\AuthenticatorInterface;
use Illuminate\Session\SessionManager;
use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;
use Illuminate\Cookie\CookieValuePrefix;

class ClockWorkAuthenticator implements AuthenticatorInterface
{
    /**
     * The session manager.
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $manager;

    /**
     * The encrypter instance.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $encrypter;

    public function __construct(SessionManager $manager, EncrypterContract $encrypter)
    {
        $this->manager = $manager;
        $this->encrypter = $encrypter;
    }

    public function attempt(array $credentials)
    {
        return $this->check("");
    }

    public function check($token)
    {
        $this->loadSession();
        return auth()->user()?->isAn("super_admin") ?? false;
    }


    public function requires()
    {
        return [];
    }

    private function loadSession()
    {
        $request = request();
        $session = $this->manager->driver();
        if($session->isStarted()){
            return;
        }
        $cookieKey = $session->getName();
        $cookieValue = $request->cookies->get($cookieKey);
        $cookieValue = $this->encrypter->decrypt($cookieValue, false);
        $cookieValue = CookieValuePrefix::validate($cookieKey, $cookieValue, $this->encrypter->getKey());
        $session->setId($cookieValue);
        $session->setRequestOnHandler($request);
        $session->start();
        $request->setLaravelSession($session);
    }
}
