<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Foundations\Html\Html;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Models\Page;
use Orbitali\Http\Models\Node;

class Categories implements IDatasource
{
    protected $model;
    public function __construct(Html $html)
    {
        if (is_a($html->model, Node::class)) {
            $this->model = $html->model->loadMissing(["categories.detail"]);
        } else {
            $this->model = $html->model->loadMissing([
                "node.categories.detail",
            ]);
        }
    }

    public function source()
    {
        if (is_a($this->model, Page::class)) {
            $categories = $this->model->node->categories;
            $categories = $categories->mapWithKeys(function ($q) {
                if ($q->detail != null) {
                    return [$q->id => $q->detail->name];
                } else {
                    return [$q->id => $q->id];
                }
            });
            return $categories;
        }
        return [];
    }
}
