<?php

namespace Orbitali\Foundations;

use Orbitali\Http\Models\{
    Category,
    CategoryDetail,
    Form,
    Node,
    NodeDetail,
    Page,
    PageDetail,
    Url,
    Website
};

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Traits\Macroable;
use Butschster\Head\MetaTags\MetaInterface;

/**
 * @property Website website
 * @property Url url
 * @property NodeDetail|CategoryDetail|PageDetail relation
 * @property Node|Category|Page parent
 * @property Node node
 * @property Collection forms
 * @property MetaInterface meta
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

    public function language()
    {
        $auth = auth();
        if ($auth->check()) {
            $lang = optional($auth->user()->language)->__toString();
            if (isset($lang)) {
                return $lang;
            }
        }
        return Arr::first($this->website?->languages) ?? config("app.locale");
    }

    public function country()
    {
        return null;
    }

    public function forms(): Builder
    {
        $subQuery = DB::table("form_pivots")
            ->where([
                "model_type" => Helpers\Relation::relationFinder($this->node),
                "model_id" => $this->node->id,
            ])
            ->orWhere([
                "model_type" => Helpers\Relation::relationFinder($this->parent),
                "model_id" => $this->parent->id,
            ])
            ->orWhere([
                "model_type" => Helpers\Relation::relationFinder(
                    $this->relation
                ),
                "model_id" => $this->relation->id,
            ])
            ->select("form_id");

        return Form::whereIn("id", $subQuery);
    }

    public function __get($name)
    {
        if ($this->hasMacro($name) || method_exists(self::class, $name)) {
            $this->$name = $this->$name();
            if (is_a($this->$name, Relation::class)) {
                $relation = $this->$name;
                $this->$name = $this->$name->getResults();
                $relation->getParent()->setRelation($name, $this->$name);
            } elseif (is_a($this->$name, Builder::class)) {
                $this->$name = $this->$name->get();
            }
        }
        return $this->$name ?? null;
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
        return (array) $this;
    }
}
