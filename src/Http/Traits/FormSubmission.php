<?php

namespace Orbitali\Http\Traits;

use Orbitali\Http\Models\Form;
use Illuminate\Http\Request;

trait FormSubmission
{
    public function formSubmission(Request $request)
    {
        /** @var Form $form */
        $form = Form::where("key", $request->get("form_key"))->first();
        $form->entries()->create([
            "ip" => $request->ip(),
            "data" => $request->except([
                "form_key",
                "_token",
                "g-recaptcha-response",
            ]),
        ]);
        return redirect()->back();
    }
}
