<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Http\Models\Url;
use Orbitali\Foundations\Helpers\Relation;

class InternalUrls implements IDatasource
{
    public function source()
    {
        return Url::whereHas("model", function ($q) {
            $q->whereHas("parent");
        })
            ->with("model.parent")
            ->get()
            ->mapWithKeys(function ($url) {
                $key =
                    Relation::relationFinder($url->model->parent) .
                    "," .
                    $url->model->parent->id;
                return [
                    $key => $url->model->name,
                ];
            });
    }
}
