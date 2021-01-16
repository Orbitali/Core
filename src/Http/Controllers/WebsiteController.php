<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $websites = Website::with("extras")->paginate(5);
        return view("Orbitali::website.index", compact("websites"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $parsed = parse_url($request->fullUrl());
        $ssl = isset($parsed["scheme"]) ? $parsed["scheme"] === "https" : false;
        $domain = isset($parsed["host"]) ? $parsed["host"] : "local";
        $model = Website::preCreate([
            "ssl" => $ssl,
            "name" => $domain,
            "domain" => $domain,
        ]);
        if ($model !== false) {
            return redirect(route("panel.website.edit", $model->id));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.website.message.create.error",
                    "Websitesi oluşturulamadı",
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
     * @param  int $website
     * @return Response
     */
    public function show($website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $website
     * @return Response
     */
    public function edit($website)
    {
        $website = Website::withPredraft()
            ->with("extras")
            ->findOrFail($website);
        $languages = array_flip(
            require __DIR__ . "/../../Database/languages.php"
        );
        array_walk($languages, function ($ind, $k) use (&$languages) {
            $languages[$k] = trans("native.language.$k");
        });
        return view("Orbitali::website.edit", compact("website", "languages"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $website
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $website)
    {
        $inputs = $this->validate($request, [
            "status" => "required",
            "ssl" => "checkbox",
            "domain" => "required|unique:websites,domain,$website,id",
            "name" => "required",
            "languages" => "required",
        ]);

        $website = Website::withPredraft()->findOrFail($website);
        $website->fillWithExtra($inputs);
        return redirect()->to(route("panel.website.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $website
     * @return Response
     * @throws \Exception
     */
    public function destroy($website)
    {
        $website = Website::withPredraft()->findOrFail($website);
        if ($website->delete() !== false) {
            session()->flash(
                "success",
                trans(
                    [
                        "native.panel.website.message.destroy.success",
                        ":name silme işlemi başarılı.",
                    ],
                    ["name" => $website->name]
                )
            );
        } else {
            session()->flash(
                "success",
                trans(
                    [
                        "native.panel.website.message.destroy.success",
                        ":name silme işlemi başarılı.",
                    ],
                    ["name" => $website->name]
                )
            );
        }
        return redirect()->back();
    }
}
