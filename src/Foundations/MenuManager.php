<?php

namespace Orbitali\Foundations;

use Orbitali\Http\Models\Menu;
use Orbitali\Http\Models\MenuDetail;
use Orbitali\Http\Models\MenuExtra;
use Orbitali\Http\Models\Node;
use Illuminate\Database\Eloquent\Relations\Relation as IRelation;

class MenuManager
{
    protected $formatter;
    protected $menus;
    public function __construct()
    {
        $this->formatter = function (&$menu, $index) {
            if ($menu->type == "datasource") {
                $this->menus->forget($index);
                $this->menus = $this->menus->concat(
                    (new $menu->data())->source($menu)->each($this->formatter)
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
        };
    }

    public function menuBuilder()
    {
        $this->menus = Menu::with("detail", "extras")
            ->orderBy("lft")
            ->descendantsOf(1);
        $this->menus->each($this->formatter);
        return $this->menus->toTree();
    }
}
