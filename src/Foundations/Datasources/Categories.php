<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Foundations\Html\Html;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Models\Page;

class Categories
{
    protected $model;
    public function __construct(Html $html)
    {
        $this->model = $html->model->loadMissing(["node.categories.detail"]);
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
