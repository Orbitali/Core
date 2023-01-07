<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Category;
use Orbitali\Http\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NodeCategoryController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("can:category.viewAny,node")->only("index");
        $this->middleware("can:category.create,node")->only("create");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Node $node)
    {
        $categories = Category::unguarded(function() use($node) {
            return $node
            ->categories()
            ->with([
                "detail" => function ($q) {
                    return $q->select(["id", "name", "category_id"]);
                },
                "extras",
            ])
            ->orderBy("lft")
            ->select(["id", "lft", "rgt", "status", "category_id"])
            ->get()
            ->each(function ($item) {
                $item->setAttribute(
                    "removeAction",
                    route("panel.category.destroy", $item, false)
                );
                $item->setAttribute(
                    "editAction",
                    route("panel.category.edit", $item, false)
                );
            })
            ->toTree();
        });
        return view("Orbitali::category.index", compact("categories", "node"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Node $node)
    {
        $model = Category::preCreate(["node_id" => $node->id]);
        if ($model !== false) {
            return redirect(route("panel.category.edit", $model));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.category.message.create.error",
                    "Kategori oluşturulamadı",
                ])
            );
    }
}
