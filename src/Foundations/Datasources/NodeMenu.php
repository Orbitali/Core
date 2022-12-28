<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Http\Models\Menu;
use Orbitali\Http\Models\MenuExtra;
use Orbitali\Http\Models\MenuDetail;
use Orbitali\Http\Models\Node;
use Orbitali\Foundations\KeyValueCollection;

class NodeMenu implements IMenuDatasource
{
    public function source(Menu $menu = null)
    {
        $nodes = Node::with("detail")->get();

        $lft = $menu->getLft();
        $lftName = $menu->getLftName();
        $prntName = $menu->getParentIdName();
        $i = 0;
        return $nodes
            ->map(function ($node) use ($menu, $prntName, $lftName, $lft, &$i) {
                $i++;
                return (new Menu([
                    "id" => -$i,
                    $lftName => $lft + $i,
                    "type" => "external",
                    $prntName => $menu->{$prntName},
                    "data" => $node->single
                        ? route("panel.node.edit", $node, false)
                        : route("panel.node.show", $node, false),
                    "detail" => [
                        "name" => $node->detail->name ?? $node->type
                    ]
                ]));
            })
            ->prepend(
                (new Menu([
                    "id" => -$i,
                    $lftName => $lft + $i,
                    "type" => "external",
                    "detail" => [
                        "name" => "All",
                    ],
                    $prntName => $menu->{$prntName},
                    "data" => route("panel.node.index", null, false),
                ]))
            );
    }
}
