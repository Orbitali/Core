<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\FormEntry;
use Illuminate\Http\Request;
use Orbitali\Foundations\Helpers\Structure;

class FormEntryController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(FormEntry::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  FormEntry $formEntry
     * @return Response
     */
    public function show(FormEntry $formEntry)
    {
        html()->readonly(true);
        if ($formEntry->read_at == null) {
            $formEntry->update(["read_at" => now()]);
        }
        $formEntry->loadMissing("form");
        $data = $formEntry->data;
        $data["structure"] = &$formEntry->form->structure;
        $data = (object) $data;
        return view("Orbitali::form.entry", compact("formEntry", "data"));
    }
}
