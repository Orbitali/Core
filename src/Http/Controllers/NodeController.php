<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orbitali\Foundations\Helpers\Eloquent;

class NodeController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Node::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $entries = Node::with("detail.extras", "detail.url", "extras");
        $columns = (new Node(["id" => 0]))->structure->columns;
        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );
        $entries = $entries->paginate(25)->withQueryString();

        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.node.title", "Düğümler"]),
            "search" => true,
            "options" => [
                [
                    "route" => route("panel.node.create"),
                    "title" => trans([
                        "native.panel.node.add",
                        "Yeni düğüm ekle",
                    ]),
                    "icon" => "fa-plus",
                    "text" => "",
                ],
            ],
            "actions" => [
                function ($entity) {
                    return [
                        "route" => route("panel.node.show", $entity),
                        "title" => trans([
                            "native.panel.node.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.node.edit", $entity),
                        "title" => trans(["native.panel.node.edit", "Düzenle"]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.node.destroy", $entity),
                        "title" => trans(["native.panel.node.destroy", "Sil"]),
                        "icon" => "fa-times",
                        "class" => "js-destroy",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.node.destroy", $entity)
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
        $model = Node::preCreate(["website_id" => orbitali("website")->id]);
        if ($model !== false) {
            return redirect(route("panel.node.edit", $model));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.node.message.create.error",
                    "Düğüm oluşturulamadı",
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
     * @param  int $node
     * @return Response
     */
    public function show(Request $request, Node $node)
    {
        $entries = $node
            ->pages()
            ->with("detail.extras", "detail.url", "extras");

        $columns = (new Page(["id" => 0, "node_id" => $node->id]))->structure
            ->columns;
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
            "options" => [
                [
                    "route" => route("panel.node.category.index", $node),
                    "title" => trans([
                        "native.panel.node.category",
                        "Kategoriler",
                    ]),
                    "icon" => "fa-sitemap",
                    "text" => "",
                ],
                [
                    "route" => route("panel.node.edit", $node),
                    "title" => trans([
                        "native.panel.node.edit",
                        "Düğüm düzenle",
                    ]),
                    "icon" => "fa-pen",
                    "text" => "",
                ],
                [
                    "route" => route("panel.node.page.create", $node),
                    "title" => trans([
                        "native.panel.page.add",
                        "Yeni sayfa ekle",
                    ]),
                    "icon" => "fa-plus",
                    "text" => "",
                ],
            ],
            "actions" => [
                function ($entity) {
                    if (
                        !isset($entity->detail) ||
                        !isset($entity->detail->url)
                    ) {
                        return null;
                    }
                    return [
                        "route" => route("panel.page.show", $entity),
                        "title" => trans([
                            "native.panel.page.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.page.edit", $entity),
                        "title" => trans(["native.panel.page.edit", "Düzenle"]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.page.destroy", $entity),
                        "title" => trans(["native.panel.page.destroy", "Sil"]),
                        "icon" => "fa-times",
                        "class" => "js-destroy",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.page.destroy", $entity)
                            )
                            ->class("d-none"),
                    ];
                },
            ],
        ];

        return view("Orbitali::inc.list", $blockOptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $node
     * @return Response
     */
    public function edit(Node $node)
    {
        $node->loadMissing(["extras", "details.extras", "categories.detail"]);
        $node->structure;
        return view("Orbitali::node.edit", compact("node"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $node
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Node $node)
    {
        html()->model($node);
        $structure = $node->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $node
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $node->fillWithExtra($inputs);
        return redirect()->to(route("panel.node.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $node
     * @return Response
     * @throws \Exception
     */
    public function destroy(Node $node)
    {
        if ($node->delete() !== false) {
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
