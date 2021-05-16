<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
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
            "options" => (object) [
                (object) [
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
                    return (object) [
                        "route" => route("panel.form.show", $entity->id),
                        "title" => trans([
                            "native.panel.form.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return (object) [
                        "route" => route("panel.form.edit", $entity->id),
                        "title" => trans(["native.panel.form.edit", "Düzenle"]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return (object) [
                        "route" => route("panel.form.destroy", $entity->id),
                        "title" => trans(["native.panel.form.destroy", "Sil"]),
                        "icon" => "fa-times",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.form.destroy", $entity->id)
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
    public function show(Request $request, Form $form)
    {
        $entries = $form
            ->entries()
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
            "options" => (object) [
                (object) [
                    "route" => route("panel.node.create"),
                    "title" => trans([
                        "native.panel.node.add",
                        "Yeni düğüm ekle",
                    ]),
                    "icon" => "fa-plus",
                    "text" => "",
                ],
            ],
            "actions" => [
                function ($entity) {
                    return (object) [
                        "route" => route("panel.form.entry", $entity->id),
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
