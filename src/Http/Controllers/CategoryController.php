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
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class);
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
    public function show(Category $category)
    {
        $category->loadMissing("detail.url");
        return redirect($category->detail->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $page
     * @return Response
     */
    public function edit(Category $category)
    {
        $category->loadMissing(["extras", "details.extras"]);
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
    public function update(Request $request, Category $category)
    {
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
    public function destroy(Category $category)
    {
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
