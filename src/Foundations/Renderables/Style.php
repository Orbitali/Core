<?php

namespace Orbitali\Foundations\Renderables;

use Orbitali\Foundations\Html\BaseElement;
use Illuminate\Support\Facades\View;

class Style extends BaseRenderable
{
    protected $tag = "style";
    public function __construct(&$config)
    {
        parent::__construct();

        View::composer("Orbitali::inc.app", function (
            \Illuminate\View\View $view
        ) use ($config) {
            $env = $view->getFactory();
            $name = "__pushonce_" . md5($config[":content"]);
            if (!$env->hasRenderedOnce($name)) {
                $env->markAsRenderedOnce($name);
                $env->startPush(
                    "styles",
                    '<style type="text/css">' . $config[":content"] . "</style>"
                );
            }
        });
    }

    public function render()
    {
        return "";
    }

    public function getValidations()
    {
        return null;
    }
}
