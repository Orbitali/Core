<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Foundations\Html\Html;
use Orbitali\Foundations\Orbitali;

class Categories
{
    protected $orb;
    protected $model;
    public function __construct(Orbitali $orb, Html $html)
    {
        $this->orb = $orb;
        $this->model = $html->model;
    }

    public function source()
    {
        if ($this->model == null) {
            return [];
        }
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
}
