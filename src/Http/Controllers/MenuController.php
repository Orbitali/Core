<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Menu::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $menus = Menu::with(["detail", "extras"])
            ->orderBy("lft")
            ->select(["id", "lft", "rgt", "status", "menu_id"])
            ->get()
            ->each(function ($item) {
                $item->setAttribute(
                    "removeAction",
                    route("panel.menu.destroy", $item, false)
                );
                $item->setAttribute(
                    "editAction",
                    route("panel.menu.edit", $item, false)
                );
            })
            ->toTree();
        return view("Orbitali::menu.index", compact("menus"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Menu $menu)
    {
        $model = Menu::preCreate(["website_id" => 1]);
        if ($model !== false) {
            return redirect(route("panel.menu.edit", $model));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.menu.message.create.error",
                    "Menü oluşturulamadı",
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
        Menu::rebuildTree($data, []);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $node
     * @return Response
     */
    public function show(Menu $menu)
    {
        return redirect()->to(route("panel.menu.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $page
     * @return Response
     */
    public function edit(Menu $menu)
    {
        $menu->loadMissing(["extras", "details.extras"]);
        $menu->structure;
        return view("Orbitali::menu.edit", compact("menu"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $page
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Menu $menu)
    {
        html()->model($menu);
        $structure = $menu->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $menu
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $menu->fillWithExtra($inputs);
        return redirect()->to(route("panel.menu.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $page
     * @return Response
     * @throws \Exception
     */
    public function destroy(Menu $menu)
    {
        if ($menu->delete() !== false) {
            session()->flash(
                "success",
                trans([
                    "native.panel.menu.message.destroy.success",
                    "Silme işlemi başarılı.",
                ])
            );
        } else {
            session()->flash(
                "danger",
                trans([
                    "native.panel.menu.message.destroy.danger",
                    "Silme işlemi hatalı.",
                ])
            );
        }
        return redirect()->back();
    }
}
