<?php

namespace Orbitali\Foundations;

use Orbitali\Http\Models\Menu;
use Orbitali\Http\Models\MenuDetail;
use Orbitali\Http\Models\MenuExtra;
use Orbitali\Http\Models\Node;
use Illuminate\Database\Eloquent\Relations\Relation as IRelation;
use Illuminate\Support\Collection;

class MenuManager
{
    protected $menus;
    public function __construct()
    {
    }

    public function formatter(&$menu, $index)
    {
        if ($menu->type == "datasource") {
            $this->menus->forget($index);
            $this->menus = $this->menus->concat(
                (new $menu->data())->source($menu)->each([$this, "formatter"])
            );
        } elseif ($menu->type == "route") {
            $menu->data = route($menu->data, null, false);
        } elseif ($menu->type == "internal") {
            $value = explode(",", $menu->data);
            $internal = IRelation::getMorphedModel($value[0])
                ::with("detail.url")
                ->find($value[1])->detail;
            $menu->data = $internal->url->url;
            $menu->setRelation(
                "detail",
                new MenuDetail(["name" => $internal->name])
            );
        } elseif ($menu->type == "javascript") {
            $menu->data = "javascript:$menu->data";
        }

        if (isset($menu->icon)) {
            $menu->setAttribute(
                "icon",
                Collection::wrap($menu->icon)->implode(" ")
            );
        }
    }

    public function menuBuilder($rootId)
    {
        $this->menus = Menu::with("detail", "extras")
            ->orderBy("lft")
            ->descendantsOf($rootId);
        $this->menus->each([$this, "formatter"]);
        return $this->menus->toTree();
    }
}
