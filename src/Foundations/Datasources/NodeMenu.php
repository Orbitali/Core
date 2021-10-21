<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Http\Models\Menu;
use Orbitali\Http\Models\MenuDetail;
use Orbitali\Http\Models\Node;
use Orbitali\Foundations\KeyValueCollection;

class NodeMenu
{
    public function source(Menu $menu)
    {
        $nodes = Node::with("detail")
            ->withCount("pages")
            ->get();
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
                    "count" => $node->pages_count,
                    $prntName => $menu->{$prntName},
                    "data" => $node->single
                        ? route("panel.node.edit", $node, false)
                        : route("panel.node.show", $node, false),
                ]))
                    ->setRelation(
                        "detail",
                        new MenuDetail([
                            "name" => $node->detail->name ?? $node->type,
                        ])
                    )
                    ->setRelation("extras", new KeyValueCollection([], null));
            })
            ->prepend(
                (new Menu([
                    "id" => -$i,
                    $lftName => $lft + $i,
                    "type" => "external",
                    "count" => 0,
                    $prntName => $menu->{$prntName},
                    "data" => route("panel.node.index", null, false),
                ]))
                    ->setRelation("detail", new MenuDetail(["name" => "All"]))
                    ->setRelation("extras", new KeyValueCollection([], null))
            );
    }
}
