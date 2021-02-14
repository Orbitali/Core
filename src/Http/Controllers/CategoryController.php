<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($node)
    {
        $categories = Category::where("node_id", $node)
            ->with([
                "detail" => function ($q) {
                    return $q->select(["id", "name", "category_id"]);
                },
                "extras",
            ])
            ->orderBy("lft")
            ->select(["id", "lft", "rgt", "status", "category_id"])
            ->get()
            ->toTree();
        return view("Orbitali::category.index", compact("categories", "node"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($node)
    {
        $model = Category::preCreate(["node_id" => $node]);
        if ($model !== false) {
            return redirect(route("panel.category.edit", $model->id));
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

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $data = json_decode(request("data", "[]"), true);
        Category::rebuildTree($data, []);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $node
     * @return Response
     */
    public function show($category)
    {
        $category = Category::with("detail.url")->findOrFail($category);
        return redirect($category->detail->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $page
     * @return Response
     */
    public function edit($category)
    {
        $category = Category::withPredraft()
            ->with("extras", "details.extras")
            ->findOrFail($category);
        $category->structure;
        return view("Orbitali::category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $page
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $category)
    {
        $category = Category::withPredraft()->findOrFail($category);
        html()->model($category);
        $structure = $category->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $category
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $category->fillWithExtra($inputs);
        return redirect()->to(route("panel.node.show", $category->node_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $page
     * @return Response
     * @throws \Exception
     */
    public function destroy($category)
    {
        $category = Category::withPredraft()->findOrFail($category);
        if ($category->delete() !== false) {
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
