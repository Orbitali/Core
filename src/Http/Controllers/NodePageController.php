<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\Page;
use Orbitali\Http\Models\Node;
use Illuminate\Http\Response;

class NodePageController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("can:page.create,node")->only("create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Node $node)
    {
        $model = Page::preCreate(["node_id" => $node->id]);
        if ($model !== false) {
            return redirect(route("panel.page.edit", $model->id));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.page.message.create.error",
                    "Sayfa oluşturulamadı",
                ])
            );
    }
}
