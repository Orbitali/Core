<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Foundations\StatusScope;
use Orbitali\Http\Models\Form;
use Illuminate\Http\Request;
use Orbitali\Foundations\Helpers\Eloquent;

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
    public function index(Request $request)
    {
        $entries = Form::query();

        $columns = (new Form())->structure->columns;

        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );

        $entries = $entries->paginate(25)->withQueryString();

        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.form.title", "Formlar"]),
            "search" => true,
            "options" => [
                [
                    "route" => route("panel.form.create"),
                    "title" => trans([
                        "native.panel.form.add",
                        "Yeni form ekle",
                    ]),
                    "icon" => "fa-plus",
                    "text" => "",
                ],
            ],
            "actions" => [
                function ($entity) {
                    return [
                        "route" => route("panel.form.show", $entity),
                        "title" => trans([
                            "native.panel.form.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.form.edit", $entity),
                        "title" => trans(["native.panel.form.edit", "Düzenle"]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.form.destroy", $entity),
                        "title" => trans(["native.panel.form.destroy", "Sil"]),
                        "icon" => "fa-times",
                        "class" => "js-destroy",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.form.destroy", $entity)
                            )
                            ->class("d-none"),
                    ];
                },
            ],
        ];

        return view("Orbitali::inc.list", $blockOptions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $model = Form::preCreate();
        if ($model !== false) {
            return redirect(route("panel.form.edit", $model));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.form.message.create.error",
                    "Form oluşturulamadı",
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
     * @param  Form $form
     * @return Response
     */
    public function show(Request $request, Form $form)
    {
        $entries = $form
            ->entries()
            ->with("form")
            ->orderBy("read_at", "asc")
            ->orderBy("created_at", "desc");

        $columns = $form->structure->columns;

        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );

        $entries = $entries->paginate(25)->withQueryString();

        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.form.title", "Formlar"]),
            "search" => true,
            "options" => [],
            "actions" => [
                function ($entity) {
                    return [
                        "route" => route("panel.form.entry", $entity),
                        "title" => trans([
                            "native.panel.form.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
            ],
        ];

        return view("Orbitali::inc.list", $blockOptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Form $form
     * @return Response
     */
    public function edit(Form $form)
    {
        html()->readonly($form->status != StatusScope::PREDRAFT);
        $form->structure;
        return view("Orbitali::form.edit", compact("form"));
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
        html()->model($form);
        $structure = $form->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $form
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $form->forceFill($inputs);
        $form->save();
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
