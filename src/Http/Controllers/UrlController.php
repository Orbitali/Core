<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Url;
use Illuminate\Http\Request;
use Orbitali\Foundations\Helpers\Eloquent;

class UrlController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Url::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $entries = Url::query()->with("extras", "model");

        $columns = (new Url(["id" => 0]))->structure->columns;

        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );

        $entries = $entries->paginate(25)->withQueryString();

        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.url.title", "Bağlantılar"]),
            "search" => true,
            "options" => [],
            "actions" => [
                function ($entity) {
                    return [
                        "route" => route("panel.url.show", $entity),
                        "title" => trans([
                            "native.panel.url.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.url.edit", $entity),
                        "title" => trans(["native.panel.url.edit", "Düzenle"]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.url.destroy", $entity),
                        "title" => trans(["native.panel.url.destroy", "Sil"]),
                        "icon" => "fa-times",
                        "class" => "js-destroy",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.url.destroy", $entity)
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
        //
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
     * @param  Url $url
     * @return Response
     */
    public function show(Request $request, Url $url)
    {
        return redirect($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Url $url
     * @return Response
     */
    public function edit(Url $url)
    {
        $url->structure;
        return view("Orbitali::url.edit", compact("url"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Url $url
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Url $url)
    {
        html()->model($url);
        $structure = $url->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $url
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $url->fillWithExtra($inputs);
        return redirect()->to(route("panel.url.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Url $url
     * @return Response
     * @throws \Exception
     */
    public function destroy(Url $url)
    {
        if ($url->delete() !== false) {
            session()->flash(
                "success",
                trans(
                    [
                        "native.panel.url.message.destroy.success",
                        ":key silme işlemi başarılı.",
                    ],
                    ["key" => $url->key]
                )
            );
        } else {
            session()->flash(
                "danger",
                trans(
                    [
                        "native.panel.url.message.destroy.danger",
                        ":key silme işlemi hatalı.",
                    ],
                    ["key" => $url->key]
                )
            );
        }
        return redirect()->back();
    }
}
