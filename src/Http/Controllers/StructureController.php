<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\Structure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class StructureController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $type
     * @param  int $id
     * @return Response
     */
    public function edit($type, $id)
    {
        $structure = Structure::where(["model_type" => $type, 'model_id' => $id])->first();
        $structure = $structure ? $structure->data : [];
        return view("Orbitali::structure.builder", compact("structure"));
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
        Structure::updateOrCreate(["model_type" => $type, 'model_id' => $id], ["data" => json_decode(Input::get("data"), 1)]);
        return redirect()->to(route('panel.' . str_singular($type) . '.edit', $id));
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
        $status = Structure::where(["model_type" => $type, 'model_id' => $id])->delete();
        if ($status) {
            session()->flash("success", trans(["native.panel.website.message.destroy.success", "Silme işlemi başarılı."]));
        } else {
            session()->flash("success", trans(["native.panel.website.message.destroy.success", "Silme işlemi başarılı."]));
        }
        return redirect()->back();
    }

}
