<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Orbitali\Foundations\Html\BaseElement;

abstract class BaseRenderable extends BaseElement
{
    public function getValidations()
    {
        $vals = collect([]);
        $this->walkAllChild($this->children, $vals);
        return $vals->filter(function ($q) {
            return $q != null;
        });
    }

    private function walkAllChild($childs, &$vals)
    {
        foreach ($childs as $child) {
            if (is_a($child, BaseRenderable::class)) {
                $vals[] = $child->getValidations();
            } elseif ($child != null && isset($child->children)) {
                $vals[] = $this->walkAllChild($child->children, $vals);
            }
        }
    }

    public function dotNotation($name)
    {
        return Str::replaceLast(
            "[]",
            "",
            preg_replace("/\[(.+)\]/U", '.$1', $name)
        );
    }

    public function initiateClass($struct, $form = null, $tabId = null)
    {
        $tag = $struct[":tag"];
        if (
            !class_exists(
                $class =
                    "Orbitali\Foundations\Html\Elements\\" . Str::studly($tag)
            )
        ) {
            if (
                !class_exists(
                    $class =
                        "Orbitali\Foundations\Renderables\\" . Str::studly($tag)
                )
            ) {
                $obj = Element::withTag($tag);
            }
        }
        return $obj ?? new $class($struct, $form, $tabId);
    }
}
