<?php

namespace Orbitali\Foundations\Html;

use Orbitali\Foundations\Html\Elements\A;
use Orbitali\Foundations\Html\Elements\I;
use Illuminate\Http\Request;
use Orbitali\Foundations\Html\Elements\Div;
use Orbitali\Foundations\Html\Elements\Img;
use Orbitali\Foundations\Html\Elements\File;
use Orbitali\Foundations\Html\Elements\Form;
use Orbitali\Foundations\Html\Elements\Span;
use Orbitali\Foundations\Html\Elements\Input;
use Orbitali\Foundations\Html\Elements\Label;
use Orbitali\Foundations\Html\Elements\Button;
use Orbitali\Foundations\Html\Elements\Legend;
use Orbitali\Foundations\Html\Elements\Option;
use Orbitali\Foundations\Html\Elements\Select;
use Orbitali\Foundations\Html\Elements\Element;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Orbitali\Foundations\Html\Elements\Fieldset;
use Orbitali\Foundations\Html\Elements\Textarea;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Support\Htmlable;

class Html
{
    use Macroable;

    /** @var \Illuminate\Http\Request */
    protected $request;

    /** @var \ArrayAccess|array */
    public $model;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string|null $href
     * @param string|null $text
     *
     * @return \Orbitali\Foundations\Html\Elements\A
     */
    public function a($href = null, $contents = null)
    {
        return A::create()
            ->attributeIf($href, 'href', $href)
            ->html($contents);
    }

    /**
     * @param string|null $href
     * @param string|null $text
     *
     * @return \Orbitali\Foundations\Html\Elements\I
     */
    public function i($contents = null)
    {
        return I::create()
            ->html($contents);
    }

    /**
     * @param string|null $type
     * @param string|null $text
     *
     * @return \Orbitali\Foundations\Html\Elements\Button
     */
    public function button($contents = null, $type = null, $name = '')
    {
        return Button::create()
            ->attributeIf($type, 'type', $type)
            ->attributeIf($name, 'name', $this->fieldName($name))
            ->html($contents);
    }

    /**
     * @param \Illuminate\Support\Collection|iterable|string $classes
     *
     * @return \Illuminate\Contracts\Support\Htmlable
     */
    public function class($classes): Htmlable
    {
        if ($classes instanceof Collection) {
            $classes = $classes->toArray();
        }

        $attributes = new Attributes();
        $attributes->addClass($classes);

        return new HtmlString(
            $attributes->render()
        );
    }

