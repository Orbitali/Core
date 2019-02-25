<?php

namespace Orbitali\Http\Models;

use Orbitali\Foundations\Model;
use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use Cacheable, SoftDeletes;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'forms';

    public function entries()
    {
        return $this->hasMany(FormEntry::class);
    }

    public function pages()
    {
        return $this
            ->belongsToMany(Page::class, 'form_pivots', 'form_id', 'model_id')
            ->where('model_type', relationFinder(Page::class));
    }

    public function nodes()
    {
        return $this
            ->belongsToMany(Node::class, 'form_pivots', 'form_id', 'model_id')
            ->where('model_type', relationFinder(Node::class));
    }

    public function structure()
    {
        return $this->morphOne(Structure::class, 'model');
    }

    public function __toString()
    {
        //TODO:

        function arrayEx(&$child)
        {
            return array_filter($child, function ($key) {
                return $key[0] != ':';
            }, ARRAY_FILTER_USE_KEY);
        }

        function createDomElement($tag, $attributes, $inner = '', $closingTag = true)
        {
            return '<' . $tag . ' ' . rtrim(join(' ', array_map(function ($key) use ($attributes) {
                    return is_bool($attributes[$key]) ? $key : $key . '="' . $attributes[$key] . '"';
                }, array_keys($attributes)))) . '>' . $inner . ($closingTag ? '</' . $tag . '>' : '');
        }

        function renderTemplate($children)
        {
            $template = "";
            foreach ($children as $child) {
                $subChildren = '';
                if (isset($child[':children']) && is_array($child[':children'])) {
                    $subChildren = renderTemplate($child[':children']);
                }
                $template .= createDomElement($child[':tag'], arrayEx($child), $subChildren);
            }
            return $template;
        }

        return renderTemplate($this->structure->data);
    }
}
