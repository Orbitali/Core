<?php

namespace Orbitali\Foundations;
use Intervention\Image\ImageManager;

class ImageClosure
{
    private $gd;
    private $path;
    private $methods;
    private $filename;
    private $extension;
    private $manager;
    private $orjPath;
    private $storage;

    public function __construct($path)
    {
        $this->storage = \Storage::disk("public");
        if (!$this->storage->exists($path)) {
            return;
        }

        $this->manager = new ImageManager(["driver" => "imagick"]);
        $this->gd = $this->manager->make($this->storage->path($path));
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

    public function getGD()
    {
        return $this->gd;
    }

    public function apply()
    {
        foreach ($this->methods as $met) {
            foreach ($met as $key => $arg) {
                $this->gd->{$key}(...$arg);
            }
        }
    }

    public function get()
    {
        $this->path =
            $this->path .
            DIRECTORY_SEPARATOR .
            $this->filename .
            "." .
            $this->extension;

        if ($this->storage->exists($this->path)) {
            return $this->storage->url($this->path);
        }
        if ($this->storage->exists($this->orjPath)) {
            $this->apply();
            $this->save($this->storage->path($this->path), 90);
        } else {
            //TODO: default image
        }
        return $this->storage->url($this->path);
    }

    public function __toString()
    {
        return $this->get();
    }

    public function save()
    {
        return $this->gd->save(...func_get_args());
    }
}
