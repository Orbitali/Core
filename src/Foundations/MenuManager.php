<?php

namespace Orbitali\Foundations;

use Orbitali\Http\Models\Menu;
use Orbitali\Http\Models\MenuDetail;
use Orbitali\Http\Models\MenuExtra;
use Orbitali\Http\Models\Node;
use Illuminate\Database\Eloquent\Relations\Relation as IRelation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Orbitali\Foundations\Nestedset\Collection as NestedCollection;

class MenuManager
{
    public function __construct()
    {
    }

    public function menuBuilder($rootId)
    {
        $menus = collect(Cache::rememberForever('orbitali.cache.menu_manager.'.$rootId, function () use($rootId) {
            $menuTree = Menu::with("detail", "extras")->status()->orderBy("lft")->descendantsOf($rootId)->toTree();
            $formatter = function($menu) use (&$formatter) {
                if ($menu->type == "datasource") {
                    $args = explode(",", $menu->data);
                    $source = array_shift($args);

                    $index = $menu->parent->children->search($menu);
                    $newMenu = NestedCollection::wrap(resolve($source)->source($menu,...$args))->toTree()->each($formatter);
                    $menu->parent->children->splice($index, 1, $newMenu);
                } elseif ($menu->type == "route") {
                    $args = explode(",", $menu->data);
                    $route = array_shift($args);
                    $menu->data = route($route, $args, false);
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
                $menu->type .= "@";
                $menu->children->each($formatter);
            };
            return $menuTree->each($formatter)->toArray();
        }))->map(function($i) {
            $mm = (new Menu())->forceFill($i);
            $mm->exists = true;
            return $mm;
        });

        return $menus;
    }
}
