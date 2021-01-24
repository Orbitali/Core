<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pages = Page::with("extras")->paginate(5);
        return view("Orbitali::page.index", compact("pages"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($node)
    {
        $model = Page::preCreate(["node_id" => $node]);
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
    public function show($page)
    {
        $page = Page::with("detail.url")->findOrFail($page);
        return redirect($page->detail->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $page
     * @return Response
     */
    public function edit($page)
    {
        $page = Page::withPredraft()
            ->with(
                "node.categories.detail",
                "extras",
                "structure",
                "details.extras",
                "categories.detail"
            )
            ->findOrFail($page);
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
    public function update(Request $request, $page)
    {
        $page = Page::withPredraft()->findOrFail($page);
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
    public function destroy($page)
    {
        $page = Page::withPredraft()->findOrFail($page);
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
                "success",
                trans([
                    "native.panel.website.message.destroy.success",
                    "Silme işlemi başarılı.",
                ])
            );
        }
        return redirect()->back();
    }
}