    /**
     * @param string|null $name
     * @param bool $checked
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function checkbox($name = null, $checked = false, $value = '1')
    {
        return $this->input('checkbox', $name, $value)
            ->attributeIf(! is_null($value), 'value', $value)
            ->attributeIf((bool) $this->old($name, $checked), 'checked');
    }

    /**
     * @param \Orbitali\Foundations\Html\HtmlElement|string|null $contents
     *
     * @return \Orbitali\Foundations\Html\Elements\Div
     */
    public function div($contents = null)
    {
        return Div::create()->children($contents);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function email($name = '', $value = '')
    {
        return $this->input('email', $name, $value);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function date($name = '', $value = '')
    {
        return $this->input('date', $name, $value);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function time($name = '', $value = '')
    {
        return $this->input('time', $name, $value);
    }

    /**
     * @param string $tag
     *
     * @return \Orbitali\Foundations\Html\Elements\Element
     */
    public function element($tag)
    {
        return Element::withTag($tag);
    }

    /**
     * @param string|null $type
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function input($type = null, $name = null, $value = null)
    {
        $hasValue = $name && (! is_null($this->old($name, $value)) || ! is_null($value));

        return Input::create()
            ->attributeIf($type, 'type', $type)
            ->attributeIf($name, 'name', $this->fieldName($name))
            ->attributeIf($name, 'id', $this->fieldName($name))
            ->attributeIf($hasValue, 'value', $this->old($name, $value));
    }

    /**
     * @param \Orbitali\Foundations\Html\HtmlElement|string|null $legend
     *
     * @return \Orbitali\Foundations\Html\Elements\Fieldset
     */
    public function fieldset($legend = null)
    {
        return $legend ?
            Fieldset::create()->legend($legend) :
            Fieldset::create();
    }

    /**
     * @param string $method
     * @param string|null $action
     *
     * @return \Orbitali\Foundations\Html\Elements\Form
     */
    public function form($method = 'POST', $action = null)
    {
        $method = strtoupper($method);
        $form = Form::create();

        // If Laravel needs to spoof the form's method, we'll append a hidden
        // field containing the actual method
        if (in_array($method, ['DELETE', 'PATCH', 'PUT'])) {
            $form = $form->addChild($this->hidden('_method')->value($method));
        }

        // On any other method that get, the form needs a CSRF token
        if ($method !== 'GET') {
            $form = $form->addChild($this->token());
        }

        return $form
            ->method($method === 'GET' ? 'GET' : 'POST')
            ->attributeIf($action, 'action', $action);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function hidden($name = null, $value = null)
    {
        return $this->input('hidden', $name, $value);
    }

    /**
     * @param string|null $src
     * @param string|null $alt
     *
     * @return \Orbitali\Foundations\Html\Elements\Img
     */
    public function img($src = null, $alt = null)
    {
        return Img::create()
            ->attributeIf($src, 'src', $src)
            ->attributeIf($alt, 'alt', $alt);
    }

    /**
     * @param \Orbitali\Foundations\Html\HtmlElement|iterable|string|null $contents
     * @param string|null $for
     *
     * @return \Orbitali\Foundations\Html\Elements\Label
     */
    public function label($contents = null, $for = null)
    {
        return Label::create()
            ->attributeIf($for, 'for', $this->fieldName($for))
            ->children($contents);
    }

    /**
     * @param \Orbitali\Foundations\Html\HtmlElement|string|null $contents
     *
     * @return \Orbitali\Foundations\Html\Elements\Legend
     */
    public function legend($contents = null)
    {
        return Legend::create()->html($contents);
    }

    /**
     * @param string $email
     * @param string|null $text
     *
     * @return \Orbitali\Foundations\Html\Elements\A
     */
    public function mailto($email, $text = null)
    {
        return $this->a('mailto:'.$email, $text ?: $email);
    }

    /**
     * @param string|null $name
     * @param iterable $options
     * @param string|iterable|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Select
     */
    public function multiselect($name = null, $options = [], $value = null)
    {
        return Select::create()
            ->attributeIf($name, 'name', $this->fieldName($name))
            ->attributeIf($name, 'id', $this->fieldName($name))
            ->options($options)
            ->value($name ? $this->old($name, $value) : $value)
            ->multiple();
    }

    /**
     * @param string|null $text
     * @param string|null $value
     * @param bool $selected
     *
     * @return \Orbitali\Foundations\Html\Elements\Option
     */
    public function option($text = null, $value = null, $selected = false)
    {
        return Option::create()
            ->text($text)
            ->value($value)
            ->selectedIf($selected);
    }

    /**
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function password($name = null)
    {
        return $this->input('password', $name);
    }

    /**
     * @param string|null $name
     * @param bool $checked
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function radio($name = null, $checked = false, $value = null)
    {
        return $this->input('radio', $name, $value)
            ->attributeIf($name, 'id', $value === null ? $name : ($name.'_'.str_slug($value)))
            ->attributeIf(! is_null($value), 'value', $value)
            ->attributeIf((! is_null($value) && $this->old($name) == $value) || $checked, 'checked');
    }

    /**
     * @param string|null $name
     * @param iterable $options
     * @param string|iterable|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Select
     */
    public function select($name = null, $options = [], $value = null)
    {
        return Select::create()
            ->attributeIf($name, 'name', $this->fieldName($name))
            ->attributeIf($name, 'id', $this->fieldName($name))
            ->options($options)
            ->value($name ? $this->old($name, $value) : $value);
    }

    /**
     * @param \Orbitali\Foundations\Html\HtmlElement|string|null $contents
     *
     * @return \Orbitali\Foundations\Html\Elements\Span
     */
    public function span($contents = null)
    {
        return Span::create()->children($contents);
    }

    /**
     * @param string|null $text
     *
     * @return \Orbitali\Foundations\Html\Elements\Button
     */
    public function submit($text = null)
    {
        return $this->button($text, 'submit');
    }

    /**
     * @param string|null $text
     *
     * @return \Orbitali\Foundations\Html\Elements\Button
     */
    public function reset($text = null)
    {
        return $this->button($text, 'reset');
    }

    /**
     * @param string $number
     * @param string|null $text
     *
     * @return \Orbitali\Foundations\Html\Elements\A
     */
    public function tel($number, $text = null)
    {
        return $this->a('tel:'.$number, $text ?: $number);
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function text($name = null, $value = null)
    {
        return $this->input('text', $name, $value);
    }

    /**
     * @param string|null $name
     *
     * @return \Orbitali\Foundations\Html\Elements\File
     */
    public function file($name = null)
    {
        return File::create()
            ->attributeIf($name, 'name', $this->fieldName($name))
            ->attributeIf($name, 'id', $this->fieldName($name));
    }

    /**
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Orbitali\Foundations\Html\Elements\Textarea
     */
    public function textarea($name = null, $value = null)
    {
        return Textarea::create()
            ->attributeIf($name, 'name', $this->fieldName($name))
            ->attributeIf($name, 'id', $this->fieldName($name))
            ->value($this->old($name, $value));
    }

    /**
     * @return \Orbitali\Foundations\Html\Elements\Input
     */
    public function token()
    {
        return $this
            ->hidden()
            ->name('_token')
            ->value($this->request->session()->token());
    }

    /**
     * @param \ArrayAccess|array $model
     *
     * @return $this
     */
    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param \ArrayAccess|array $model
     * @param string|null $method
     * @param string|null $action
     *
     * @return \Orbitali\Foundations\Html\Elements\Form
     */
    public function modelForm($model, $method = 'POST', $action = null): Form
    {
        $this->model($model);

        return $this->form($method, $action);
    }

    /**
     * @return $this
     */
    public function endModel()
    {
        $this->model = null;

        return $this;
    }

    /**
     * @return \Illuminate\Contracts\Support\Htmlable
     */
    public function closeModelForm(): Htmlable
    {
        $this->endModel();

        return $this->form()->close();
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return mixed
     */
    public function old($name, $value = null)
    {
        if (empty($name)) {
            return;
        }

        // Convert array format (sth[1]) to dot notation (sth.1)
        $name = preg_replace('/\[(.+)\]/U', '.$1', $name);

        // If there's no default value provided, the html builder currently
        // has a model assigned and there aren't old input items,
        // try to retrieve a value from the model.
        if (empty($value) && $this->model && empty($this->request->old())) {
            $value = data_get($this->model, $name) ?? '';
        }

        return $this->request->old($name, $value);
    }

    /**
     * Retrieve the value from the current session or assigned model. This is
     * a public alias for `old`.
     *
     * @param string $name
     * @param mixed $value
     *
     * @return mixed
     */
    public function value($name, $default = null)
    {
        return $this->old($name, $default);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function fieldName($name)
    {
        return $name;
    }

    protected function ensureModelIsAvailable()
    {
        if (empty($this->model)) {
            throw new Exception('Method requires a model to be set on the html builder');
        }
    }
}