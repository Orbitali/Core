<?php

namespace Orbitali\Http\Traits;

use Orbitali\Http\Models\Form;
use Illuminate\Http\Request;
use Orbitali\Foundations\Helpers\Structure;

trait FormSubmission
{
    public function formSubmission(Request $request)
    {
        $form = Form::where("key", $request->get("form_key"))->firstOrFail();

        html()->model($form);
        list($rules, $names) = Structure::parseStructureValidations(
            $form->structure,
            null
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $form->entries()->create([
            "ip" => $request->ips(),
            "data" => $inputs,
        ]);

        return redirect()->back();
    }
}
