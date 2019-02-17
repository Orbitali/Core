<?php

namespace Orbitali\Foundations;

use Orbitali\Http\Models\Category;
use Orbitali\Http\Models\CategoryDetail;
use Orbitali\Http\Models\Form;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\NodeDetail;
use Orbitali\Http\Models\Page;
use Orbitali\Http\Models\PageDetail;
use Orbitali\Http\Models\Url;
use Orbitali\Http\Models\Website;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Traits\Macroable;

/**
 * @property Website website
 * @property Url url
 * @property NodeDetail|CategoryDetail|PageDetail relation
 * @property Node|Category|Page parent
 * @property Node node
 * @property Collection forms
 * @property string language
 * @property string|null country
 */
class Orbitali
{
    use Macroable;

    /**
     * Orbitali constructor.
     */
    public function __construct()
    {
        View::share("orbitali", $this);
    }

    public function __destruct()
    {
        //TODO: Cache the orbitali for next request
    }

    public function __get($name)
    {
        if ($this->hasMacro($name) || method_exists(self::class, $name)) {
            $this->$name = $this->$name();
            if (is_a($this->$name, Relation::class)) {
                $relation = $this->$name;
                $this->$name = $this->$name->getResults();
                $relation->getParent()->setRelation($name, $this->$name);
            } else if (is_a($this->$name, Builder::class)) {
                $this->$name = $this->$name->get();
            }
        }
        return $this->$name;
    }

    public function forms(): Builder
    {
        function aSearch($cls)
        {
            return array_search(get_class($cls), Relation::$morphMap);
        }

        $subQuery = DB::table('form_pivots')->where([
            'model_type' => aSearch($this->node),
            'model_id' => $this->node->id
        ])->
        orWhere([
            'model_type' => aSearch($this->parent),
            'model_id' => $this->parent->id
        ])->
        orWhere([
            'model_type' => aSearch($this->relation),
            'model_id' => $this->relation->id
        ])->select('form_id');

        return Form::whereIn('id', $subQuery);
    }
}
