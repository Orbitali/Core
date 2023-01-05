<?php

namespace Orbitali\Foundations;
use Intervention\Image\ImageManager;

class ImageClosure implements \Stringable
{
    private $gd;
    private $_path;
    private $path;
    private $defaultPath;
    private $methods;
    private $filename;
    private $extension;
    private $manager;
    private $orjPath;
    private $storage;

    public function __construct($path)
    {
        $this->storage = \Storage::disk("public");
        $this->defaultPath = public_path("vendor/orbitali/images/favicon.png");
        $path ??= $this->defaultPath;
        $this->_path = $path;
        $info = pathinfo($path);
        $this->orjPath = $path;
        $this->path = $info["dirname"];
        $this->filename = $info["filename"];
        $this->extension = $info["extension"];
        $this->methods = [];
    }

    public function __call($name, $arguments)
    {
        $argText = array_filter($arguments, function ($el) {
            return gettype($el) != "object";
        });
        $this->filename .= "__$name-" . implode("_", $argText);
        $this->methods[][$name] = $arguments;
        return $this;
    }

    private function getGD()
    {
        if ($this->gd == null) {
            $this->manager = new ImageManager(["driver" => "imagick"]);

            if ($this->storage->exists($this->orjPath)) {
                $this->gd = $this->manager->make(
                    $this->storage->path($this->_path)
                );
            } else {
                $this->gd = $this->manager->make($this->defaultPath);
            }
        }
        return $this->gd;
    }

    public function apply()
    {
        foreach ($this->methods as $met) {
            foreach ($met as $key => $arg) {
               $this->gd = $this->getGD()->{$key}(...$arg);
            }
        }
    }

    public function get()
    {
        $directory = $this->path . DIRECTORY_SEPARATOR . "O";
        $path =
            $directory .
            DIRECTORY_SEPARATOR .
            $this->filename .
            "." .
            $this->extension;

        if ($this->storage->exists($path)) {
            return $this->storage->url($path);
        }

        if ($this->getGD() != null) {
            $this->apply();
            if($this->extension == "data-url"){
                return $this->getGD();
            }
            $this->storage->makeDirectory($directory, 0755, true);
            $this->save($this->storage->path($path), 90);
        }
        return $this->storage->url($path);
    }

    public function __toString()
    {
        return $this->get();
    }

    public function save()
    {
        return $this->getGD()->save(...func_get_args());
    }

    public function default($path)
    {
        $this->defaultPath = $path;
        return $this;
    }

    public function encode($extension, $quality = 90)
    {
        $this->extension = $extension;
        return $this->__call("encode", [$extension, $quality]);
    }

    public function mimeType()
    {
        return $this->getGD()->mime();
    }
}
