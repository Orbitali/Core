<?php

namespace Orbitali\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Orbitali\Http\Models\User;
use Orbitali\Http\Models\UserExtra;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Orbitali\Http\Middleware\RedirectIfAuthenticated;
use Orbitali\Foundations\StatusScope;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(RedirectIfAuthenticated::class)->except("logout");
    }

    public function redirectTo()
    {
        return config("orbitali.panelPrefix", "/");
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        if ($authUser !== false) {
            Auth::login($authUser, true);
            return redirect($this->redirectPath());
        } else {
            return response("Unauthorized.", 401);
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User|false
     */
    public function findOrCreateUser($user, $provider)
    {
        $provider = UserExtra::with("parent")->firstOrNew([
            "key" => "provider_$provider",
            "value" => $user->id,
        ]);

        if ($provider->parent) {
            return $provider->parent;
        }

        //Register closed
        if (!config("orbitali.registerActivity")) {
            return false;
        }

        $user = User::firstOrCreate(
            ["email" => $user->email],
            ["name" => $user->name, "status" => StatusScope::ACTIVE]
        );
        if ($user->wasRecentlyCreated) {
            event(new Registered($user));
        }
        $provider->user_id = $user->id;
        if (is_null($user->{$provider->key})) {
            $provider->save();
        }
        return $user;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $viewName = "auth.login";
        return view(
            view()->exists($viewName) ? $viewName : "Orbitali::" . $viewName
        );
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->status != StatusScope::ACTIVE) {
            $this->logout($request);
            return $request->wantsJson()
                ? new JsonResponse([], 403)
                : redirect()->back();
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }
}
