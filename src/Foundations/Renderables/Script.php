<?php

namespace Orbitali\Foundations\Renderables;

use Orbitali\Foundations\Html\BaseElement;
use Illuminate\Support\Facades\View;

class Script extends BaseRenderable
{
    protected $tag = "script";
    public function __construct(&$config)
    {
        parent::__construct();

        View::composer("Orbitali::inc.app", function (
            \Illuminate\View\View $view
        ) use ($config) {
            $env = $view->getFactory();

            $name = "__pushonce_" . md5($config[":content"]);
            !isset($env->{$name}) &&
                ($env->{$name} = !0) &&
                $env->startPush(
                    "scripts",
                    '<script type="text/javascript">' .
                        $config[":content"] .
                        "</script>"
                );
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
