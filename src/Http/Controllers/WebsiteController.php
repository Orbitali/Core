<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Eloquent;

class WebsiteController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Website::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $entries = Website::with("extras");
        $columns = (new Website())->structure->columns;
        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );
        $entries = $entries->paginate(25)->withQueryString();

        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.website.title", "Websiteleri"]),
            "search" => true,
            "options" => [
                [
                    "route" => route("panel.website.create"),
                    "title" => trans([
                        "native.panel.website.add",
                        "Yeni websitesi ekle",
                    ]),
                    "icon" => "fa-plus",
                    "text" => "",
                ],
            ],
            "actions" => [
                function ($entity) {
                    return [
                        "route" => route("panel.website.show", $entity->id),
                        "title" => trans([
                            "native.panel.website.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.website.edit", $entity->id),
                        "title" => trans([
                            "native.panel.website.edit",
                            "Düzenle",
                        ]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.website.destroy", $entity->id),
                        "title" => trans([
                            "native.panel.website.destroy",
                            "Sil",
                        ]),
                        "icon" => "fa-times",
                        "class" => "js-destroy",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.website.destroy", $entity->id)
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
        $parsed = parse_url($request->fullUrl());
        $ssl = isset($parsed["scheme"]) ? $parsed["scheme"] === "https" : false;
        $domain = isset($parsed["host"]) ? $parsed["host"] : "local";
        $model = Website::preCreate([
            "ssl" => $ssl,
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
    public function show(Website $website)
    {
        $website->loadMissing("detail.url");
        return redirect($website->detail->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $website
     * @return Response
     */
    public function edit(Website $website)
    {
        $website->loadMissing(["extras", "details.extras", "details.url"]);
        $structure = $website->structure;
        return view("Orbitali::website.edit", compact("website", "structure"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $website
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Website $website)
    {
        html()->model($website);
        $structure = $website->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $website
        );

        $inputs = $this->validate($request, $rules, [], $names);
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
    public function destroy(Website $website)
    {
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
                "danger",
                trans(
                    [
                        "native.panel.website.message.destroy.danger",
                        ":name silme işlemi hatalı.",
                    ],
                    ["name" => $website->name]
                )
            );
        }
        return redirect()->back();
    }
}
