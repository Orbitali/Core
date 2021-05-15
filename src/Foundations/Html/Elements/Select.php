<?php

namespace Orbitali\Foundations\Html\Elements;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orbitali\Foundations\Html\Selectable;
use Orbitali\Foundations\Html\BaseElement;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Select extends BaseElement
{
    /** @var string */
    protected $tag = "select";

    /** @var array */
    protected $options = [];

    /** @var string|iterable */
    protected $value = "";

    /**
     * @return static
     */
    public function multiple()
    {
        $element = clone $this;

        $element = $element->attribute("multiple");

        $name = $element->getAttribute("name");

        if ($name && !Str::endsWith($name, "[]")) {
            $element = $element->name($name . "[]");
        }

        $element->applyValueToOptions();

        return $element;
    }

    /**
     * @param string|null $name
     *
     * @return static
     */
    public function name($name)
    {
        return $this->attribute("name", $name);
    }

    /**
     * @param iterable $options
     *
     * @return static
     */
    public function options($options)
    {
        $self = $this;
        $values = Collection::wrap($self->value)->filter();
        $options = Collection::wrap($options);
        if ($options->count() == 0) {
            return $this;
        }
        $result = [];
        $flagValues = true;
        $mapper = function ($value, $key) use (
            $self,
            &$options,
            &$flagValues,
            &$result
        ) {
            $ky = $flagValues ? $value : $key;
            if (is_subclass_of($value, Model::class)) {
                $result[] = Option::create()
                    ->value($value->getKey())
                    ->text($options[$value->getKey()])
                    ->selectedIf($flagValues);
            } elseif (is_array($value)) {
                $result[] = $self->optgroup($options[$ky], $value);
            } elseif (isset($options[$ky])) {
                $result[] = Option::create()
                    ->value($ky)
                    ->text($options[$ky])
                    ->selectedIf($flagValues);
            }
        };

        $values->each($mapper);
        $flagValues = false;
        if (is_subclass_of($values->first(), Model::class)) {
            $values = $values->map(function ($item) {
                return $item->getKey();
            });
            $this->value = $values;
        }
        $options->except($values)->each($mapper);
        return $this->addChildren($result);
    }

    /**
     * @param string $label
     * @param iterable $options
     *
     * @return static
     */
    public function optgroup($label, $options)
    {
        return Optgroup::create()
            ->label($label)
            ->addChildren($options, function ($text, $value) {
                return Option::create()
                    ->value($value)
                    ->text($text)
                    ->selectedIf($value === $this->value);
            });

        return $this->addChild($optgroup);
    }

    /**
     * @param string|null $text
     *
     * @return static
     */
    public function placeholder($text)
    {
        return $this->prependChild(
            Option::create()
                ->value(null)
                ->text($text)
                ->selectedIf(!$this->hasSelection())
        );
    }

    /**
     * @return static
     */
    public function required()
    {
        return $this->attribute("required");
    }

    /**
     * @param string|iterable $value
     *
     * @return static
     */
    public function value($value = null)
    {
        $element = clone $this;

        $element->value = $value;

        $element->applyValueToOptions();

        return $element;
    }

    protected function hasSelection()
    {
        return $this->children->contains->hasAttribute("selected");
    }

    protected function applyValueToOptions()
    {
        $value = Collection::make($this->value);

        if (!$this->hasAttribute("multiple")) {
            $value = $value->take(1);
        }

        $this->children = $this->applyValueToElements($value, $this->children);
    }

    protected function applyValueToElements($value, Collection $children)
    {
        return $children->map(function ($child) use ($value) {
            if ($child instanceof Optgroup) {
                return $child->setChildren(
                    $this->applyValueToElements($value, $child->children)
                );
            }

            if ($child instanceof Selectable) {
                return $child->selectedIf(
                    $value->contains($child->getAttribute("value"))
                );
            }

            return $child;
        });
    }
}
