<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Http\Models\Structure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $structures = Structure::paginate(5);
        return view("Orbitali::structure.index", compact("structures"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $model = Structure::create([
            "model_type" => "structures",
            "model_id" => 0,
        ]);
        $model->model_id = $model->id;
        $model->save();
        if ($model !== false) {
            return redirect(
                route("panel.structure.edit", [
                    Relation::relationFinder($model),
                    $model->id,
                ])
            );
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
    public function show($node)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     */
    public function edit($type, $id)
    {
        $structure = Structure::where([
            "model_type" => $type,
            "model_id" => $id,
        ])->first();
        $structure = $structure ? $structure->data : [];

        $children = [
            [
                ":tag" => "div",
                ":salt" => true,
                ":title" => "Status",
                "class" => "form-group",
                ":children" => [
                    [
                        ":tag" => "label",
                        "class" => "d-block",
                        ":content" => "Status",
                    ],
                    [
                        ":tag" => "div",
                        "class" =>
                            "custom-control custom-control-inline custom-radio custom-control-success",
                        ":children" => [
                            [
                                ":tag" => "input",
                                "type" => "radio",
                                "id" => "active",
                                "name" => "status",
                                ":value" => "1",
                                "class" => "custom-control-input",
                            ],
                            [
                                ":tag" => "label",
                                "for" => "active",
                                ":content" => "Active",
                                "class" => "custom-control-label",
                            ],
                        ],
                    ],
                    [
                        ":tag" => "div",
                        "class" =>
                            "custom-control custom-control-inline custom-radio custom-control-danger",
                        ":children" => [
                            [
                                ":tag" => "input",
                                "type" => "radio",
                                "id" => "passive",
                                "name" => "status",
                                ":value" => "0",
                                "class" => "custom-control-input",
                            ],
                            [
                                ":tag" => "label",
                                "for" => "passive",
                                ":content" => "Passive",
                                "class" => "custom-control-label",
                            ],
                        ],
                    ],
                    [
                        ":tag" => "div",
                        "class" =>
                            "custom-control custom-control-inline custom-radio custom-control-dark",
                        ":children" => [
                            [
                                ":tag" => "input",
                                "type" => "radio",
                                "id" => "draft",
                                "name" => "status",
                                ":value" => "2",
                                "class" => "custom-control-input",
                            ],
                            [
                                ":tag" => "label",
                                "for" => "draft",
                                ":content" => "Draft",
                                "class" => "custom-control-label",
                            ],
                        ],
                    ],
                ],
            ],
            [
                ":tag" => "div",
                ":salt" => true,
                ":title" => "Order",
                "class" => "form-group",
                ":children" => [
                    [
                        ":tag" => "label",
                        "for" => "order",
                        ":content" => "Order",
                    ],
                    [
                        ":tag" => "input",
                        "type" => "number",
                        "name" => "order",
                        "class" => "form-control",
                        ":rules" => ["required", "numeric"],
                    ],
                ],
            ],
            ///
            [":tag" => "detail", ":title" => "Detail", ":children" => []],
            [":tag" => "input", "type" => "text", ":title" => "Text"],
            [":tag" => "label", "for" => "id", ":title" => "Label"],
            [":tag" => "input", "type" => "password", ":title" => "Password"],
            [":tag" => "input", "type" => "email", ":title" => "Email"],
            [":tag" => "input", "type" => "file", ":title" => "File"],
            [":tag" => "input", "type" => "checkbox", ":title" => "Checkbox"],
            [":tag" => "input", "type" => "radio", ":title" => "Radio"],
            [":tag" => "textarea", ":title" => "Textarea"],
            [":tag" => "select", ":children" => [], ":title" => "Select"],
            [":tag" => "div", ":children" => [], ":title" => "Div"],
            [
                ":tag" => "div",
                "class" => "form-group",
                ":title" => "Form Group",
                ":children" => [
                    [":tag" => "label", "for" => "id", ":title" => "Label"],
                    [":tag" => "input", "type" => "text", ":title" => "Text"],
                ],
            ],
        ];

        return view(
            "Orbitali::structure.edit",
            compact("structure", "children")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     */
    public function update($type, $id)
    {
        Structure::updateOrCreate(
            ["model_type" => $type, "model_id" => $id],
            ["data" => json_decode(Request::get("data"), 1)]
        );
        if ($type == "structures") {
            return redirect()->to(route("panel.structure.index"));
        }
        return redirect()->to(
            route("panel." . Str::singular($type) . ".edit", $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($type, $id)
    {
        $status = Structure::where([
            "model_type" => $type,
            "model_id" => $id,
        ])->delete();
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
                "success",
                trans([
                    "native.panel.website.message.destroy.success",
                    "Silme işlemi başarılı.",
                ])
            );
        }
        return redirect()->back();
    }
}
