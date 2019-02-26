<?php

namespace Orbitali\Foundations\Helpers;


use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Element;

class Structure
{

    public static function renderStructure($structure)
    {
        $element = "";
        foreach ($structure as $struct) {
            $element .= Structure::renderStruct($struct)->render();
        }
        return $element;
    }

    public static function renderStruct($struct)
    {
        $tag = $struct[':tag'];
        if (!class_exists($class = 'Orbitali\Foundations\Html\Elements\\' . studly_case($tag))) {
            if (!class_exists($class = 'Orbitali\Foundations\Renderables\\' . studly_case($tag))) {
                $obj = Element::withTag($tag);
            }
        }

        /** @var BaseElement $obj */
        $obj = $obj ?? new $class;

        $obj = $obj->attributes(array_filter($struct, function ($key) {
            return $key[0] != ':';
        }, ARRAY_FILTER_USE_KEY));
        if (isset($struct[':content'])) {
            $obj = $obj->children($struct[':content']);
        }
        if (isset($struct[':children'])) {
            $obj = $obj->children($struct[':children'], [__CLASS__, 'renderStruct']);
        }
        return $obj;
    }

    public static function basicRender($data)
    {
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

        return renderTemplate($data);
    }

}
