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
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\JsonEncodingException;
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
class Orbitali implements Arrayable, Jsonable, \JsonSerializable
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

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return (array)$this;
    }
}
