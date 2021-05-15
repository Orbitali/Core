<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\Form;
use Illuminate\Http\Request;
use Orbitali\Foundations\Helpers\Structure;

class FormController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Form::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $forms = Form::paginate(5);
        return view("Orbitali::form.index", compact("forms"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        /*
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
        */
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
     * @param  Form $form
     * @return Response
     */
    public function show(Form $form)
    {
        $entries = $form
            ->entries()
            ->orderByDesc("created_at")
            ->paginate(5);
        return view("Orbitali::form.show", compact("form", "entries"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Form $form
     * @return Response
     */
    public function edit(Form $form)
    {
        return redirect()->to(route("panel.form.index"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Form $form
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Form $form)
    {
        return redirect()->to(route("panel.form.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Form $form
     * @return Response
     * @throws \Exception
     */
    public function destroy(Form $form)
    {
        if ($form->delete() !== false) {
            session()->flash(
                "success",
                trans(
                    [
                        "native.panel.form.message.destroy.success",
                        ":key silme işlemi başarılı.",
                    ],
                    ["key" => $form->key]
                )
            );
        } else {
            session()->flash(
                "danger",
                trans(
                    [
                        "native.panel.form.message.destroy.danger",
                        ":key silme işlemi hatalı.",
                    ],
                    ["key" => $form->key]
                )
            );
        }
        return redirect()->back();
    }
}
