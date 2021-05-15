<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with("extras")->paginate(5);
        return view("Orbitali::user.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $model = User::preCreate(["user_id" => auth()->id()]);
        if ($model !== false) {
            return redirect(route("panel.user.edit", $model->id));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.user.message.create.error",
                    "Kullanıcı oluşturulamadı",
                ])
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return Response
     */
    public function show(User $user)
    {
        $user->loadMissing("detail.url");
        return redirect($user->detail->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $user->loadMissing(["extras", "details.extras", "details.url"]);
        $structure = $user->structure;
        return view("Orbitali::user.edit", compact("user", "structure"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  User $user
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        html()->model($user);
        $structure = $user->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $user
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $user->fillWithExtra($inputs);
        return redirect()->to(route("panel.user.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete() !== false) {
            session()->flash(
                "success",
                trans(
                    [
                        "native.panel.user.message.destroy.success",
                        ":name silme işlemi başarılı.",
                    ],
                    ["name" => $user->name]
                )
            );
        } else {
            session()->flash(
                "danger",
                trans(
                    [
                        "native.panel.user.message.destroy.danger",
                        ":name silme işlemi hatalı.",
                    ],
                    ["name" => $user->name]
                )
            );
        }
        return redirect()->back();
    }
}
