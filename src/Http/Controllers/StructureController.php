<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Http\Models\Structure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
        $structures = Structure::with("model.detail")
            ->where("model_id", "<>", 0)
            ->orderBy("model_type")
            ->orderBy("model_id")
            ->paginate(5);
        return view("Orbitali::structure.index", compact("structures"));
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
            return redirect(route("panel.structure.edit", $model->id));
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
    public function show($id)
    {
        $structure = Structure::find($id);
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
    public function edit(Request $req, $id)
    {
        $structure = Structure::find($id);
        $type = $structure->model_type;
        if ($structure->model_id == 0) {
            $req->merge([
                "model_type" => $type,
                "data" => $structure->data,
            ]);
            return $this->create($req);
        }

        $structure = $structure ? $structure->data : [];

        $children = Structure::where([
            "model_type" => "structures",
            "model_id" => 0,
        ])
            ->where("mode", "<>", "test")
            ->pluck("data");

        return view(
            "Orbitali::structure.edit",
            compact("structure", "children", "type", "id")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     */
    public function update(Request $req, $id)
    {
        Structure::updateOrCreate(
            ["id" => $id],
            ["data" => json_decode($req->get("data"), 1)]
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
    public function destroy($id)
    {
        $status = Structure::where("id", $id)->delete();
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
    public function preview(Request $req, $id)
    {
        $structureModel = Structure::with("model.structure")->find($id);
        $model = $structureModel->model;
        if ($structureModel->mode != "self") {
            $model = $structureModel->model->{$structureModel->mode}->first();
        }

        $structure = $req->get("structure", []);
        return view(
            "Orbitali::structure.preview",
            compact("structure", "model")
        );
    }
}
