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

        // prettier-ignore
        $children = [
            [":tag" => "Status", "title" => "Status", "name"=> "status", ":rules"=>[] ],
            [":tag" => "FormGroup", "title" => "Text", "type"=>"text", "name"=> "", ":rules"=>[] ],
            [":tag" => "FormGroup", "title" => "Editor", "type"=>"editor", "name"=> "", ":rules"=>[] ],
            [":tag" => "FormGroup", "title" => "Text Area", "type"=>"textarea", "name"=> "", ":rules"=>[] ],
            [":tag" => "FormGroup", "title" => "Url", "type"=>"url", "name"=> "", ":rules"=>[] ],
            [":tag" => "FormGroup", "title" => "Email", "type"=>"email", "name"=> "", ":rules"=>[] ],
            [":tag" => "FormGroup", "title" => "Slug", "type"=>"slug", "name"=> "", ":rules"=>[] ],
            [":tag" => "FormGroup", "title" => "Masked Input", "type"=>"mask", "name"=> "", ":rules"=>[], ":mask"=>"", ":overwrite"=>false, ":placeholderChar"=>"_" ],
            [":tag" => "FormGroup", "title" => "File", "type"=>"file", "name"=> "", ":rules"=>[], ":multiple"=>false ],
            [":tag" => "FormGroup", "title" => "Checkbox", "type"=>"checkbox", "name"=> "", ":rules"=>[], ":data-source"=>"" ],
            [":tag" => "FormGroup", "title" => "Radio Button", "type"=>"radio", "name"=> "", ":rules"=>[], ":data-source"=>"" ],
            [":tag" => "FormGroup", "title" => "Select", "type"=>"select", "name"=> "", ":rules"=>[], ":multiple"=>false, ":data-source"=>"" ],

            //[":tag" => "Repeater", "title" => "Repeater", ":children"=>[] ],
            [":tag" => "DetailPanel", "title" => "Detail Panel", ":children"=>[] ],
            [":tag" => "Panel", "title" => "Panel", ":children"=>[] ],
            [":tag" => "PanelTab", "title" => "Panel Tab", ":children"=>[] ],

            [":tag" => "Style", "title" => "Style", ":content"=>"" ],
            [":tag" => "Script", "title" => "Script", ":content"=>"" ],
        ];

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

    /**
     * Preview the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function preview($type, $id)
    {
        $structureModel = Structure::with("model.structure")
            ->where([
                "model_type" => $type,
                "model_id" => $id,
            ])
            ->first();
        $model = $structureModel->model;
        $structure = request("structure", []);
        return view(
            "Orbitali::structure.preview",
            compact("structure", "model")
        );
    }
}
