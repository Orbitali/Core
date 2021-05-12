<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function index()
    {
        $nodes = Node::with(["extras", "detail"])->paginate(5);
        return view("Orbitali::node.index", compact("nodes"));
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
            return redirect(route("panel.node.edit", $model->id));
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
    public function show(Node $node)
    {
        $node_id = $node->id;
        $pages = $node
            ->pages()
            ->with("detail")
            ->paginate(5);
        return view("Orbitali::node.show", compact("pages", "node_id"));
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
