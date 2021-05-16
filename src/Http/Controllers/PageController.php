<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orbitali\Foundations\Helpers\Eloquent;

class PageController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Page::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $entries = Page::with(["extras"]);
        $columns = (new Page(["node_id" => 0]))->structure->columns;
        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );
        $entries = $entries->paginate(25)->withQueryString();

        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.page.title", "Sayfalar"]),
            "search" => true,
            "options" => (object) [],
            "actions" => [
                function ($entity) {
                    return (object) [
                        "route" => route("panel.page.show", $entity->id),
                        "title" => trans([
                            "native.panel.page.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return (object) [
                        "route" => route("panel.page.edit", $entity->id),
                        "title" => trans(["native.panel.page.edit", "Düzenle"]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return (object) [
                        "route" => route("panel.page.destroy", $entity->id),
                        "title" => trans(["native.panel.page.destroy", "Sil"]),
                        "icon" => "fa-times",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.page.destroy", $entity->id)
                            )
                            ->class("d-none"),
                    ];
                },
            ],
        ];

        return view("Orbitali::inc.list", $blockOptions);
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
     * @param  int $node
     * @return Response
     */
    public function show(Page $page)
    {
        \Gate::authorize("page.view", $page->node);
        $page->loadMissing("detail.url");
        return redirect($page->detail->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $page
     * @return Response
     */
    public function edit(Page $page)
    {
        \Gate::authorize("page.update", $page->node);
        $page->loadMissing([
            "node.categories.detail",
            "extras",
            "details.extras",
            "details.url",
            "categories.detail",
        ]);
        $page->structure;
        return view("Orbitali::page.edit", compact("page"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $page
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Page $page)
    {
        \Gate::authorize("page.update", $page->node);
        html()->model($page);
        $structure = $page->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $page
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $page->fillWithExtra($inputs);
        return redirect()->to(route("panel.node.show", $page->node_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $page
     * @return Response
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        \Gate::authorize("page.delete", $page->node);
        if ($page->delete() !== false) {
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
}
