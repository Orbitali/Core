<?php

namespace Orbitali\Components;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Testing\MimeType;

class DropzoneInput extends InputComponent
{
    /**
     * The name of input.
     *
     * @var string
     */
    public $name;

    /**
     * The title of input.
     *
     * @var string
     */
    public $title;

    /**
     * The multiple of input.
     *
     * @var bool
     */
    public $multiple;

    /**
     * The max files of input.
     *
     * @var int|null
     */
    public $maxFiles;

    /**
     * The storage of input.
     *
     * @var string
     */
    public $storage;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @param  string  $title
     * @return void
     */
    public function __construct(
        $id,
        $name,
        $title,
        $multiple = false,
        $storage = "public",
        $maxFiles = null,
        $parent = null
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->multiple = $multiple;
        $this->maxFiles = $multiple ? $maxFiles : 1;
        $this->storage = Storage::disk($storage);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->dottedName = $this->dotNotation($this->name);
        return view("Orbitali::components.dropzone-input");
    }

    public function getFiles($model, $dottedName)
    {
        $paths = $this->getValue($model, $dottedName);
        if ($paths == null) {
            return;
        }
        $files = [];
        if ($paths == null || $paths == "") {
            $paths = [];
        } elseif (is_string($paths)) {
            $paths = [$paths];
        }
        foreach ($paths as $path) {
            if ($path == null) {
                continue;
            }
            $name = basename($path);
            $mime = MimeType::from($name);
            $files[] = [
                "name" => $name,
                "preview" => $this->formatPreview($path, $mime),
                "type" => $mime,
                "path" => $path,
                "accepted" => true,
            ];
        }
        return json_encode($files);
    }

    private function formatPreview($path, $mime)
    {
        if (str_contains($mime, "image")) {
            return image($path)
                ->fit(120)
                ->get();
        }
        return null;
    }

    public function update()
    {
        $this->dottedName = $this->dotNotation($this->name);
        $this->notifyError();
    }
}
