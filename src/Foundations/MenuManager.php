<?php

namespace Orbitali\Foundations;

use Orbitali\Http\Models\Menu;
use Orbitali\Http\Models\MenuDetail;
use Orbitali\Http\Models\MenuExtra;
use Orbitali\Http\Models\Node;
use Illuminate\Database\Eloquent\Relations\Relation as IRelation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MenuManager
{
    public function __construct()
    {
    }

    public function menuBuilder($rootId)
    {
        $menus = collect(Cache::rememberForever('orbitali.cache.menu_manager.'.$rootId, function () use($rootId) {
            $menus = Menu::with("detail", "extras")->status()->orderBy("lft")->descendantsOf($rootId);
            $formatter = function (&$menu, $index) use(&$menus, &$formatter) {
                 if ($menu->type == "datasource") {
                    $menus->forget($index);
                    $menus = $menus->concat(
                        (new $menu->data())->source($menu)->each($formatter)
                    );
                } elseif ($menu->type == "route") {
                    $menu->data = route($menu->data, null, false);
                } elseif ($menu->type == "internal") {
                    $value = explode(",", $menu->data);
                    $internal = IRelation::getMorphedModel($value[0])::with("detail.url")->find($value[1])->detail;
                    $menu->data = $internal->url->url;

                    if(!isset($menu->detail->name) && $menu->detail->name == ""){
                        $menu->setRelation(
                            "detail",
                            new MenuDetail(["name" => $internal->name])
                        );
                    }
                } elseif ($menu->type == "javascript") {
                    $menu->data = "javascript:$menu->data";
                }
            };
            $menus->each($formatter);
            return $menus->toTree()->toArray();
        }))->map(function($i) {
            $mm = (new Menu())->forceFill($i);
            $mm->exists = true;
            return $mm;
        });

        return $menus;
    }
}
