<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\Structure;
use Orbitali\Http\Models\Page;
use Orbitali\Http\Models\Node;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Eloquent;

class StructureController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Structure::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $entries = Structure::with("model")
            ->where("model_id", "<>", 0)
            ->whereHas("model")
            ->orderBy("model_type")
            ->orderBy("model_id");

        $columns = collect([
            [
                "name" => "model.detail.name",
                "order" => 0,
                "title" => "Name",
            ],
            [
                "name" => "model_type",
                "order" => 1,
                "title" => "Type",
            ],
            [
                "name" => "mode",
                "order" => 2,
                "title" => "Mode",
            ],
        ]);
        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );
        $entries = $entries->paginate(25)->withQueryString();
        $entries->loadMorph("model", [
            Page::class => ["extras", "detail.extras"],
            Node::class => ["extras", "detail.extras"],
        ]);
        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.structure.title", "Yapılar"]),
            "search" => true,
            "options" => [],
            "actions" => [
                function ($entity) {
                    return [
                        "route" => route("panel.structure.show", $entity),
                        "title" => trans([
                            "native.panel.structure.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.structure.edit", $entity),
                        "title" => trans([
                            "native.panel.structure.edit",
                            "Düzenle",
                        ]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route(
                            "panel.structure.destroy",
                            $entity->id
                        ),
                        "title" => trans([
                            "native.panel.structure.destroy",
                            "Sil",
                        ]),
                        "icon" => "fa-times",
                        "class" => "js-destroy",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.structure.destroy", $entity)
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
    public function create(Request $req)
    {
        $model = Structure::create([
            "model_type" => $req->get("model_type", "structures"),
            "model_id" => $req->get("model_id", 0),
            "data" => $req->get("data", null),
        ]);
        $model->save();
        if ($model !== false) {
            return redirect(route("panel.structure.edit", $model));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.structure.message.create.error",
                    "Yapı oluşturulamadı",
                ])
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $node
     * @return Response
     */
    public function show(Structure $structure)
    {
        $type = Str::singular($structure->model_type);
        $mid = $structure->model_id;
        return redirect(route("panel." . $type . ".show", $mid));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     */
    public function edit(Request $req, Structure $structure)
    {
        $id = $structure->id;
        $type = $structure->model_type;
        $mode = $structure->mode != "self";
        if ($structure->model_id == 0) {
            $req->merge([
                "model_type" => $type,
                "data" => $structure->data,
            ]);
            return $this->create($req);
        }

        $children = Structure::where([
            "model_type" => "structures",
            "model_id" => 0,
        ]);
        if (!$mode) {
            $children = $children->where("data->:tag", "<>", "Column");
        }
        $children = $children->pluck("data");

        return view(
            "Orbitali::structure.edit",
            compact("structure", "children", "type", "id", "mode")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     */
    public function update(Request $req, Structure $structure)
    {
        Structure::updateOrCreate(
            ["id" => $structure->id],
            [
                "data" => json_decode($req->get("data"), true),
                "model_type" => $req->get("model_type"),
                "model_id" => $req->get("model_id"),
                "mode" => $req->get("mode"),
            ]
        );
        return redirect()->to(route("panel.structure.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy(Structure $structure)
    {
        $status = $structure->delete();
        if ($status) {
            session()->flash(
                "success",
                trans([
                    "native.panel.website.message.destroy.success",
                    "Silme işlemi başarılı.",
                ])
            );
        } else {
            session()->flash(
                "danger",
                trans([
                    "native.panel.website.message.destroy.danger",
                    "Silme işlemi hatalı.",
                ])
            );
        }
        return redirect()->back();
    }

    /**
     * Preview the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function preview(Request $req, Structure $structure)
    {
        $structureModel = $structure;
        $model = $structureModel->model;
        if ($structureModel->mode != "self") {
            $model = $structureModel->model->{$structureModel->mode}->first();
        }

        $structure = $req->get("structure", []);
        html()->readonly(true);
        return view(
            "Orbitali::structure.preview",
            compact("structure", "model")
        );
    }
}
