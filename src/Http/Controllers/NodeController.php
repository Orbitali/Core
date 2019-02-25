<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Http\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $nodes = Node::with('extras')->paginate(5);
        return view('Orbitali::node.index', compact('nodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $model = Node::preCreate();
        if ($model !== false) {
            return redirect(route("panel.node.edit", $model->id));
        }
        return redirect()->back()->withErrors(trans(
            ["native.panel.node.message.create.error", "Düğüm oluşturulamadı"]
        ));
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
    public function show($node)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $node
     * @return Response
     */
    public function edit($node)
    {
        $node = Node::withPredraft()->with("extras")->findOrFail($node);
        return view("Orbitali::node.edit", compact("node"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $node
     * @return Response
     */
    public function update($node)
    {
        $node = Node::withPredraft()->findOrFail($node);
        $node->fillWithExtra(Input::all());
        return redirect()->to(route('panel.node.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $node
     * @return Response
     * @throws \Exception
     */
    public function destroy($node)
    {
        $node = Node::withPredraft()->findOrFail($node);
        if ($node->delete() !== false) {
            session()->flash("success", trans(["native.panel.website.message.destroy.success", "Silme işlemi başarılı."]));
        } else {
            session()->flash("success", trans(["native.panel.website.message.destroy.success", "Silme işlemi başarılı."]));
        }
        return redirect()->back();
    }

}
